<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ComptableController extends Controller
{
    public function comptable_list(){
        $data['getRecords'] = User::getComptable();
        $data['meta_title'] = "comptable List";
        return view('backend.comptable.list', $data);
    }
    
    public function comptable_create(){
        $data['meta_title'] = "comptable Create";
        return view('backend.comptable.create', $data);
    }

     public function comptable_view($id){
        $data['getRecords'] = User::getSingle($id);  // $data['getRecord'] = User::getEmploye();
        $data['meta_title'] = "informations comptable";
        return view('backend.comptable.view', $data);
    }

    public function comptable_insert(Request $request){
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
        //  $user->date_naiss = trim($request->date_naiss);
        $user->telephone = trim($request->phone);
        $user->role = 3;
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

        return redirect('panel/comptable')->with('success','comptable créer avec succes');

 
//   "departement" => "departement1"
 
 
    }

    public function comptable_edit($id){
        $data['getRecords'] = User::getSingle($id);
        $data['meta_title'] = "comptable Edit";
        return view('backend.comptable.edit', $data);
    }

    public function comptable_update($id,Request $request){
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
        //  $user->date_naiss = trim($request->date_naiss);
        $user->telephone = trim($request->phone);
        $user->role = 3;
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

        return redirect('panel/comptable')->with('success','comptable mis a jour avec succes');
    }

    public function comptable_delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/comptable')->with('error','comptable ssupprimer avec succes');
    }
}
