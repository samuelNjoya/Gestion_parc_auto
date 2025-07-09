<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\InterventionTechModel;
use App\Models\User;
use App\Models\VehiculeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $intervention_tech->created_by_id = Auth::user()->id;
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



    public function intervention_tech_delete($id) {
            $intervention = InterventionTechModel::findOrFail($id);

            // Supprimez d'abord les pièces associées
            $intervention->pieces()->update(['is_delete' => 1]);
            // OU pour une suppression réelle :
            // $intervention->pieces()->delete();
            $intervention->is_delete = 1;
            $intervention->save();

            return redirect('panel/intervention_tech')->with('success', 'Supprimé avec succès');
        }


    public function coutParMois(Request $request, $annee = null)
    {
        $annee = $request->get('annee', $annee ?? date('Y'));
        $vehiculeId = $request->get('vehicule_id'); // nouveau paramètre

        $query = DB::table('intervention_technique')
            ->join('vehicule', 'vehicule.id', '=', 'intervention_technique.vehicule_id')
            ->select(
                DB::raw("DATE_FORMAT(date, '%b %Y') as mois"),
                DB::raw("SUM(cout) as total_cout")
            )
            ->whereYear('date', $annee);

        if (!empty($vehiculeId)) {
            $query->where('vehicule_id', $vehiculeId);
        }

        $data = $query
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $labels = $data->pluck('mois');
        $values = $data->pluck('total_cout');

        $anneesDisponibles = DB::table('intervention_technique')
            ->select(DB::raw('YEAR(date) as annee'))
            ->distinct()
            ->orderBy('annee', 'desc')
            ->pluck('annee');

        $vehicules = DB::table('vehicule')->get();

        $vehiculeNom = null;
        if ($vehiculeId) {
            $vehicule = DB::table('vehicule')->where('id', $vehiculeId)->first();
            $vehiculeNom = $vehicule ? $vehicule->immatriculation : null;
        }


        return view('backend.historiqueCoutMaintenance', compact(
            'labels',
            'values',
            'annee',
            'anneesDisponibles',
            'vehicules',
            'vehiculeId',
            'vehiculeNom'
        ));
    }

    
}
