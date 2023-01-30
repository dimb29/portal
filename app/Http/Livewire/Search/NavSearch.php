<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;
use App\Models\User;
use App\Models\Post as News;
use App\Models\OnClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NavSearch extends Component
{
    public $select_type=1,$search_bar,$users,$array_select,$usid,$emid;

    // public function mount() {
    //     $this->selectType(1);
    // }

    public function render() {   
        if($this->search_bar):
            $search_news = News::orderBy('created_at', 'DESC');

            $searchbars = explode(' ', $this->search_bar);
            foreach($searchbars as $searchbar){
                $search_news->where(function($q) use ($searchbar){
                    $q->where('title', 'like', '%'.$searchbar.'%')
                    ->orWhere('content', 'like', '%'.$searchbar.'%')
                    ->orWhereHas('author', function($que) use($searchbar){
                        $que->where('name', 'like', '%'.$searchbar.'%');
                    })
                    ->orWhereHas('regency', function($que) use($searchbar){
                        $que->where('name', 'like', '%'.$searchbar.'%');
                    })
                    ->orWhereHas('district', function($que) use($searchbar){
                        $que->where('name', 'like', '%'.$searchbar.'%');
                    });
                });
            }
            $search_news = $search_news->take(10)->get();
            // dd([$search_news, $search_user, $search_employer]);
        else:
            $search_news = null;
        endif;
        return view('livewire.search.nav-search', [
            'search_news' => $search_news,
        ]);
    }

    public function closeModal() {
        //
    }

}
