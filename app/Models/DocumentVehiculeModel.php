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
        // $return = self::select('*');

           $return = self::select('document_vehicule.*', 'vehicule.immatriculation', 'vehicule.marque')
           ->join('vehicule', 'vehicule.id', '=', 'document_vehicule.vehicule_id');

            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('type'))){
                 $return = $return->where('type', 'like', '%' .Request::get('type').'%');
            }
             if(!empty(Request::get('immatriculation'))){
                 $return = $return->where('vehicule.immatriculation', 'like', '%' .Request::get('immatriculation').'%');
            }
            if(!empty(Request::get('marque'))){
                    $return = $return->where('vehicule.marque', 'like', '%' .Request::get('marque').'%');
             }
            // if(!empty(Request::get('kilometrage_plein'))){
            //  $return = $return->where('kilometrage_plein', 'like', '%' .Request::get('kilometrage_plein').'%');
            // } 
            if(!empty(Request::get('statut'))){
                $statut = Request::get('statut');
                if ($statut == 100) {
                    $statut = 0;
                }
                $return = $return->where('document_vehicule.statut', '=', $statut);
             }

     $return = $return->where('document_vehicule.is_delete', '=', 0)//whereIn
                ->orderBy('document_vehicule.id', 'desc')
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
