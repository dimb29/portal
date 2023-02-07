<?php
namespace App\Http\Livewire\Posts;

use App\Models\Image;
use App\Models\Post;
use App\Models\Regency;
use App\Models\District;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;


class Posts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $title, $content, $post_id, $views, $tag, $tags, $search_tag, $category, $categories;
    public $location,$location_district,$location_regency, $inloc, $listloc, $showloc, $getdataloc;
    public $jenkeres = array(), $kualifes = array(), $pengkerjases = array();
    public $spesialisess = array(), $tingkeres = array(),$regencies = array();
    public $multitle = array(),$multitles = array(),$Multiloc = array();
    public $photos = [], $countpost;
    public $isOpen = 0,$isOpen2 = 0;
    public $locinput;
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
        if(Auth::user()){
            $userId = Auth::user()->id;
            if(Auth::user()->user_type == "administr"){
                $posts = Post::with('author')->orderBy('id', 'desc')->paginate();
            }else{
                $posts = Post::with('author')->where('author_id',$userId)->orderBy('id', 'desc')->paginate();
            }
            $this->countpost = count($posts);
            $return = view('livewire.posts.posts', [
                'posts' =>  $posts,
            ]);
        }
        if($return){
            return $return;
        }else{
            return view('livewire.main');
        }
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'photos.*' => 'image|max:4000',
        ]);
        // Update or Insert Post
        $post = Post::updateOrCreate(['id' => $this->post_id], [
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
                DB::table('category_post')->insert([
                    'post_id' => $post->id,
                    'category_id' => $category,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Post Tag mapping
        if (count($this->tag) > 0) {
            DB::table('post_tag')->where('post_id', $post->id)->delete();

            foreach ($this->tag as $tag) {
                $getag = Tag::where('id', $tag)->first();
                if($getag){
                    DB::table('post_tag')->insert([
                        'post_id' => $post->id,
                        'tag_id' => $tag,
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
        Post::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $this->resetInputFields();
        $post = Post::findOrFail($id);

        $this->post_id = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->tag = $post->tags->pluck('id');
        $this->category = $post->category->pluck('id');
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
    public function openModal2(){
        $this->isOpen2 = true;
    }
    public function closeModal2(){
        $this->isOpen2 = false;
    }

    private function resetInputFields()
    {
        $this->title = null;
        $this->content = null;
        $this->photos = null;
        $this->post_id = null;
        $this->location_regency = null;
        $this->location_district = null;
        $this->search_tag = null;
    }
}
