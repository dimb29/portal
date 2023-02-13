<?php

namespace App\Http\Livewire\Layouts;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Comment;
// use App\Models\Regency;
// use App\Models\District;
// use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Str;
use Livewire\Component;

class RightMenu extends Component
{
    public function render()
    {
        $populers = Post::take(10)->orderBy('views', 'DESC')->where('verified', 1)->get();
        $choices = Post::take(10)->orderBy('updated_at', 'DESC')->where('verified', 1)->where('selected', 1)->get();
        $comments = Comment::withCount('like')
                            ->orderBy('like_count', 'desc')
                            ->take(10)->get();
        // dd($choices);
        return view('livewire.layouts.right-menu',[
            'populers' => $populers,
            'comments' => $comments,
            'choices' => $choices,
        ]);
    }
}
