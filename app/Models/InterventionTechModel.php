<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class InterventionTechModel extends Model
{
    protected $table = 'intervention_technique';

    static public function getSingle($id){
        return InterventionTechModel::find($id); 
    }


       static public function getInterventionTech(){
        $return = self::select('*');
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
            if(!empty(Request::get('kilometrage_plein'))){
             $return = $return->where('kilometrage_plein', 'like', '%' .Request::get('kilometrage_plein').'%');
            } 
            // if(!empty(Request::get('statut'))){
            //     $statut = Request::get('statut');
            //     if ($statut == 100) {
            //         $statut = 0;
            //     }
            //     $return = $return->where('statut', '=', $statut);
            //  }

     $return = $return->where('is_delete', '=', 0)//whereIn
                ->orderBy('id', 'desc')
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


//Pharse de stat
    static public function numberOfBoth()
    {
        return self::select('*')->where('is_delete','=',0)->count();
    }

    static public function numberOfMaintenance()
    {
        return self::select('*')->where('is_delete','=',0)->where('type','=','maintenance')->count();
    }

    static public function numberOfEntretien()
    {
        return self::select('*')->where('is_delete','=',0)->where('type','=','entretien')->count();
    }
       
}
