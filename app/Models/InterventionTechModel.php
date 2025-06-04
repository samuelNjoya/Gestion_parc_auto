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
        // $return = self::select('*');
         $return = self::select('intervention_technique.*', 'vehicule.immatriculation', 'vehicule.marque')
           ->join('vehicule', 'vehicule.id', '=', 'intervention_technique.vehicule_id');

            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('date'))){
                 $return = $return->where('date', 'like', '%' .Request::get('date').'%');
            }
               if(!empty(Request::get('type'))){
                 $return = $return->where('type', 'like', '%' .Request::get('type').'%');
            }
             if(!empty(Request::get('titre'))){
                 $return = $return->where('titre', 'like', '%' .Request::get('titre').'%');
            }
            if(!empty(Request::get('cout'))){
                    $return = $return->where('cout', 'like', '%' .Request::get('cout').'%');
             }
            if(!empty(Request::get('immatriculation'))){
             $return = $return->where('vehicule.immatriculation', 'like', '%' .Request::get('immatriculation').'%');
            }
            // if(!empty(Request::get('statut'))){
            //     $statut = Request::get('statut');
            //     if ($statut == 100) {
            //         $statut = 0;
            //     }
            //     $return = $return->where('statut', '=', $statut);
            //  }

     $return = $return->where('intervention_technique.is_delete', '=', 0)//whereIn
                ->orderBy('intervention_technique.id', 'desc')
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

      static public function sumOfMaintenance()
    {
        return self::select('*')->where('is_delete','=',0)->where('type','=','maintenance')->sum('cout');
    }

    static public function sumOfEntretien()
    {
        return self::select('*')->where('is_delete','=',0)->where('type','=','entretien')->sum('cout');
    }
       
}
