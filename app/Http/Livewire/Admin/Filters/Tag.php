<?php

namespace App\Http\Livewire\Admin\Filters;

use Livewire\Component;
use App\Models\Tag as Tags;

class Tag extends Component
{
    public $search, $short, $isOpen, $tag_id, $title;
    public function render()
    {
        $tags = Tags::with('posts');
        if($this->search){
            $searchdata = explode(' ', $this->search);
            foreach($searchdata as $searchdt){
                $tags->where(function($q) use($searchdt){
                    $q->where('title', 'like', '%'.$searchdt.'%')
                    ->orWhere('id', 'like', '%'.$searchdt.'%');
                });
            }
        }
        if($this->short){
            switch($this->short){
                case 1:
                    $tags->orderBy('title', 'ASC');
                    break;
                case 2:
                    $tags->orderBy('title', 'DESC');
                    break;
                case 3:
                    $tags->orderBy('created_at', 'DESC');
                    break;
                case 4:
                    $tags->orderBy('created_at', 'ASC');
                    break;
            }
        }
        $tags = $tags->paginate(20);
        return view('livewire.admin.filters.tag',[
            'tags' => $tags,
        ]);
    }
    public function store(){
        $this->validate([
            'title' => 'required',
        ]);
        $category = Tags::updateOrCreate(['id' => $this->tag_id], [
            'title' => $this->title,
        ]);

        session()->flash('message', $this->tag_id ? 'Tag Updated Successfully!' : 'Tag Created Successfully!');
        $this->closeModal();
    }
    public function create(){
        $this->openModal();
    }
    public function edit($id){
        $tag = Tags::find($id);
        $this->tag_id = $tag->id;
        $this->title = $tag->title;
        $this->openModal();
    }
    public function delete($id){
        $delete = Tags::find($id)->delete();
    }
    public function openModal(){
        $this->isOpen = true;
    }
    public function closeModal(){
        $this->isOpen = false;
        $this->resetInputField();
    }
    public function resetInputField(){
        $this->title = null;
    }
}
