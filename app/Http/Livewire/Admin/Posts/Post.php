<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\Image;
use App\Models\Post as Posts;
use App\Models\Regency;
use App\Models\District;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Notification as Notif;
use App\Models\NotifTemplate as NotifTemp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
class Post extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $author, $title, $content, $post_id, $views, $tag, $tags, $search_tag, $category, $categories, $verify, $desc_verif;
    public $location,$location_district,$location_regency, $inloc, $listloc, $showloc, $getdataloc;
    public $jenkeres = array(), $kualifes = array(), $pengkerjases = array();
    public $spesialisess = array(), $tingkeres = array(),$regencies = array();
    public $multitle = array(),$multitles = array(),$Multiloc = array();
    public $photos = [], $countpost;
    public $isOpen = 0,$isVerify = 0;
    public $locinput, $search, $short, $filter_verif, $desc, $descOn = false;
    protected $listeners = [
        'multiLoc',
        'dataFillArray',
    ];
    public function multiLoc($title){
        $this->location = $title;
    }
    public function dataFillArray($dataFillArray){
        $this->regencies = $dataFillArray[0];
        if($dataFillArray[6] != null){
            $this->multitle = $dataFillArray[6];
        }else{
            $this->multitle = $this->title;
        }
        $this->content =  $dataFillArray[7];
        // $this->regencies = $dataFillArray;
        $this->store();
    }

    public function mount(){
        $this->tags = Tag::orderBy('created_at', 'DESC')->get();
        $this->categories = Category::orderBy('created_at', 'DESC')->get();
    }
    public function render()
    {
        $posts = Posts::with('author');
        if($this->search){
            $searchdata = explode(' ', $this->search);
            foreach($searchdata as $searchdt){
                $posts->where(function($q) use($searchdt){
                    $q->where('title', 'like', '%'.$searchdt.'%')
                    ->orWhere('id', 'like', '%'.$searchdt.'%')
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
        if($this->short){
            switch($this->short){
                case 1:
                    $posts->orderBy('title', 'ASC');
                    break;
                case 2:
                    $posts->orderBy('title', 'DESC');
                    break;
                case 3:
                    $posts->orderBy('created_at', 'DESC');
                    break;
                case 4:
                    $posts->orderBy('created_at', 'ASC');
                    break;
            }
        }
        if($this->filter_verif){
            switch($this->filter_verif){
                case 1:
                    $posts->where('verified', 0);
                    break;
                case 2:
                    $posts->where('verified', 1);
                    break;
                case 3:
                    $posts->where('verified', 2);
                    break;
            }
        }
        $posts = $posts->paginate(20);
        $types = NotifTemp::all();

        return view('livewire.admin.posts.post', [
            "posts" => $posts,
            'types' => $types,
        ]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'photos.*' => 'image|max:4000',
        ]);
        // Update or Insert Post
        $post = Posts::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'content' => $this->content,
            'author_id' => Auth::user()->id,
        ]);

        // Image upload and store name in db
        if($this->photos != null){
            if (count($this->photos) > 0) {
                $geturl = Image::where('post_id', $post->id)->get();
                if($geturl != null){
                    // dd($geturl);
                    foreach($geturl as $getimgs){
                        // dd($getimgs->url);
                        Storage::disk('public_uploads')->delete($getimgs->url);
                    }
                    Image::where('post_id', $post->id)->delete();
                }
                $counter = 0;
                foreach ($this->photos as $photo) {

                    // $storedImage = $photo->store('public/photos');
                    $storepublic = Storage::disk('public_uploads')->put('storage/photos/post', $photo);
                    $featured = false;
                    if($counter == 0 ){
                        $featured = true;
                    }
                    // $imgtitle = $this
                    Image::create([
                        'url' => $storepublic,
                        'title' => $this->title,
                        'post_id' => $post->id,
                        'featured' => $featured
                    ]);
                    $counter++;
                }
            }
        }

        if(count($this->category) > 0){
            DB::table('category_post')->where('post_id', $post->id)->delete();

            foreach($this->category as $category){
                $split = explode('-', $category);
                $cate_id = $split[0];
                DB::table('category_post')->insert([
                    'post_id' => $post->id,
                    'category_id' => $cate_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Post Tag mapping
        if (count($this->tag) > 0) {
            DB::table('post_tag')->where('post_id', $post->id)->delete();

            foreach ($this->tag as $tag) {
                $split = explode('-', $tag);
                $tag_id = $split[0];
                $getag = Tag::where('id', $tag_id)->first();
                if($getag){
                    $addtag = DB::table('post_tag')->insert([
                        'post_id' => $post->id,
                        'tag_id' => $getag->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }else{
                    $addtag = Tag::updateOrCreate(['id' => $tag],[
                        'title' => $tag,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    DB::table('post_tag')->insert([
                        'post_id' => $post->id,
                        'tag_id' => $addtag->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
        if($this->location != null){
            if (count($this->location) > 0) {
                // dd($this->location);
                $post_title_reg = DB::table('post_regency')->where('post_id', $post->id)->delete();
                $post_title_dist = DB::table('district_post')->where('post_id', $post->id)->delete();
                foreach ($this->location as $loc) {
                    $getlocid = Regency::where('name', 'LIKE', '%'.$loc.'%')->first();
                    if($getlocid != null){
                        DB::table('post_regency')->insert([
                            'post_id' => $post->id,
                            'regency_id' => $getlocid->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }else{
                        $getlocid = District::where('name', 'LIKE', '%'.$loc.'%')->first();
                        DB::table('district_post')->insert([
                            'post_id' => $post->id,
                            'district_id' => $getlocid->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }
        
        session()->flash(
            'message',
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        // DB::table('post_regency')->where('post_id', $id)->delete();
        // DB::table('post_save')->where('post_id', $id)->delete();
        
        $geturl = Image::where('post_id', $id)->first();
        if($geturl != null){
            Storage::disk('public_uploads')->delete($geturl->url);
            Image::where('post_id', $id)->delete();
        }
        DB::table('images')->where('post_id', $id)->delete();
        Posts::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $post = Posts::findOrFail($id);

        $this->post_id = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->tag = $post->tags->pluck('id');
        foreach($this->tag as $key => $tag){
           $this->tag[$key] = $tag.'-tag';
        }
        $this->category = $post->category->pluck('id');
        foreach($this->category as $key => $category){
           $this->category[$key] = $category.'-category';
        }
        $this->location_regency = $post->regency;
        $this->location_district = $post->district;

        $this->openModal();
    }

    public function locationSearch(){
        
        $query = $this->inloc;
        $filterResult = Regency::where('name', 'LIKE', '%'. $query. '%')->get();
        if(count($filterResult) < 1){
            $filterResult = District::where('name', 'LIKE', '%'. $query. '%')->get();
        }
        $this->listloc = $filterResult;
        // session()->flash('listlocs', 'cekcekcek');
        // dd($this->listloc);
    }
    public function changeType($value){
        $this->verify = $value;
        if($value){
            $get_temp = NotifTemp::find($value);
            $this->title = $get_temp->title;
            $this->desc = $get_temp->desc;
        }else{
            $this->title = null;
            $this->desc = null;
        }
    }
    public function isDefault($value){
        if($this->descOn){
            $this->descOn = true;
            $this->changeType($this->verify);
        }else{
            $this->descOn = false;
            $get_temp = NotifTemp::find($this->verify);
            if($get_temp){
                $this->title = $get_temp->name_tag;
            }else{
                $this->title = null;
            }
            $this->desc = null;
        }
    }
    public function verifyStore()
    {
        if($this->verify){
            $post = Posts::where('id', $this->post_id)->update([
                'verified' => $this->verify,
            ]);
            $notif_id = null;
            $notif = Notif::updateOrCreate(['id' => $notif_id], [
                'title' => $this->title,
                'desc' => $this->desc,
                'type' => $this->verify,
                'to' => $this->author->id,
                'from' => Auth::user()->id,
                'post_id' => $this->post_id,
            ]);
        }
        if($this->verify == 1): 
            $message = 'Post has been verified'; 
        else: 
            $message = 'Post has been canceled'; 
        endif;
        session()->flash('message',$message);
        $this->closeVerify();
    }
    public function verify($id){
        $verify = Posts::find($id);
        $this->post_id = $id;
        $this->verify = $verify->verified;
        $this->author = $verify->author;
        $this->openVerify();
    }

    public function create()
    {
        $this->openModal();
        $this->resetInputFields();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }
    public function openVerify(){
        $this->isVerify = true;
    }
    public function closeVerify(){
        $this->isVerify = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->verify = null;
        $this->title = null;
        $this->content = null;
        $this->photos = null;
        $this->post_id = null;
        $this->location_regency = null;
        $this->location_district = null;
        $this->search_tag = null;
    }
}
