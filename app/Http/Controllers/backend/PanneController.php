<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PanneModel;
use Illuminate\Http\Request;

class PanneController extends Controller
{
    public function Panne_list(){
        $data['meta_title'] = "Liste des Pièces";
        $data['getRecords'] = PanneModel::getPanne();
        return view('backend.panne.list', $data);
    }
    


    public function Panne_insert(Request $request){

      // dd($request->all()); 

       
        // $panne = new PanneModel();
        // $panne->intervention_id = trim($request->intervention_id);
        // $panne->nom = trim($request->nom);
        // $panne->reference = trim($request->reference);
        // $panne->date_installation = trim($request->date_installation);
        // $panne->date_expiration = trim($request->date_expiration);
        // $panne->cout_unitaire = trim($request->cout_unitaire);
        // $panne->quantite = trim($request->quantite);
        // $panne->kilometrage_installation = trim($request->kilometrage_installation);
        // $panne->duree_vie = trim($request->duree_vie);
        // $panne->description = trim($request->description);  
        // $panne->statut = trim($request->statut);
     
        // // $panne->created_by_id = Auth::user()->id;
        // $panne->save();


        // return redirect('panel/intervention_tech')->with('success','panne créer avec succes');
 
    }

    public function panne_edit($id){
        $data['meta_title'] = "Editer une panne";
        $data['getRecords'] = PanneModel::getSingle($id);

        return view('backend.panne.edit', $data);
    }

    public function panne_update($id,Request $request){

        $panne = PanneModel::getSingle($id);
        $panne->nom = trim($request->nom);
        $panne->reference = trim($request->reference);
        $panne->date_installation = trim($request->date_installation);
        $panne->date_expiration = trim($request->date_expiration);
        $panne->cout_unitaire = trim($request->cout_unitaire);
        $panne->quantite = trim($request->quantite);
        $panne->kilometrage_installation = trim($request->kilometrage_installation);
        $panne->duree_vie = trim($request->duree_vie);
        $panne->description = trim($request->description);  
        $panne->statut = trim($request->statut);

      
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
