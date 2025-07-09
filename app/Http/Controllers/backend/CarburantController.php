<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ConsoCarburantModel;
use App\Models\User;
use App\Models\VehiculeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarburantController extends Controller
{
    public function conso_carburant_list(){
        $data['meta_title'] = "Liste consommation";
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getFournisseur'] = User::getFournisseurActive();
        $data['getRecords'] = ConsoCarburantModel::getConsoCarburant();
        return view('backend.consoCarburant.list', $data);
    }
    
    public function conso_carburant_create(){
        $data['meta_title'] = "consommation carburant";
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getFournisseur'] = User::getFournisseurActive();
        return view('backend.consoCarburant.create', $data); 
    }

    public function conso_carburant_insert(Request $request){
       
        $carburant = new ConsoCarburantModel();
        $carburant->vehicule_id = trim($request->vehicule_id);
        $carburant->kilometrage_plein = trim($request->kilometrage_plein);
        $carburant->date_conso = trim($request->date_conso);
        $carburant->quantite_conso = trim($request->quantite_conso);
        $carburant->cout_conso = trim($request->cout_conso);
        $carburant->fournisseur_id = trim($request->fournisseur_id);
        $carburant->note = trim($request->note);
        $carburant->created_by_id = Auth::user()->id;
        $carburant->save();


        return redirect('panel/conso_carburant')->with('success','conso_carburant créer avec succes');
 
    }

    public function conso_carburant_edit($id){
        $data['meta_title'] = "conso_carburant Editer";
         $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getFournisseur'] = User::getFournisseurActive();
        $data['getRecords'] = ConsoCarburantModel::getSingle($id);

        return view('backend.consoCarburant.edit', $data);
    }

    public function conso_carburant_update($id,Request $request){

        $carburant = ConsoCarburantModel::getSingle($id);
        $carburant->vehicule_id = trim($request->vehicule_id);
        $carburant->kilometrage_plein = trim($request->kilometrage_plein);
        $carburant->date_conso = trim($request->date_conso);
        $carburant->quantite_conso = trim($request->quantite_conso);
        $carburant->cout_conso = trim($request->cout_conso);
        $carburant->fournisseur_id = trim($request->fournisseur_id);
        $carburant->note = trim($request->note);
        $carburant->save();
    

        return redirect('panel/conso_carburant')->with('success','conso_carburant mis a jour avec succes');
    }

    public function conso_carburant_delete($id){
        $carburant = ConsoCarburantModel::getSingle($id);
        $carburant->is_delete = 1;
        $carburant->save();

        return redirect('panel/conso_carburant')->with('error','conso_carburant supprimer avec succes');
    }




public function coutParMois(Request $request, $annee = null)
{
    $annee = $request->get('annee', $annee ?? date('Y'));
    $vehiculeId = $request->get('vehicule_id'); // nouveau paramètre

    $query = DB::table('conso_carburant')
        ->join('vehicule', 'vehicule.id', '=', 'conso_carburant.vehicule_id')
        ->select(
            DB::raw("DATE_FORMAT(date_conso, '%b %Y') as mois"),
            DB::raw("SUM(cout_conso) as total_cout")
        )
        ->whereYear('date_conso', $annee);

    if (!empty($vehiculeId)) {
        $query->where('vehicule_id', $vehiculeId);
    }

    $data = $query
        ->groupBy('mois')
        ->orderBy('mois')
        ->get();

    $labels = $data->pluck('mois');
    $values = $data->pluck('total_cout');

    $anneesDisponibles = DB::table('conso_carburant')
        ->select(DB::raw('YEAR(date_conso) as annee'))
        ->distinct()
        ->orderBy('annee', 'desc')
        ->pluck('annee');

    $vehicules = DB::table('vehicule')->get();

    $vehiculeNom = null;
    if ($vehiculeId) {
        $vehicule = DB::table('vehicule')->where('id', $vehiculeId)->first();
        $vehiculeNom = $vehicule ? $vehicule->immatriculation : null;
    }


    return view('backend.historiqueCout', compact(
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