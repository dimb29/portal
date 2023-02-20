<?php

namespace App\Http\Livewire\Admin\Notif;

use Livewire\Component;
use App\Models\Notification as Notif;
use App\Models\NotifTemplate as NotifTemp;
use App\Models\User;

class Notification extends Component
{
    
    public $search, $short, $isOpen, $notif_id, $title, $desc, $isNotif = true, $user, $users, $listuser, $inuser, $type;
    protected $listeners = [
        'multiUser',
    ];
    public function multiUser($title){
        $this->user = $title;
    }
    public function render()
    {
        $notifications = Notif::with('post');
        if($this->search){
            $searchdata = explode(' ', $this->search);
            foreach($searchdata as $searchdt){
                $notifications->where(function($q) use($searchdt){
                    $q->where('title', 'like', '%'.$searchdt.'%')
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
        $types = NotifTemp::all();
        // dd($notifications);
        return view('livewire.admin.notif.notification', [
            'notifications' => $notifications,
            'types' => $types,
        ]);
    }
    public function usersSearch(){
        
        $query = $this->inuser;
        $filterResult = User::where('name', 'LIKE', '%'. $query. '%')->get();
        $this->listuser = $filterResult;
        // session()->flash('listlocs', 'cekcekcek');
        // dd($this->listloc);
    }
    public function store(){
        $this->validate([
            'title' => 'required',
            'desc' => 'required',
        ]);
        if($this->user != null){
            foreach($this->user as $user){
                $getuser = user::find($user);
                if($getuser){
                    $notif = Notif::updateOrCreate(['id' => $this->notif_id], [
                        'title' => $this->title,
                        'desc' => $this->desc,
                        'type' => $this->type,
                        'to' => $user,
                    ]);
                }
            }
        }else{
            $notif = Notif::updateOrCreate(['id' => $this->notif_id], [
                'title' => $this->title,
                'desc' => $this->desc,
                'type' => $this->type,
                'to' => null,
            ]);
        }

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
        $this->desc = $notif->desc;
        $this->openModal();
        $this->users = $notif->userTo;
        $this->type = $notif->template->id;
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
        $this->title = null;
        $this->type = null;
        $this->desc = null;
        $this->user = null;
        $this->users = null;
        $this->listuser = null;
        $this->inuser = null;
    }
}
