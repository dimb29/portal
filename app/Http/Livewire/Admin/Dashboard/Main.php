<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Main extends Component
{
    public function render()
    {
        $posts = Post::all();
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::all();
        $chart_post = Post::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('month_name'))
        ->orderBy('id', 'ASC')
        ->pluck('count', 'month_name');
        $post_labels = $chart_post->keys();
        $post_data = $chart_post->values();
        // dd($chart_post);
        return view('livewire.admin.dashboard.main', [
            'posts' => $posts,
            'users' => $users,
            'categories' => $categories,
            'tags' => $tags,
            'post_labels' => $post_labels,
            'post_data' => $post_data,
        ]);
    }
}
