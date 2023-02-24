<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Models\Ads;
use Livewire\Component;

class AdsList extends Component
{
    public $isOpen;
    public function render()
    {
        $ads = Ads::with('typelist')->get();
        dd($ads);
        return view('livewire.admin.ads.ads-list',[
            'ads' => $ads,
        ]);
    }
}
