<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PanneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PanneController extends Controller
{
    public function Panne_list(){
        $data['meta_title'] = "Liste des Pièces";
        $data['getRecords'] = PanneModel::getPanne();
        $data['userRole'] = Auth::user()->role; // Ajouter le rôle de l'utilisateur pour l'affichage conditionnel
        return view('backend.panne.list', $data);
    }
    


    public function Panne_insert(Request $request){

     // dd($request->all()); 

       
        $panne = new PanneModel();
        $panne->affectation_id = trim($request->affectation_id); // id_vehicule
        $panne->type = trim($request->type);
        $panne->localisation = trim($request->localisation);
        $panne->kilometrage_panne = trim($request->kilometrage_panne);
        $panne->date_panne = trim($request->date_panne);
        $panne->description = trim($request->description);
        $panne->statut = trim($request->statut);
     
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/panne/', $filename);

            $panne->photo = $filename;
            $panne->save();
        }
        $panne->save();


        return redirect('panel/panne')->with('success','panne créer avec succes');
 
    }

    public function panne_edit($id){
        $data['meta_title'] = "Editer une panne";
        $data['getRecords'] = PanneModel::getSingle($id);

        return view('backend.panne.edit', $data);
    }

    public function panne_update($id,Request $request){

        $panne = PanneModel::getSingle($id);
       

      
        $panne->save();
    

        return redirect('panel/panne')->with('success','panne mis a jour avec succes');
    }

    public function panne_delete($id){
        $panne = PanneModel::getSingle($id);
        $panne->is_delete = 1;
        $panne->save();

        return redirect('panel/panne')->with('error','Maintenance/entretient supprimer avec succes');
    }

    
}
