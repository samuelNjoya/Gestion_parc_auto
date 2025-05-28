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


    // pour le graph
//     public function index()
// {
//     $data = ConsoCarburantModel::select(
//             DB::raw("DATE_FORMAT(date_conso, '%Y-%m') as mois"),
//             DB::raw('SUM(cout) as total_cout')
//         )
//         ->where('is_delete', 0)  // si tu utilises ce champ pour filtrer
//         ->groupBy('mois')
//         ->orderBy('mois')
//         ->get();

//     $labels = $data->pluck('mois');
//     $couts = $data->pluck('total_cout');

//     return view('backend.dashboard', compact('labels', 'couts'));
// }

// public function showDashboard()
// {
//     // Récupérer les données de maintenance (exemple)
//     $maintenanceData = ConsoCarburantModel::select(
//             DB::raw("DATE_FORMAT(date_cons, '%b') as mois"), // mois abrégé (Jan, Fév...)
//             DB::raw('SUM(cout_cons) as cout') // cout total par mois
//         )
//         ->groupBy('mois')
//         ->orderBy(DB::raw("MONTH(date_cons)")) // important pour l'ordre des mois
//         ->pluck('cout', 'mois')  // récupère un tableau associatif [mois => cout]
//         ->toArray();

//     // Formater les données pour Chart.js
//     $labels = array_keys($maintenanceData); // mois
//     $couts = array_values($maintenanceData); // couts

//     // Préparer le tableau final à envoyer à la vue
//     $data = [
//         'labels' => $labels,
//         'couts' => $couts
//     ];

//     return view('backend.dashboard', compact('data')); // Passer $data à la vue
// }

// public function coutParMois()
// {
//     $data = DB::table('conso_carburant')
//         ->select(
//             DB::raw("DATE_FORMAT(date_conso, '%b %Y') as mois"),
//             DB::raw("SUM(cout_conso) as total_cout")
//         )
//         ->groupBy('mois')
//         ->orderBy('mois')
//         ->get();

//     $labels = $data->pluck('mois');
//     $values = $data->pluck('total_cout');

//     return view('backend.historiqueCout', compact('labels', 'values'));

// }

public function coutParMois(Request $request, $annee = null)
{
   // $annee = $annee ?? date('Y'); // Année courante par défaut
    $annee = $request->get('annee', $annee ?? date('Y'));

    $data = DB::table('conso_carburant')
        ->select(
            DB::raw("DATE_FORMAT(date_conso, '%b %Y') as mois"),
            DB::raw("SUM(cout_conso) as total_cout")
        )
        ->whereYear('date_conso', $annee)
        ->groupBy('mois')
        ->orderBy('mois')
        ->get();

    $labels = $data->pluck('mois');
    $values = $data->pluck('total_cout');

    // Liste des années disponibles pour le select
    $anneesDisponibles = DB::table('conso_carburant')
        ->select(DB::raw('YEAR(date_conso) as annee'))
        ->distinct()
        ->orderBy('annee', 'desc')
        ->pluck('annee');

    return view('backend.historiqueCout', compact('labels', 'values', 'annee', 'anneesDisponibles'));
}

}