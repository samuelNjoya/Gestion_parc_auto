<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PanneModel extends Model
{
    protected $table = 'panne';

    static public function getSingle($id){
        return PanneModel::find($id); 
    }


    //    static public function getPanne(){
    //     $return = self::select('*');
    //     //  $return = self::select('intervention_technique.*', 'vehicule.immatriculation', 'vehicule.marque')
    //     //    ->join('vehicule', 'vehicule.id', '=', 'intervention_technique.vehicule_id');

    //         if(!empty(Request::get('id'))){
    //              $return = $return->where('id', '=', Request::get('id'));
    //         }
    //         if(!empty(Request::get('nom'))){
    //              $return = $return->where('nom', 'like', '%' .Request::get('nom').'%');
    //         }
    //            if(!empty(Request::get('reference'))){
    //              $return = $return->where('reference', 'like', '%' .Request::get('reference').'%');
    //         }
           
    //         if(!empty(Request::get('statut'))){
    //             $statut = Request::get('statut');
    //             if ($statut == 100) {
    //                 $statut = 0;
    //             }
    //             $return = $return->where('statut', '=', $statut);
    //          }

    //  $return = $return->where('is_delete', '=', 0)//whereIn
    //             ->orderBy('id', 'desc')
    //             ->paginate(10);   
    //     return $return;
    // }

    static public function getPanne()
{
    $return = self::select('panne.*', 'vehicule.immatriculation')
                ->join('vehicule', 'vehicule.id', '=', 'panne.affectation_id');
                // ->join('users', 'users.id', '=', 'panne.user_id');

    // Filtrage par rôle
    if(Auth::user()->role == 4) { // Si conducteur
        $return->where('panne.conducteur_id', Auth::id());
    }

    // Filtres existants
    if(!empty(Request::get('id'))){
        $return->where('panne.id', '=', Request::get('id'));
    }
    if(!empty(Request::get('type'))){
        $return->where('panne.type', '=', Request::get('type'));
    }
    if(!empty(Request::get('immatriculation'))){
        $return->where('vehicule.immatriculation', 'like', '%' . Request::get('immatriculation') . '%');
    }
    if(!empty(Request::get('marque'))){
        $return->where('vehicule.marque', 'like', '%' . Request::get('marque') . '%');
    }
    if(!empty(Request::get('statut'))){
        $statut = Request::get('statut');
        if($statut == 100) $statut = 0;
        $return->where('panne.statut', '=', $statut);
    }

    return $return->where('panne.is_delete', 0)
                ->orderBy('panne.id', 'desc')
                ->paginate(10);
}



  //Pour dire que  une affectation peut posseder plusieurs Pannes
    public function getAffectationVehicule(){
        return $this->belongsTo(VehiculeModel::class, 'affectation_id');  // ici fais reference a vehicule car il y'a pas d'id dans la table pivot
    }
       
        // pour ajouter la photo dune panne a la liste
    public function getPhotoPanne(){
        if(!empty($this->photo) && file_exists('upload/panne/' .$this->photo)){
           return url('upload/panne/' .$this->photo);
        }else{
            return "";
        }
    }

    public function getConducteur(){
    return $this->belongsTo(User::class, 'conducteur_id')
                ->where('role', 4);
}
}
