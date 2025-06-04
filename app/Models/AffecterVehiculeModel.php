<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class AffecterVehiculeModel extends Model
{
    protected $table = 'affectation-vehecule';

    static public function getSingle($id){
        // return SubjectModel::find($id);
        return self::find($id);  // pourquoi ceci marche et pas l'autre 
    }

    //pour eviter la duplication des class et matiere
   static public function checkClassSubject($created_by_id, $class_id, $subject_id)
    {
        return AffecterVehiculeModel::where('created_by_id', '=', $created_by_id)
                               ->where('class_id', '=', $class_id)
                               ->where('subject_id', '=', $subject_id)
                               ->where('is_delete', '=', 0)
                               ->count();// s'il y'a pas duplication

    }

    //pour la fonction single
    static public function checkClassSubjectSingle($created_by_id, $class_id, $subject_id)
    {
        return AffecterVehiculeModel::where('created_by_id', '=', $created_by_id)
                               ->where('class_id', '=', $class_id)
                               ->where('subject_id', '=', $subject_id)
                               ->where('is_delete', '=', 0)
                               ->first(); // premier enregistrement qui correspond aux critères

    }

    //pour eviter la duplication des class lors de la modification en supprimant des anciennes données
    // important dans timeTable jQry pour rendre dynamique les matières en fonction des classes
    static public function getSelectedSubject($class_id, $created_by_id)
    {
        return AffecterVehiculeModel::select('subject_class.*','subject.name as subject_name')
                                ->join('subject','subject.id', '=', 'subject_class.subject_id')
                                ->where('subject_class.created_by_id', '=', $created_by_id)
                               ->where('subject_class.class_id', '=', $class_id)
                               ->where('subject_class.is_delete', '=', 0)
                               ->get();
    }

    static public function deleteClassSubject($class_id, $created_by_id)
    {
        return AffecterVehiculeModel::where('created_by_id', '=', $created_by_id)
                               ->where('class_id', '=', $class_id)
                               ->delete();
                               
    }

    static public function getRecord($user_id, $user_type)
    {
        $return = self::select('subject_class.*','class.name as class_name','subject.name as subject_name');
            $return = $return->join('class','class.id', '=', 'subject_class.class_id');
            $return = $return->join('subject','subject.id', '=', 'subject_class.subject_id');
            if(!empty(Request::get('id')))
            {
                 $return = $return->where('subject_class.id', '=', Request::get('id'));
            }

            if(!empty(Request::get('class_name')))
            {
                 $return = $return->where('class.name', 'like', '%' .Request::get('class_name').'%');
            }

            if(!empty(Request::get('subject_name')))
            {
                 $return = $return->where('subject.name', 'like', '%' .Request::get('subject_name').'%');
            }

            if(!empty(Request::get('status')))
            {
                $status = Request::get('status');
                if ($status == 100) {
                    $status = 0;
                }
                $return = $return->where('subject_class.status', '=', $status);
             }

             $return = $return->where('subject_class.created_by_id', '=', $user_id);// cette fonction pour que l'admin puisse voire les teachers

        $return = $return->where('subject_class.is_delete', '=', 0)
                ->orderBy('subject_class.id', 'desc') //subject_class.id si problème mettre id
                ->paginate(10);   
        return $return;
    }

      static public function getAffectationVehicule(){
        // $return = self::select('*');
        $return = self::select('affectation-vehecule.*', 'vehicule.immatriculation', 'vehicule.marque')
           ->join('vehicule', 'vehicule.id', '=', 'affectation-vehecule.vehicule_id')
           ->join('users', 'users.id', '=', 'affectation-vehecule.conducteur_id');

            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('nom'))){
                 $return = $return->where('nom', 'like', '%' .Request::get('nom').'%');
            }
             if(!empty(Request::get('prenom'))){
                 $return = $return->where('prenom', 'like', '%' .Request::get('prenom').'%');
            }
            if(!empty(Request::get('immatriculation'))){
                    $return = $return->where('immatriculation', 'like', '%' .Request::get('immatriculation').'%');
             }
            // if(!empty(Request::get('kilometrage_plein'))){
            //  $return = $return->where('kilometrage_plein', 'like', '%' .Request::get('kilometrage_plein').'%');
            // } 
            if(!empty(Request::get('statut'))){
                $statut = Request::get('statut');
                if ($statut == 100) {
                    $statut = 0;
                }
                $return = $return->where('affectation-vehecule.statut', '=', $statut);
             }

     $return = $return->where('affectation-vehecule.is_delete', '=', 0)//whereIn
                ->orderBy('affectation-vehecule.id', 'desc')
                ->paginate(10);   
        return $return;
    }

    //Pour dire que  un vehicule peut avoir plusieur affectation
    public function getVehicule(){
        return $this->belongsTo(VehiculeModel::class, 'vehicule_id');
    }

    
    public function getConducteur(){
    return $this->belongsTo(User::class, 'conducteur_id')
                ->where('role', 4);
}

       //compter le nombre de conducteur 
   static public function nombreAffectation()
   {
     return self::where('is_delete','=',0)->count();
   }

}
