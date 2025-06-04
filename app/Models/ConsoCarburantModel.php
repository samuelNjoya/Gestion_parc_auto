<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ConsoCarburantModel extends Model
{
    protected $table = 'conso_carburant';

    static public function getSingle($id){
        return ConsoCarburantModel::find($id); 
    }


       static public function getConsoCarburant(){
        // $return = self::select('*');

         $return = self::select('conso_carburant.*', 'vehicule.immatriculation', 'vehicule.marque')
           ->join('vehicule', 'vehicule.id', '=', 'conso_carburant.vehicule_id');

            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('date_conso'))){
                 $return = $return->where('date_conso', 'like', '%' .Request::get('date_conso').'%');
            }
             if(!empty(Request::get('quantite_conso'))){
                 $return = $return->where('quantite_conso', 'like', '%' .Request::get('quantite_conso').'%');
            }
            if(!empty(Request::get('cout_conso'))){
                    $return = $return->where('cout_conso', 'like', '%' .Request::get('cout_conso').'%');
             }
            if(!empty(Request::get('immatriculation'))){
             $return = $return->where('vehicule.immatriculation', 'like', '%' .Request::get('immatriculation').'%');
            } 
             if(!empty(Request::get('marque'))){
             $return = $return->where('vehicule.marque', 'like', '%' .Request::get('marque').'%');
            } 
            //  if(!empty(Request::get('kilometrage_plein'))){
            //  $return = $return->where('kilometrage_plein', 'like', '%' .Request::get('kilometrage_plein').'%');
            // } 
            // if(!empty(Request::get('statut'))){
            //     $statut = Request::get('statut');
            //     if ($statut == 100) {
            //         $statut = 0;
            //     }
            //     $return = $return->where('statut', '=', $statut); vehicule.
            //  }

     $return = $return->where('conso_carburant.is_delete', '=', 0)//whereIn
                ->orderBy('conso_carburant.id', 'desc')
                ->paginate(10);   
        return $return;
    }


    //Pour dire que plusieurs vehicules peuvent être affecter a une consommation carburant un vehicule consomme plusieurs fois
    public function getVehicule(){
        return $this->belongsTo(VehiculeModel::class, 'vehicule_id');
    }


    public function getFournisseur(){
    return $this->belongsTo(User::class, 'fournisseur_id')
                ->where('role', 5);
}

        static public function sumOfConsoCarburant()
        {
            return self::where('is_delete', '=', 0)->sum('cout_conso');
        }


       
}
