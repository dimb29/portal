<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;
use App\Models\Comment as Comments;
use App\Models\Likes;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Comment extends Component
{
    public $komen, $authid, $authtype, $post_id;

    public function render()
    {
        if(Auth::user()){
            $authid = $this->authid = Auth::user()->id;
            $authtype = $this->authtype = 'user';
        }
        $post = Post::where('id', $this->post_id)->first();
        $comments = Comments::with(['child', 'like', 'author'])->where(['parent_id' => NULL, 'post_id' => $post->id])->get();
        // dd($comments);
        return view('livewire.comment.comment', [
            'comments' => $comments,
            'post' => $post,
        ]);
    }

    public function sendComment($data){
        dd($data);
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
