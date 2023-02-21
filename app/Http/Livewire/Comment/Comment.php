<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;
use App\Models\Comment as Comments;
use App\Models\Likes;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Comment extends Component
{
    public $komen, $authid, $authtype, $post_id;

    public function render()
    {
        $now = Carbon::now();
        $post = Post::where('id', $this->post_id)->first();
        $comments = Comments::with(['child', 'like', 'author'])->where(['parent_id' => NULL, 'post_id' => $post->id])->get();
        if(Auth::user()){
            $authid = $this->authid = Auth::user()->id;
            $authtype = $this->authtype = 'user';
            $mergekomen = [];
            $mergechild = [];
            foreach($comments as $key => $komen){
                $user_like = Likes::where(['comment_id' => $komen->id, 'user_id' => $authid])->first();
                $komen->setAttribute('my_like', $user_like);
                $mergekomen []= $komen;
                foreach($komen->child as $chlid){
                    $child_like = Likes::where(['comment_id' => $chlid->id, 'user_id' => $authid])->first();
                    $chlid->setAttribute('my_like', $child_like);
                    $mergechild [] = $chlid;
                }
                $komen->setAttribute('childs', $mergechild);
            }
        } 
        // dd($comments);
        return view('livewire.comment.comment', [
            'comments' => $mergekomen,
            'post' => $post,
            'thistime' => $now,
        ]);
    }

    public function sendComment($data){
        if($this->authid){
            if($this->komen != null){
                if(count($data) == 1){
                    $comment = Comments::create([
                        'comment' => $this->komen,
                        'post_id' => $data[0],
                        'author_id' => $this->authid,
                        'author_type' => $this->authtype,
                    ]);
                }elseif(count($data) == 2){
                    $comment = Comments::create([
                        'comment' => $this->komen,
                        'post_id' => $data[0],
                        'author_id' => $this->authid,
                        'author_type' => $this->authtype,
                        'parent_id' => $data[1],
                    ]);
                }elseif(count($data) == 3){
                    $comment = Comments::create([
                        'comment' => $this->komen,
                        'post_id' => $data[0],
                        'author_id' => $this->authid,
                        'author_type' => $this->authtype,
                        'parent_id' => $data[1],
                        'parent2_id' => $data[2],
                    ]);
                }
            }
            $this->resetComment();
        }else{
            return redirect('/login');
        }
    }

    public function likeIt($data){
        if($this->authid){
            $this->emit('responseLike', true);
            if(count($data) > 1){
                $post_id = $data[0];
                $comment_id = $data[1];
                $like = Likes::create([
                    'comment_id' => $comment_id,
                    'user_id' => $this->authid,
                    'user_type' => $this->authtype,
                ]);
            }else{
                $post_id = $data[0];
                $comment_id = null;
                $like = Likes::create([
                    'post_id' =>$post_id,
                    'user_id' => $this->authid,
                    'user_type' => $this->authtype,
                ]);
            }
        }else{
            return redirect('/login');
        }
    }

    public function unLikeIt($data){
        $this->emit('responseLike', true);
        if(count($data) > 1){
            $delete_like = Likes::where([
                'comment_id' => $data[1],
                'user_id' => $this->authid,
                'user_type' => $this->authtype,
            ])->delete();
        }else{
            $delete_like = Likes::where([
                'post_id' => $data[0],
                'user_id' => $this->authid,
                'user_type' => $this->authtype,
            ])->delete();
        }
    }

    public function resetComment(){
        $this->komen = null;
    }
}
