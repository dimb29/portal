<?php

namespace Laravel\Jetstream\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification as Notif;
use Livewire\Component;

class NavigationMenu extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $usid = Auth::user()->id;
        $notifs = Notif::where('to', $usid)->orWhere('to', null)->orderBy('created_at', 'DESC')->get();
        $isread = [];
        foreach($notifs as $notif){
            if(count($notif->readIt) > 0){
                foreach($notif->readIt as $read){
                    if($read->user_id == $usid){
                        $isread [] = $read->user_id;
                    }
                }
            }else{
                $isread = [];
            }
            $notif->setAttribute('read_it', count($isread));
        }
        $cekisread = $notifs->contains('to', 0);
        $countread = $notifs->groupBy('to')->map->count();
        $zerocount = $countread->get("");
        if(Auth::user() != null){
            $mysid = Auth::user()->id;
            $this->mysid = $mysid;
            $myuser = Auth::user()->with('notif_to_user')->whereHas('notif_to_user', function($que){
                $que->where('to', $this->mysid);
            })->first();
            if($myuser != null){
                $notifusers = $myuser->notif_to_user()->sum('read');
                if($cekisread){
                    $sum_read = $notifs->sum('read_it');
                    $read_it = $zerocount - $sum_read;
                }else{
                    $read_it = 0;
                }
            }else{
                $notifusers = null;
            }
        }else{
            $notifusers = null;
            $read_it = 0;
        }
        return view('navigation-menu',[
            'notifusers' => $notifusers,
            'read_it' => $read_it,
        ]);
    }
}
