<?php

namespace App\Http\Livewire\ProfilPt;

use App\Models\PtProfile;
use Livewire\Component;

class AboutUs extends Component
{
    public $isOpen, $about_id, $desc;
    public function render()
    {
        $about = PtProfile::first();
        return view('livewire.profil-pt.about-us',[
            'about' => $about,
        ]);
    }
}
