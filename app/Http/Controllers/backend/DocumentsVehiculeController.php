<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\DocumentVehiculeModel;
use App\Models\VehiculeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DocumentsVehiculeController extends Controller
{
    public function documentsVehicule_list(){ 
       
        $data['meta_title'] = "documentsVehicule List";
        $data['getRecords'] = DocumentVehiculeModel::getDocumentVehicule();
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        return view('backend.documentsVehicule.list', $data);
    }
    
    public function documentsVehicule_create(){
        $data['meta_title'] = "documentsVehicule Create";
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        return view('backend.documentsVehicule.create', $data);
    }

    //  public function documentsVehicule_view($id){
    //      $data['getRecords'] = DocumentVehiculeModel::getSingle($id);
    //     $data['getVehicule'] = VehiculeModel::getVehiculeActive();
    //     $data['meta_title'] = "informations documentsVehicule";
    //     return view('backend.documentsVehicule.view', $data);
    // }

    public function documentsVehicule_insert(Request $request){
  
        
        $documentsVehicule = new DocumentVehiculeModel();
        $documentsVehicule->vehicule_id = trim($request->vehicule_id);
        $documentsVehicule->type = trim($request->document_vehicule);
        $documentsVehicule->date_derniere_mise_ajour = trim($request->date_derniere_mise_ajour);
        $documentsVehicule->date_expiration = trim($request->date_expiration) ?: null;
        $documentsVehicule->statut = trim($request->statut);
        $documentsVehicule->created_by_id = Auth::user()->id;
        $documentsVehicule->save();

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/doc_vehicule/', $filename);

            $documentsVehicule->pdf_scan = $filename;
            $documentsVehicule->save();
        }

        return redirect('panel/documentsVehicule')->with('success','documentsVehicule créer avec succes');
    }

    

    public function documentsVehicule_edit($id){
        $data['getRecords'] = DocumentVehiculeModel::getSingle($id);
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['meta_title'] = "documentsVehicule Edit";
        return view('backend.documentsVehicule.edit', $data);
    }

    public function documentsVehicule_update($id,Request $request){
        // request()->validate([
        //    'immatriculation' => 'required|immatriculation|unique:documentsVehicules,immatriculation,' .$id,
        // ]);

        $documentsVehicule = DocumentVehiculeModel::getSingle($id);
       $documentsVehicule->vehicule_id = trim($request->vehicule_id);
        $documentsVehicule->type = trim($request->document_vehicule);
        $documentsVehicule->date_derniere_mise_ajour = trim($request->date_derniere_mise_ajour);
        $documentsVehicule->date_expiration = trim($request->date_expiration) ?: null;
        $documentsVehicule->statut = trim($request->statut);
        $documentsVehicule->save();
    

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/doc_vehicule/', $filename);

            $documentsVehicule->pdf_scan = $filename;
            $documentsVehicule->save();
        }

        return redirect('panel/documentsVehicule')->with('success','documentsVehicule mis a jour avec succes');
    }

    public function documentsVehicule_delete($id){
        $documentsVehicule = DocumentVehiculeModel::getSingle($id);
        $documentsVehicule->is_delete = 1;
        $documentsVehicule->save();

        return redirect('panel/documentsVehicule')->with('error','documentsVehicule supprimer avec succes');
    }
}
