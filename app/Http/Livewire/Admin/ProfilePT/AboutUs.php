<?php

namespace App\Http\Livewire\Admin\ProfilePT;

use App\Models\PtProfile;
use Livewire\Component;

class AboutUs extends Component
{
    public $isOpen, $about_id, $desc;
    public function render()
    {
        $about = PtProfile::first();
        return view('livewire.admin.profile-pt.about-us',[
            'about' => $about,
        ]);
    }

    public function store(){
        $this->validate([
            'desc' => 'required'
        ]);

        $post = PtProfile::updateOrCreate(['id' => $this->about_id], [
            'about_us' => $this->desc,
        ]);

        session()->flash('message', 'Tentang kami berhasil diperbarui.');
        $this->closeModal();
    }

    public function edit($id){
        $getpt = PtProfile::find($id);
        if($getpt){
            $this->desc = $getpt->about_us;
            $this->about_id = $getpt->id;
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
        $this->about_id = null;
    }
}
