<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class DocumentVehiculeModel extends Model
{
    protected $table = 'document_vehicule';

    static public function getSingle($id){
        return DocumentVehiculeModel::find($id); 
    }

   static public function getDocumentVehicule(){
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

 

         // pour ajouter le scan du document pdf a la liste
    public function getDocumentVehiculeScan(){
        if(!empty($this->pdf_scan) && file_exists('upload/doc_vehicule/' .$this->pdf_scan)){
           return url('upload/doc_vehicule/' .$this->pdf_scan);
        }else{
            return "";
        }
    }

      //Pour dire que  un vehicule possede plusieurs document
    public function getVehicule(){
        return $this->belongsTo(VehiculeModel::class, 'vehicule_id');
    }

}
