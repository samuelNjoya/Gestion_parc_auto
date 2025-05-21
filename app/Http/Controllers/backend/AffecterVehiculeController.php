<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AffecterVehiculeModel;
use App\Models\User;
use App\Models\VehiculeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AffecterVehiculeController extends Controller
{
    public function affecter_vehicule_list(){
        $data['meta_title'] = "liste d'affectation";
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getConducteur'] = User::getConducteurActive();
        $data['getRecords'] = AffecterVehiculeModel::getAffectationVehicule();
        return view('backend.affecter_vehicule.list', $data);
    }
    
    public function affecter_vehicule_create(){
        $data['meta_title'] = "affecter un vehicule";
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getConducteur'] = User::getConducteurActive();
        return view('backend.affecter_vehicule.create', $data);
    }

    public function affecter_vehicule_insert(Request $request){

        $save = new AffecterVehiculeModel;
        $save->vehicule_id = trim($request->vehicule_id);
        $save->conducteur_id = trim($request->conducteur_id);
        $save->date_debut = trim($request->date_debut);
        $save->date_fin = trim($request->date_fin);
        $save->description = trim($request->description);
        $save->statut = trim($request->statut);
        // $save->created_by_id = Auth::user()->id;
        $save->save();

      

        return redirect('panel/affecter_vehicule')->with('success','vehicule affecter avec success');
    }

    public function affecter_vehicule_edit($id){
        $data['meta_title'] = "Modification une affection ";
        $data['getVehicule'] = VehiculeModel::getVehiculeActive();
        $data['getConducteur'] = User::getConducteurActive();
        $data['getRecords'] = AffecterVehiculeModel::getSingle($id);

        return view('backend.affecter_vehicule.edit', $data);
    }

    public function affecter_vehicule_update($id, Request $request){


        $save = AffecterVehiculeModel::getSingle($id);
        $save->vehicule_id = trim($request->vehicule_id);
        $save->conducteur_id = trim($request->conducteur_id);
        $save->date_debut = trim($request->date_debut);
        $save->date_fin = trim($request->date_fin);
        $save->description = trim($request->description);
        $save->statut = trim($request->statut);
        // $save->created_by_id = Auth::user()->id;
        $save->save();

      

        return redirect('panel/affecter_vehicule')->with('success','vehicule affecter avec success');
    }
 

    public function affecter_vehicule_delete($id){
        $save = AffecterVehiculeModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/affecter_vehicule')->with('error','affecter_vehicule successifuly deleted');
    }



    //assign-affecter_vehicule
    // public function assign_affecter_vehicule_list(Request $request)
    // {
    //     $data['getRecord'] = SubjectClassModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
    //     $data['meta_title'] = "assign affecter_vehicule Class";

    //     return view('backend.assign-affecter_vehicule.list',$data);
    // }

    
    // public function assign_affecter_vehicule_create()
    // {
    //     $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
    //     $data['getSubject'] = AffecterVehiculeModel::getRecordActive(Auth::user()->id);
    //     $data['meta_title'] = "Assign affecter_vehicule Create";
    //     return view('backend.assign-subject.create', $data);
    // }

    // public function assign_subject_insert(Request $request)
    // {
    //    if(!empty($request->class_id) && !empty($request->subject_id))
    //    {
    //      foreach ($request->subject_id as $subject_id) 
    //      {
    //        if(!empty($subject_id))
    //        {
    //           // pour eviter la duplication des class et matiere
    //           $check = SubjectClassModel::checkClassSubject(Auth::user()->id, $request->class_id, $subject_id);

    //           if(empty($check)) // s'il y'a pas duplication on insère
    //           {
    //                 $save                = new SubjectClassModel;
    //                 $save->class_id      = trim($request->class_id);
    //                 $save->subject_id    = trim($subject_id);
    //                 $save->status        = trim($request->status);
    //                 $save->created_by_id = Auth::user()->id;
    //                 $save->save();
    //           }
                
    //        }
    //      }
    //    }
    //    return redirect('panel/assign_subject')->with('success','Assign subject class successifuly created');
    // }
     
    // Assign subject Edit single
    // public function assign_subject_single_edit($id)
    // {
       
    //     $data['getRecord'] =  SubjectClassModel::getSingle($id);
    //     $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
    //     $data['getSubject'] = AffecterVehiculeModel::getRecordActive(Auth::user()->id);
    //     $data['meta_title'] = "Edit Assign subject single";
    //     return view('backend.assign-subject.edit_single', $data);
    // }

    // public function assigns_ubject_single_update(Request $request)
    // {
    //    // pour eviter la duplication des class et matiere single
    //    $check = SubjectClassModel::checkClassSubjectSingle(Auth::user()->id, $request->class_id, $request->subject_id);

    //    if(empty($check)) // s'il y'a pas duplication on insère
    //    {
    //          $save                = new SubjectClassModel;
    //          $save->class_id      = trim($request->class_id);
    //          $save->subject_id    = trim($request->subject_id);
    //          $save->status        = trim($request->status);
    //          $save->created_by_id = Auth::user()->id;
    //          $save->save();
    //    }
    //    else
    //    {
    //             $check->class_id      = trim($request->class_id);
    //             $check->subject_id    = trim($request->subject_id);
    //             $check->status        = trim($request->status);
    //             $check->save();
    //    }

    //    return redirect('panel/assign_subject')->with('success','Assign subject class successifuly updated');

    // }


    // public function assign_subject_edit($id)
    // {
    //     $getRecord = SubjectClassModel::getSingle($id);
    //     $data['getRecord'] = $getRecord;
    //     $data['getSelectedSubject'] = SubjectClassModel::getSelectedSubject($getRecord->class_id, Auth::user()->id); //fonction pour anuler les anciennes données 
    //     // dd($getRecord);

    //     $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
    //     $data['getSubject'] = AffecterVehiculeModel::getRecordActive(Auth::user()->id);
    //     $data['meta_title'] = "Edit Assign subject Create";
    //     return view('backend.assign-subject.edit', $data);
    // }

    // public function assigns_ubject_update($id, Request $request)
    // {
    //     if(!empty($request->class_id))
    //    {
    //      SubjectClassModel::deleteClassSubject( $request->class_id, Auth::user()->id);

    //      foreach ($request->subject_id as $subject_id) 
    //      {
    //        if(!empty($subject_id))
    //        {
    //           // pour eviter la duplication des class et matiere
    //           $check = SubjectClassModel::checkClassSubject(Auth::user()->id, $request->class_id, $subject_id);

    //           if(empty($check)) // s'il y'a pas duplication on insère
    //           {
    //                 $save                = new SubjectClassModel;
    //                 $save->class_id      = trim($request->class_id);
    //                 $save->subject_id    = trim($subject_id);
    //                 $save->status        = trim($request->status);
    //                 $save->created_by_id = Auth::user()->id;
    //                 $save->save();
    //           }
                
    //        }
    //      }
    //    }
    //    return redirect('panel/assign_subject')->with('success','Assign subject class successifuly updated');
    // }

    // public function assign_subject_delete($id)
    // {
    //     $save = AffecterVehiculeModel::getSingle($id);
    //     $save->is_delete = 1;
    //     $save->save();

    //     return redirect('panel/assign_subject')->with('error','Assign subject class successifuly deleted');
    // }



    // public function get_assign_subject_class(Request $request)
    // {
    //    $getSubject = SubjectClassModel::getSelectedSubject($request->class_id, Auth::user()->id);
    //    $html = '';
    //    $html .= '<option value="">Select</option>';
    //    foreach($getSubject as $subject){
    //        $html .= '<option value="'.$subject->subject_id.'">'.$subject->subject_name.'</option>';
    //    }
    //    $json['success'] = $html;
    //    echo json_encode($json);
    // }

   
}
