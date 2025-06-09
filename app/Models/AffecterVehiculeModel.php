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
