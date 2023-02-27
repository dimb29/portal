<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Models\Ads;
use App\Models\AdsType;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;

class AdsList extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $isOpen, $search, $short, $ads_id, $title, $client, $photos, $type, $url, $types = [];
    public function render()
    {
        $ads = Ads::with('get_type');
        if($this->search){
            $searchdata = explode(' ', $this->search);
            foreach($searchdata as $searchdt){
                $ads->where(function($q) use($searchdt){
                    $q->where('title', 'like', '%'.$searchdt.'%')
                    ->orWhere('id', 'like', '%'.$searchdt.'%');
                });
            }
        }
        if($this->short){
            switch($this->short){
                case 1:
                    $ads->orderBy('title', 'ASC');
                    break;
                case 2:
                    $ads->orderBy('title', 'DESC');
                    break;
                case 3:
                    $ads->orderBy('created_at', 'DESC');
                    break;
                case 4:
                    $ads->orderBy('created_at', 'ASC');
                    break;
            }
        }
        $ads_fix = $ads->paginate(20);
        // dd($ads_fix);
        return view('livewire.admin.ads.ads-list',[
            'ads' => $ads_fix,
        ]);
    }
    public function store(){
        $this->validate([
            'title' => 'required',
        ]);
        $ads = Ads::updateOrCreate(['id' => $this->ads_id], [
            'title' => $this->title,
            'client' => $this->client,
            'type' => $this->type,
            'url' => $this->url,
        ]);
        if(($this->photos != null) && ($this->photos != $ads->images)){
            Storage::disk('public_uploads')->delete($ads->images);
            
            $counter = 0;
                // $storedImage = $photo->store('public/photos');
                $storepublic = Storage::disk('public_uploads')->put('storage/photos/ads', $this->photos);
                $featured = false;
                if($counter == 0 ){
                    $featured = true;
                }
                // $imgtitle = $this
                Ads::where(['id' => $ads->id])->update([
                    'images' => $storepublic,
                ]);
        }

        session()->flash('message', $this->ads_id ? 'Ads Updated Successfully!' : 'Ads Created Successfully!');
        $this->closeModal();
    }
    public function create(){
        $this->types = AdsType::all();
        $this->openModal();
    }
    public function edit($id){
        $ads = Ads::find($id);
        $this->ads_id = $ads->id;
        $this->title = $ads->title;
        $this->type = $ads->type;
        $this->types = AdsType::all();
        $this->client = $ads->client;
        $this->photos = $ads->images;
        $this->url = $ads->url;
        $this->openModal();
    }
    public function delete($id){
        $delete = Ads::find($id)->delete();
    }
    public function openModal(){
        $this->isOpen = true;
    }
    public function closeModal(){
        $this->isOpen = false;
        $this->resetInputField();
    }
    public function resetInputField(){
        $this->ads_id = null;
        $this->title = null;
        $this->type = null;
        $this->types = [];
        $this->client = null;
        $this->photos = null;
        $this->url = null;
    }
}
