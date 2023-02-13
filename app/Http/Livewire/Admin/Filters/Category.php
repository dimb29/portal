<?php

namespace App\Http\Livewire\Admin\Filters;

use Livewire\Component;
use App\Models\Category as Cate;

class Category extends Component
{
    public $search, $short, $isOpen, $cate_id, $title;
    public function render()
    {
        $categories = Cate::with('posts');
        if($this->search){
            $searchdata = explode(' ', $this->search);
            foreach($searchdata as $searchdt){
                $categories->where(function($q) use($searchdt){
                    $q->where('title', 'like', '%'.$searchdt.'%')
                    ->orWhere('id', 'like', '%'.$searchdt.'%');
                });
            }
        }
        if($this->short){
            switch($this->short){
                case 1:
                    $categories->orderBy('title', 'ASC');
                    break;
                case 2:
                    $categories->orderBy('title', 'DESC');
                    break;
                case 3:
                    $categories->orderBy('created_at', 'DESC');
                    break;
                case 4:
                    $categories->orderBy('created_at', 'ASC');
                    break;
            }
        }
        $categories = $categories->paginate(20);
        return view('livewire.admin.filters.category',[
            'categories' => $categories,
        ]);
    }
    public function store(){
        $this->validate([
            'title' => 'required',
        ]);
        $category = Cate::updateOrCreate(['id' => $this->cate_id], [
            'title' => $this->title,
        ]);

        session()->flash('message', $this->cate_id ? 'Category Updated Successfully!' : 'Category Created Successfully!');
        $this->closeModal();
    }
    public function create(){
        $this->openModal();
    }
    public function edit($id){
        $category = Cate::find($id);
        $this->cate_id = $category->id;
        $this->title = $category->title;
        $this->openModal();
    }
    public function delete($id){
        $delete = Cate::find($id)->delete();
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
