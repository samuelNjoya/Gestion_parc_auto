<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class PieceModel extends Model
{
    protected $table = 'piece';

    static public function getSingle($id){
        return PieceModel::find($id); 
    }


       static public function getPiece(){
        $return = self::select('*');
        //  $return = self::select('intervention_technique.*', 'vehicule.immatriculation', 'vehicule.marque')
        //    ->join('vehicule', 'vehicule.id', '=', 'intervention_technique.vehicule_id');

            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('nom'))){
                 $return = $return->where('nom', 'like', '%' .Request::get('nom').'%');
            }
               if(!empty(Request::get('reference'))){
                 $return = $return->where('reference', 'like', '%' .Request::get('reference').'%');
            }
            //  if(!empty(Request::get('titre'))){
            //      $return = $return->where('titre', 'like', '%' .Request::get('titre').'%');
            // }
            // if(!empty(Request::get('cout'))){
            //         $return = $return->where('cout', 'like', '%' .Request::get('cout').'%');
            //  }
            // if(!empty(Request::get('immatriculation'))){
            //  $return = $return->where('vehicule.immatriculation', 'like', '%' .Request::get('immatriculation').'%');
            // }
            if(!empty(Request::get('statut'))){
                $statut = Request::get('statut');
                if ($statut == 100) {
                    $statut = 0;
                }
                $return = $return->where('statut', '=', $statut);
             }

     $return = $return->where('is_delete', '=', 0)//whereIn
                ->orderBy('id', 'desc')
                ->paginate(10);   
        return $return;
    }



  //Pour dire que  une intervention possede plusieurs piece
    public function getInterventionTechnique(){
        return $this->belongsTo(InterventionTechModel::class, 'intervention_id');
    }
       
}
