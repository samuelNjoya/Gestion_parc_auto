<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ConducteurController extends Controller
{
    public function conducteur_list(){
        $data['getRecords'] = User::getConducteur();
        $data['meta_title'] = "conducteur List";
        return view('backend.conducteur.list', $data);
    }
    
    public function conducteur_create(){
        $data['meta_title'] = "conducteur Create";
        return view('backend.conducteur.create', $data);
    }

     public function conducteur_view($id){
        $data['getRecords'] = User::getSingle($id);  // $data['getRecord'] = User::getEmploye();
        $data['meta_title'] = "informations conducteur";
        return view('backend.conducteur.view', $data);
    }

    public function conducteur_insert(Request $request){
        request()->validate([
           'email' => 'required|email|unique:users',
        ]);
        //dd($request->all());
        $user = new User;
        $user->nom = trim($request->nom);
        $user->prenom = trim($request->prenom);
        $user->password = Hash::make($request->motDePass);
        $user->address = trim($request->address);
        $user->email = trim($request->email);
        $user->date_naiss = trim($request->date_naiss);
        $user->num_permis = trim($request->numero_permis);
        $user->date_exp_permis = trim($request->date_expiration_permis);
        $user->type_permis = trim($request->type_permis);
        $user->telephone = trim($request->phone);
        $user->role = 4;
         $user->statut = trim($request->statut);
        $user->created_by_id = Auth::user()->id;
        $user->save();

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $user->profile_pic = $filename;
            $user->save();
        }

        return redirect('panel/conducteur')->with('success','conducteur créer avec succes');

 
//   "departement" => "departement1"
 
 
    }

    public function conducteur_edit($id){
        $data['getRecords'] = User::getSingle($id);
        $data['meta_title'] = "conducteur Edit";
        return view('backend.conducteur.edit', $data);
    }

    public function conducteur_update($id,Request $request){
        request()->validate([
           'email' => 'required|email|unique:users,email,' .$id,
        ]);

        $user = User::getSingle($id);
        $user->nom = trim($request->nom);
        $user->prenom = trim($request->prenom);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->motDePass);
        }
        $user->address = trim($request->address);
        $user->email = trim($request->email);
        $user->date_naiss = trim($request->date_naiss);
        $user->num_permis = trim($request->numero_permis);
        $user->date_exp_permis = trim($request->date_expiration_permis);
        $user->type_permis = trim($request->type_permis);
        $user->telephone = trim($request->phone);
        $user->role = 4;
        $user->statut = trim($request->statut);
        $user->save();
    

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $user->profile_pic = $filename;
            $user->save();
        }

        return redirect('panel/conducteur')->with('success','conducteur mis a jour avec succes');
    }

    public function conducteur_delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/conducteur')->with('error','conducteur supprimer avec succes');
    }
}
