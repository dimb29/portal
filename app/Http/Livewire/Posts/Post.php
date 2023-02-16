<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post as PostModel;
use App\Models\User;
use App\Models\Comment as Comments;
use App\Models\Likes;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;

class Post extends Component
{
    use WithFileUploads;

    public $isOpen = 0, $isSuccess = 0;
    public $cv, $acv, $more_info, $post_id, $authid, $authtype, $response_like;

    protected $listeners = [
        'responseLike',
    ];

    public function mount($id)
    {
        // if(Auth::user() != null){
        //     $this->acv = Auth::user()->cv;
        // }
        $this->post_id = $id;
    }

    public function responseLike($bool){
        $response_like = $bool;
    }

    public function render()
    {
        $post = PostModel::with([
            'author', 
            'images', 
            'videos', 
            ])->where('id', $this->post_id)->first();
        if($post->verified == 0 || $post->verified == 2){
            return redirect('dashboard');
        }
        if(Auth::user()){
            $authid = $this->authid = Auth::user()->id;
            $authtype = $this->authtype = 'user';
        }
        $jobsave = PostModel::rightJoin('post_save', 'posts.id', 'post_save.post_id')->get();
        return view('livewire.posts.post', [
        'post' => $post,
        'simpan_job' => $jobsave,
    ]);
    }

    public function LikeIt($data){
        if($this->authid){
            $post_id = $data[0];
            $comment_id = null;
            $like = Likes::create([
                'post_id' =>$post_id,
                'user_id' => $this->authid,
                'user_type' => $this->authtype,
            ]);
            $this->emit('refreshMenu', 'true');
        }else{
            return redirect('/login');
        }
    }

    public function UnLikeIt($data){
        if($this->authid){
            $delete_like = Likes::where([
                'post_id' => $data[0],
                'user_id' => $this->authid,
                'user_type' => $this->authtype,
            ])->delete();
            $this->emit('refreshMenu', 'true');
        }else{
            return redirect('/login');
        }
    }

    public function saveJob($id){

        DB::table('post_save')->insert([

            'user_id' => Auth::user()->id,

            'post_id' => $id,

            'created_at' => now(),

            'updated_at' => now(),

        ]);

    }



    public function delSaveJob($id){

        DB::table('post_save')->where('post_id', $id)->delete();

    }

    public function openModal(){
        if(Auth::user() != null){
            $this->isOpen = true;
        }else{
            return redirect()->route('login');
        }
    }

    public function successModal(){
        $this->isSuccess = true;
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->isSuccess = false;
    }
}
