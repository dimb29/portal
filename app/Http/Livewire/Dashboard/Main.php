<?php



namespace App\Http\Livewire\Dashboard;



use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Regency;
use App\Models\District;
// use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Session as Sessions;
use Session;



class Main extends Component {
    public function render() {
        $posts = Post::orderBy('created_at', 'DESC')->where('verified', 1);
        $headlines = $posts->where('headline', 1)->take(5)->get();
        $allposts = $posts->take(10)->get();
        return view('livewire.dashboard.main',[
            'headlines' => $headlines,
            'allposts' => $allposts,
        ]);
    }
}