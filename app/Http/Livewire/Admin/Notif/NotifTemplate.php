<?php

namespace App\Http\Livewire\Admin\Notif;

use Livewire\Component;
use App\Models\NotifTemplate as Notif;

class NotifTemplate extends Component
{
    public $search, $short, $isOpen, $notif_id, $title, $isNotif, $name_tag, $desc, $descOn;
    public function render()
    {
        $notifications = Notif::with('notif');
        if($this->search){
            $searchdata = explode(' ', $this->search);
            foreach($searchdata as $searchdt){
                $notifications->where(function($q) use($searchdt){
                    $q->where('title', 'like', '%'.$searchdt.'%')
                    ->orWhere('name_tag', 'like', '%'.$searchdt.'%')
                    ->orWhere('id', 'like', '%'.$searchdt.'%');
                });
            }
        }
        if($this->short){
            switch($this->short){
                case 1:
                    $notifications->orderBy('title', 'ASC');
                    break;
                case 2:
                    $notifications->orderBy('title', 'DESC');
                    break;
                case 3:
                    $notifications->orderBy('created_at', 'DESC');
                    break;
                case 4:
                    $notifications->orderBy('created_at', 'ASC');
                    break;
            }
        }
        $notifications = $notifications->paginate(20);
        return view('livewire.admin.notif.notif-template', [
            'notifications' => $notifications,
        ]);
    }
    public function store(){
        $this->validate([
            'name_tag' => 'required',
            'title' => 'required',
        ]);
        $notif = Notif::updateOrCreate(['id' => $this->notif_id], [
            'name_tag' => $this->name_tag,
            'title' => $this->title,
            'desc' => $this->desc,
        ]);

        session()->flash('message', $this->notif_id ? 'Notifiction Updated Successfully!' : 'Notifiction Created Successfully!');
        $this->closeModal();
    }
    public function create(){
        $this->openModal();
    }
    public function edit($id){
        $notif = Notif::find($id);
        $this->notif_id = $notif->id;
        $this->title = $notif->title;
        $this->name_tag = $notif->name_tag;
        $this->desc = $notif->desc;
        $this->openModal();
    }
    public function delete($id){
        $delete = Notif::find($id)->delete();
    }
    public function openModal(){
        $this->isOpen = true;
    }
    public function closeModal(){
        $this->isOpen = false;
        $this->resetInputField();
    }
    public function resetInputField(){
        $this->notif_id = null;
        $this->title = null;
        $this->name_tag = null;
        $this->desc = null;
    }
}
