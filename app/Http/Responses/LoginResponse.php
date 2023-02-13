<?php
 
namespace App\Http\Responses;
 
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
 
class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // dd(auth()->user()->user_type);
        if(auth()->user()->user_type == 'administr'){
            $home = '/admin';
        }else{
            $home = '/dashboard';
        }
        // $home = auth()->user()->is_admin ? '/admin' : '/dashboard';
 
        return redirect()->intended($home);
    }
}