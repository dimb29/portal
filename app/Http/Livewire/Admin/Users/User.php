<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User as users;

class User extends Component
{
    public $search, $short, $isOpen, $name, $email, $password, $user_type, $user_id;
    public function render()
    {
        $users = Users::with('likes');
        if($this->search){
            $searchdata = explode(' ', $this->search);
            foreach($searchdata as $searchdt){
                $users->where(function($q) use($searchdt){
                    $q->where('name', 'like', '%'.$searchdt.'%')
                    ->orWhere('id', 'like', '%'.$searchdt.'%')
                    ->orWhere('user_type', 'like', '%'.$searchdt.'%')
                    ->orWhere('email', 'like', '%'.$searchdt.'%');
                });
            }
        }
        if($this->short){
            switch($this->short){
                case 1:
                    $users->orderBy('name', 'ASC');
                    break;
                case 2:
                    $users->orderBy('name', 'DESC');
                    break;
                case 3:
                    $users->orderBy('created_at', 'DESC');
                    break;
                case 4:
                    $users->orderBy('created_at', 'ASC');
                    break;
                case 5:
                    $users->where('user_type', 'administr');
                    break;
                case 6:
                    $users->where('user_type', 'editrx');
                    break;
                case 7:
                    $users->where('user_type', 'user');
                    break;
            }
        }
        $users = $users->paginate(20);
        return view('livewire.admin.users.user', [
            'users' => $users,
        ]);
    }
    public function store(){
        $this->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = Users::updateOrCreate(['id' => $this->user_id],[
            'name' => $this->name,
            'email' => $this->email,
            'user_type' => $this->user_type,
            'password' =>  Hash::make($this->password),
        ]);
        if(!$this->user_id){
            $sp_name = explode(' ', $user->name);
            DB::table('teams')->insert([
                'user_id' => $user->id,
                'name' => $sp_name[0]."'s Team",
                'personal_team' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        session()->flash('message', $this->user_id ? 'User Updated Successfully!' : 'User Created Successfully!');
        $this->closeModal();
    }
    public function create(){
        $this->openModal();
    }
    public function edit($id){
        $user = Users::find($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->user_type = $user->user_type;
        $this->openModal();
    }
    public function delete($id){
        $delete = Users::find($id)->delete();
        session()->flash('message', 'User Deleted Successfully!');
    }
    public function openModal(){
        $this->isOpen = true;
    }
    public function closeModal(){
        $this->isOpen = false;
        $this->resetInputField();
    }
    public function resetInputField(){
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->user_type = null;
    }
}
