<?php

namespace App\Http\Controllers\backend;

use App\Exports\VehiculeExport;
use App\Http\Controllers\Controller;
use App\Models\ConsoCarburantModel;
use App\Models\InterventionTechModel;
use App\Models\PieceModel;
use App\Models\VehiculeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;


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

       $request->validate([
        'immatriculation' => 'required|unique:vehicule,immatriculation',
        ],[
        'immatriculation.unique' => 'Ce matricule est déjà enregistré pour un autre véhicule.',
        ]);
        
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



    /////********************************************* *//////
    /////          siege des importation en pdf et excel  /////
    /////********************************************* *//////

    public function vehicule_excel(){
        return Excel::download(new VehiculeExport, 'vehicule.xlsx');
    }

    //vehicule
     public function vehicule_pdf(){
        $users = VehiculeModel::getVehiculeActive(); //Auth::user()->id, Auth::user()->is_admin

        $data = [
            'title'=>'vehicule pdf',
            'date'=>date('d-m-y'),
            'users'=>$users
        ];

       // $pdf = app('dompdf.wrapper'); // Crée une instance de PDF
        $pdf = pdf::loadView('pdf/vehicule', $data);

        return $pdf->download('vehicule.pdf');
    }

     //intervention_technique
     public function intervention_technique_pdf(){
        $users = InterventionTechModel::getInterventionTech(); //Auth::user()->id, Auth::user()->is_admin

        $data = [
            'title'=>'intervention technique pdf',
            'date'=>date('d-m-y'),
            'users'=>$users
        ];

       // $pdf = app('dompdf.wrapper'); // Crée une instance de PDF
        $pdf = PDF::loadView('pdf/intervention_technique', $data);

        return $pdf->download('intervention_technique.pdf');
    }

    // Carburant conso_carburant
    public function conso_carburant_pdf(){
        $users = ConsoCarburantModel::getConsoCarburant(); //Auth::user()->id, Auth::user()->is_admin

        $data = [
            'title'=>'consommation en carburant pdf',
            'date'=>date('d-m-y'),
            'users'=>$users
        ];

       // $pdf = app('dompdf.wrapper'); // Crée une instance de PDF
        $pdf = PDF::loadView('pdf/conso_carburant', $data);

        return $pdf->download('conso_carburant.pdf');
    }

     // piece
    public function piece_pdf(){
        $users = PieceModel::getPiece(); //Auth::user()->id, Auth::user()->is_admin

        $data = [
            'title'=>'pieces vehicule pdf',
            'date'=>date('d-m-y'),
            'users'=>$users
        ];

       // $pdf = app('dompdf.wrapper'); // Crée une instance de PDF
        $pdf = PDF::loadView('pdf/piece', $data);

        return $pdf->download('piece.pdf');
    }
}
