<?php

namespace App\Http\Livewire\Notif;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification as Notif;

class NotifStar extends Component
{
    public $isOpen = 0, $nofid;
    public function mount(){
        $usid = Auth::user()->id;
        $notifs = Notif::with('notif_employer')->where(['to' => $usid, 'save' => 1])->orderBy('created_at', 'DESC')->get();
        $this->notifs = $notifs;
    }
    public function render()
    {
        if($this->nofid != null){
            $notiv = Notif::where('id', $this->nofid)->first();
            if($notiv->read == 1){
                $read = Notif::where('id', $this->nofid)->update(['read' => '0']);
            }
            $this->notiv = $notiv;
        }
        return view('livewire.notif.notif-star');
    }

    public function save($id){
        $save = Notif::where('id', $id)->update(['save' => 1]);
        session()->flash('message', 'Notifikasi berbintang berhasil ditambahkan.');
        return redirect()->route('notif');
    }
    public function delsave($id){
        $save = Notif::where('id', $id)->update(['save' => 0]);
        session()->flash('message', 'Notifikasi berbintang dihapus.');
        return redirect()->route('notif');
    }

    public function delete($id){
        $delete = Notif::where('id', $id)->delete();
        session()->flash('message', 'Notifikasi berhasil dihapus');
        return redirect()->route('notif');
    }
    
    public function clickOpen($id){
        // dd($id);
        $this->nofid = $id;
        $this->isOpen = true;
    }
    
    public function clickClose(){
        $this->isOpen = false;
        return redirect()->route('notif.star');
    }
}
