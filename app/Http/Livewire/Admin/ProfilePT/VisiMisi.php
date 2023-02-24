<?php

namespace App\Http\Livewire\Admin\ProfilePT;

use App\Models\PtProfile;
use Livewire\Component;

class VisiMisi extends Component
{
    public $isOpen, $vimi_id, $desc;
    public function render()
    {
        $vimi = PtProfile::first();
        return view('livewire.admin.profile-pt.visi-misi',[
            'vimi' => $vimi,
        ]);
    }

    public function store(){
        $this->validate([
            'desc' => 'required'
        ]);

        $post = PtProfile::updateOrCreate(['id' => $this->vimi_id], [
            'visi_misi' => $this->desc,
        ]);

        session()->flash('message', 'Tentang kami berhasil diperbarui.');
        $this->closeModal();
    }

    public function edit($id){
        $getpt = PtProfile::find($id);
        if($getpt){
            $this->desc = $getpt->visi_misi;
            $this->vimi_id = $getpt->id;
        }
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen = true;
    }
    public function closeModal(){
        $this->isOpen = false;
        $this->resetInputField();
    }

    public function resetInputField(){
        $this->desc = null;
        $this->vimi_id = null;
    }
}
