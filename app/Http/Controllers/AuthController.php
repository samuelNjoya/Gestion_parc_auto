<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        // echo Hash::make(123456);
        // die;
        // dd(Hash::make(123456));
        return view('auth.login');
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }

    public function auth_login(Request $request){
           //dd($request->all());
        //    $this->validate($request, [
        //     'email'   => 'required|email',
        //     'password' => 'required|min:6'
        // ]);
           if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_delete' => 0, 'statut' => 1], true)){

            //  if(Auth::user()->role == 3)
            //  {
            //     return redirect('comptable/dashboard');
            //  }else if(Auth::user()->role == 4)
            //  {
            //     return redirect('conducteur/dashboard');
            //  }else
            //  {
            //     return redirect('panel/dashboard');
            //  }
           
             return redirect('panel/dashboard');
            
           }else{

            return redirect()->back()->with('error','Entrer un email ou password valide');
           }
    }

    public function forgot(){
        return view('auth.forgot');
       
    }
}
