<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\InterventionTechModel;
use App\Models\PieceModel;
use App\Models\User;
use App\Models\VehiculeModel;
use Illuminate\Http\Request;

class PieceController extends Controller
{
    public function piece_list(){
        $data['meta_title'] = "Liste des Pièces";
        $data['getRecords'] = PieceModel::getPiece();
        return view('backend.piece.list', $data);
    }
    
    // public function intervention_tech_create(){
    //     $data['meta_title'] = "Maintenance/entretient";
    //     $data['getVehicule'] = VehiculeModel::getVehiculeActive();
    //     $data['getFournisseur'] = User::getFournisseurActive();
    //     return view('backend.interventionTech.create', $data); 
    // }

    public function piece_insert(Request $request){

      //  dd($request->all()); intervention_id

       
        $piece = new PieceModel();
        $piece->intervention_id = trim($request->intervention_id);
        $piece->nom = trim($request->nom);
        $piece->reference = trim($request->reference);
        $piece->date_installation = trim($request->date_installation);
        $piece->date_expiration = trim($request->date_expiration);
        $piece->cout_unitaire = trim($request->cout_unitaire);
        $piece->quantite = trim($request->quantite);
        $piece->kilometrage_installation = trim($request->kilometrage_installation);
        $piece->duree_vie = trim($request->duree_vie);
        $piece->description = trim($request->description);  
        $piece->statut = trim($request->statut);
     
        // $piece->created_by_id = Auth::user()->id;
        $piece->save();


        return redirect('panel/intervention_tech')->with('success','piece créer avec succes');
 
    }

    public function piece_edit($id){
        $data['meta_title'] = "Editer une piece";
        $data['getRecords'] = PieceModel::getSingle($id);

        return view('backend.piece.edit', $data);
    }

    public function piece_update($id,Request $request){

        $piece = PieceModel::getSingle($id);
        $piece->nom = trim($request->nom);
        $piece->reference = trim($request->reference);
        $piece->date_installation = trim($request->date_installation);
        $piece->date_expiration = trim($request->date_expiration);
        $piece->cout_unitaire = trim($request->cout_unitaire);
        $piece->quantite = trim($request->quantite);
        $piece->kilometrage_installation = trim($request->kilometrage_installation);
        $piece->duree_vie = trim($request->duree_vie);
        $piece->description = trim($request->description);  
        $piece->statut = trim($request->statut);

      
        $piece->save();
    

        return redirect('panel/piece')->with('success','Piece mis a jour avec succes');
    }

    public function piece_delete($id){
        $piece = PieceModel::getSingle($id);
        $piece->is_delete = 1;
        $piece->save();

        return redirect('panel/piece')->with('error','Maintenance/entretient supprimer avec succes');
    }

    
}
