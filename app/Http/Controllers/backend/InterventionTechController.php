<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\InterventionTechModel;
use App\Models\User;
use App\Models\VehiculeModel;
use Illuminate\Http\Request;

class InterventionTechController extends Controller
{
    public function intervention_tech_list(){
        $data['meta_title'] = "Liste Maintenance/entretient";
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getFournisseur'] = User::getFournisseurActive();
        $data['getRecords'] = InterventionTechModel::getInterventionTech();
        return view('backend.interventionTech.list', $data);
    }
    
    public function intervention_tech_create(){
        $data['meta_title'] = "Maintenance/entretient";
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getFournisseur'] = User::getFournisseurActive();
        return view('backend.interventionTech.create', $data); 
    }

    public function intervention_tech_insert(Request $request){

       
        $intervention_tech = new InterventionTechModel();
        $intervention_tech->vehicule_id = trim($request->vehicule_id);
        $intervention_tech->type = trim($request->type);
        $intervention_tech->date = trim($request->date);
        $intervention_tech->titre = trim($request->titre);
        $intervention_tech->cout = trim($request->cout);
        $intervention_tech->fournisseur_id = trim($request->fournisseur_id);
        $intervention_tech->kilometrage = trim($request->kilometrage);
        $intervention_tech->description = trim($request->description);
        $intervention_tech->prochaine_date = trim($request->prochaine_date) ?: null;
        $intervention_tech->frequence = trim($request->frequence);
        $intervention_tech->duree_imobilisation = trim($request->duree) ?: null;
        // $intervention_tech->created_by_id = Auth::user()->id;
        $intervention_tech->save();


        return redirect('panel/intervention_tech')->with('success','intervention_tech créer avec succes');
 
    }

    public function intervention_tech_edit($id){
        $data['meta_title'] = "Editer Maintenance/entretient";
         $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getFournisseur'] = User::getFournisseurActive();
        $data['getRecords'] = InterventionTechModel::getSingle($id);

        return view('backend.interventionTech.edit', $data);
    }

    public function intervention_tech_update($id,Request $request){

        $intervention_tech = InterventionTechModel::getSingle($id);
        $intervention_tech->vehicule_id = trim($request->vehicule_id);
        $intervention_tech->type = trim($request->type);
        $intervention_tech->date = trim($request->date);
        $intervention_tech->titre = trim($request->titre);
        $intervention_tech->cout = trim($request->cout);
        $intervention_tech->fournisseur_id = trim($request->fournisseur_id);
        $intervention_tech->kilometrage = trim($request->kilometrage);
        $intervention_tech->description = trim($request->description);
        $intervention_tech->prochaine_date = trim($request->prochaine_date) ?: null;
        $intervention_tech->frequence = trim($request->frequence);
        $intervention_tech->duree_imobilisation = trim($request->duree) ?: null;
        $intervention_tech->save();
    

        return redirect('panel/intervention_tech')->with('success','Maintenance/entretient mis a jour avec succes');
    }

    public function intervention_tech_delete($id){
        $intervention_tech = InterventionTechModel::getSingle($id);
        $intervention_tech->is_delete = 1;
        $intervention_tech->save();

        return redirect('panel/intervention_tech')->with('error','Maintenance/entretient supprimer avec succes');
    }

    
}
