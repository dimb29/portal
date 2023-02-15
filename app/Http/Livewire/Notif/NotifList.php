<?php

namespace App\Http\Livewire\Notif;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification as Notif;
use App\Models\Follow;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
class NotifList extends Component
{
    public $isOpen = 0, $nofid, $notiv, $star,$usid, $receivedatachat;

    protected $listeners = [
        'receiveChat',
    ];

    public function mount(Request $request){
        $getrequest = $request->all();
        if(count($getrequest) > 0){
            if(array_key_exists('receivedatachat', $getrequest)){
                $arr_request = $getrequest['receivedatachat'];
                $this->receiveChat($arr_request);
            }
        }
    }
    
    public function render()
    {
        $this->usid = Auth::user()->id;
        $notifs = Notif::with('notif_employer')->where('to', $this->usid)->orderBy('created_at', 'DESC')->get();
        return view('livewire.notif.notif-list',[
            'notifs' => $notifs,
        ]);
    }

    public function selectNotif($id){
        $this->star = $id;
        if($id):
            $this->notifs = Notif::with('notif_employer')->where(['to' => $this->usid, 'save' => 1])->orderBy('created_at', 'DESC')->get();
        else:
            $this->notifs = Notif::with('notif_employer')->where('to', $this->usid)->orderBy('created_at', 'DESC')->get();
        endif;
        if($this->isOpen){
            $this->isOpen = false;
        }
    }

    public function save($id){
        $save = Notif::where('id', $id)->update(['save' => 1]);
        session()->flash('message', 'Notifikasi berbintang berhasil ditambahkan.');
        // return redirect()->route('notif');
        $this->emit('alert_remove');
        $this->selectNotif($this->star);
        return;
    }
    public function delsave($id){
        $save = Notif::where('id', $id)->update(['save' => 0]);
        session()->flash('message', 'Notifikasi berbintang dihapus.');
        // return redirect()->route('notif');
        $this->emit('alert_remove');
        $this->selectNotif($this->star);
        return;
    }

    public function delete($id){
        $delete = Notif::where('id', $id)->delete();
        session()->flash('message', 'Notifikasi berhasil dihapus');
        // return redirect()->route('notif');
        $this->selectNotif($this->star);
    }

    public function follbackUser($data){
        // dd($data);
        $this->nofid = $data[0];
        $addFollow = Follow::create([
            'follower_id' => $data[1],
            'following_id' => $data[2],
        ]);
        $this->readNotif();
        session()->flash('message', 'Relasi berhasil ditambahkan.');
        // return redirect()->route('notif');
    }
    public function clickOpen($id){
        // dd([$this->nofid, $this->isOpen, $this->notiv]);
        $this->nofid = $id;
        $this->readNotif();
        $this->isOpen = true;
    }
    
    public function clickClose(){
        $this->selectNotif($this->star);
        $this->isOpen = false;
        $this->emit('alert_remove');
        session()->flash('message', 'Mengambil data...');
    }
    public function readNotif(){
        if($this->nofid != null){
            $this->notiv = Notif::where('id', $this->nofid)->first();
            if($this->notiv->read == 1){
                $read = Notif::where('id', $this->nofid)->update(['read' => '0']);
            }
        }
    }

    public function receiveChat($data){
        $getnotif = Notif::where(['notif_type' => $data[1], 'post_id' => $data[0]])->first();
        // dd($getnotif);
        $this->selectNotif($getnotif->save);
        $this->clickOpen($getnotif->id);
    }
    
    public function openChat($id){
        $userid = $id[0];
        $user_type = $id[1];
        if(count($id) == 3){
            $post_id = $id[2];
            $data = $userid."&".$user_type."&".$post_id;
        }elseif(count($id) == 4){
            $post_id = $id[2];
            $is_complain = $id[3];
            $data = $userid."&".$user_type."&".$post_id."&".$is_complain;
        }else{
            $data = $userid."&".$user_type;
        }
        $hash = Crypt::encryptString($data);
        // $dechash = Crypt::decryptString($data);
        if($user_type == 'user'){
            // return redirect()->to('user/chat/'.$hash);
                $this->emit('receiveChatSignal', $hash);
        }
    }
}
