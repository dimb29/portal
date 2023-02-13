<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post as PostModel;
use App\Models\User;
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

    public $post, $isOpen = 0, $isSuccess = 0;
    public $cv, $acv, $more_info, $post_id;

    public function mount($id)
    {
        $post = $this->post = PostModel::with([
            'author', 
            'images', 
            'videos', 
            ])->find($id);
        if($post->verified == 0 || $post->verified == 2){
            return redirect('dashboard');
        }
        if(Auth::user() != null){
            $this->acv = Auth::user()->cv;
        }

        
    }

    public function render()
    {
        
        
        $jobsave = PostModel::rightJoin('post_save', 'posts.id', 'post_save.post_id')->get();
        

        return view('livewire.posts.post', [

        'simpan_job' => $jobsave,
    ]);
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
