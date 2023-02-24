<?php

namespace App\Http\Livewire\ProfilPt;

use App\Models\PtProfile;
use Livewire\Component;

class VisiMisi extends Component
{
    public $isOpen, $vimi_id, $desc;
    public function render()
    {
        $vimi = PtProfile::first();
        return view('livewire.profil-pt.visi-misi',[
            'vimi' => $vimi,
        ]);
    }
}
