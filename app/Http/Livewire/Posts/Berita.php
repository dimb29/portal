<?php



namespace App\Http\Livewire\Posts;




use App\Models\Image;
use App\Models\Regency;
use App\Models\District;
use App\Models\Post;
use App\Models\User;
// use App\Models\Notification as Notif;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;







class Berita extends Component

{ use WithPagination;

    use WithFileUploads;

    public $search;

    protected $listeners = [
        'searchData',
    ];

    public function searchData($data){
        $this->search = $data;
    }

    public function mount($data){
        $this->search = $data;
    }

    public function render(){

        $posts = Post::with('author')->orderBy('created_at', 'DESC');
        if($this->search != null){
            $searchdata = explode(' ', $this->search);
            foreach($searchdata as $searchdt){
                $posts->where(function($q) use($searchdt){
                    $q->where('title', 'like', '%'.$searchdt.'%')
                    ->orWhere('content', 'like', '%'.$searchdt.'%')
                    ->orWhereHas('author', function($que) use($searchdt){
                        $que->where('name', 'like', '%'.$searchdt.'%');
                    })
                    ->orWhereHas('regency', function($que) use($searchdt){
                        $que->where('name', 'like', '%'.$searchdt.'%');
                    })
                    ->orWhereHas('district', function($que) use($searchdt){
                        $que->where('name', 'like', '%'.$searchdt.'%');
                    });
                });
            }
        }
        $allposts = $posts->get();
        return view('livewire.posts.berita', [
            'allposts' => $allposts,
        ]);
    }

}

