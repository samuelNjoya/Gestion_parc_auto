<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

   public function mon_compte(){
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['meta_title'] = "mon compte";
        return view('backend.profile',$data);
   }

   public function update_account(Request $request){

       $user = User::getSingle(Auth::user()->id);
       $user->nom = trim($request->nom);
       $user->address = trim($request->address);
       $user->email = trim($request->email);
       $user->telephone = trim($request->phone);
       

       if(!empty($request->file('profile_pic'))){
        $ext = $request->file('profile_pic')->getClientOriginalExtension();
        $file = $request->file('profile_pic');
        $randomStr = date('Ymdhis').Str::random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('upload/profile/', $filename);

        $user->profile_pic = $filename;
      
    }
    

    $user->save();

    return redirect()->back()->with('success','compte mis a jour avec success');
   }


    public function changer_password(){
        $data['meta_title'] = "Changer password";
         return view('backend.change_password',$data);
    }

    public function update_password(Request $request)
    {
       if($request->new_password == $request->confirm_password)
       {
          $user = User::getSingle(Auth::user()->id);
          if(Hash::check($request->old_password, $user->password))
          {
             $user->password = Hash::make($request->new_password);
             $user->save();

             return redirect()->back()->with('success','password mis a jour avec success');
          }
          else
          {
            return redirect()->back()->with('error','ancien mot de pass pas correct');
          }
       }
       else
       {
        return redirect()->back()->with('error','les mots de pass ne correspondent pas');
       }
    }

    public function aide(){
      $data['meta_title'] = "Aide";
      return view('backend.aide',$data);
    }


    //conducteur voir ses vehicules affecter
   public function myVehicles()
    {
        // Récupérer l'utilisateur authentifié
      //   $user = Auth::user();

      //   // Vérifier que l'utilisateur est un conducteur
      //   if ($user->role !==4 ) { // Remplace 'driver' par ta logique de rôle
      //       abort(403, 'Accès réservé aux conducteurs.');
      //   }

      //   // Récupérer les véhicules assignés avec les détails
      //   $vehicles = $user->vehicules()->get();
      //   $user = Auth::user();
      //   $vehicules = $user->vehicules()->paginate(10);
      // //  $data['vehicules'] = User::vehicules($user);
      // //  $data['vehicules'] = $user->vehicules()->paginate(10);


      //   return view('backend.dashboard', ['vehicules' => $vehicules]);
    }
}
