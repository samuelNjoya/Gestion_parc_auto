<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\VehiculeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VehiculeController extends Controller
{
    public function vehicule_list(){ 
        $data['getRecords'] = VehiculeModel::getVehicule();
        $data['meta_title'] = "vehicule List";
        return view('backend.vehicule.list', $data);
    }
    
    public function vehicule_create(){
        $data['meta_title'] = "vehicule Create";
        return view('backend.vehicule.create', $data);
    }

     public function vehicule_view($id){
        $data['getRecords'] = VehiculeModel::getSingle($id);  
        $data['meta_title'] = "informations vehicule";
        return view('backend.vehicule.view', $data);
    }

    public function vehicule_insert(Request $request){
        // request()->validate([
        //    'immatriculation' => 'required|immatriculation|unique:vehicules',
        // ]);
        
        $vehicule = new VehiculeModel;
        $vehicule->immatriculation = trim($request->immatriculation);
        $vehicule->marque = trim($request->marque);
        $vehicule->modele = trim($request->modele);
        $vehicule->date_achat = trim($request->date_buy);
        $vehicule->type_carburant = trim($request->type_caburant);
        $vehicule->kilometrage = trim($request->kilometrage);
        $vehicule->departement = trim($request->departement);
        $vehicule->statut = trim($request->statut);
        $vehicule->created_by_id = Auth::user()->id;
        $vehicule->save();

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/vehicule/', $filename);

            $vehicule->photo = $filename;
            $vehicule->save();
        }

        return redirect('panel/vehicule')->with('success','vehicule créer avec succes');
    }

    

    public function vehicule_edit($id){
        $data['getRecords'] = VehiculeModel::getSingle($id);
        $data['meta_title'] = "vehicule Edit";
        return view('backend.vehicule.edit', $data);
    }

    public function vehicule_update($id,Request $request){
        // request()->validate([
        //    'immatriculation' => 'required|immatriculation|unique:vehicules,immatriculation,' .$id,
        // ]);

        $vehicule = VehiculeModel::getSingle($id);
        $vehicule->immatriculation = trim($request->immatriculation);
        $vehicule->marque = trim($request->marque);
        $vehicule->modele = trim($request->modele);
        $vehicule->date_achat = trim($request->date_buy);
        $vehicule->type_carburant = trim($request->type_caburant);
        $vehicule->kilometrage = trim($request->kilometrage);
        $vehicule->departement = trim($request->departement);
        $vehicule->statut = trim($request->statut);
        $vehicule->save();
    

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/vehicule/', $filename);

            $vehicule->photo = $filename;
            $vehicule->save();
        }

        return redirect('panel/vehicule')->with('success','vehicule mis a jour avec succes');
    }

    public function vehicule_delete($id){
        $vehicule = VehiculeModel::getSingle($id);
        $vehicule->is_delete = 1;
        $vehicule->save();

        return redirect('panel/vehicule')->with('error','vehicule supprimer avec succes');
    }
}
