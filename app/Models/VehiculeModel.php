<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class VehiculeModel extends Model
{
    protected $table = 'vehicule';

    static public function getSingle($id){
        return VehiculeModel::find($id); 
    }

    static public function getVehicule(){ //$user_id, $user_type en paramètre
        $return = self::select('*');
            if(!empty(Request::get('immatriculation'))){
                 $return = $return->where('immatriculation', '=', Request::get('immatriculation'));
            }
            if(!empty(Request::get('marque'))){
                 $return = $return->where('marque', 'like', '%' .Request::get('marque').'%');
            }
             if(!empty(Request::get('modele'))){
                 $return = $return->where('modele', 'like', '%' .Request::get('modele').'%');
            }
             if(!empty(Request::get('type_caburant'))){
                 $return = $return->where('type_carburant', 'like', '%' .Request::get('type_caburant').'%');
            }
             if(!empty(Request::get('departement'))){
                 $return = $return->where('departement', 'like', '%' .Request::get('departement').'%');
            }
           
            if(!empty(Request::get('statut'))){
                $statut = Request::get('statut');
                if ($statut == 100) {
                    $statut = 0;
                }
                $return = $return->where('statut', '=', $statut);
             }

           //  $return = $return->where('created_by_id', '=', $user_id);// cette fonction pour que l'admin puisse voire les teachers

        $return = $return->where('is_delete', '=', 0)
                ->orderBy('id', 'desc')
                ->paginate(10);   
        return $return;
    }

    static public function getVehiculeActive(){ //en paramètre $user_id vehicule actifs
        $return = self::select('*')
                 ->where('statut', '=', 1)
             //    ->where('created_by_id', '=', $user_id)// cette fonction pour que l'admin puisse voire les teachers
                 ->where('is_delete', '=', 0)// pour supprimer et conservé
                ->orderBy('id', 'desc')
                ->get();   
        return $return;
    }

     static public function numberOfCar()
    {
        return self::select('*')->where('is_delete','=',0)->count();
    }

         // pour ajouter la photo du vehicule a la liste
    public function getPhotoVoiture(){
        if(!empty($this->photo) && file_exists('upload/vehicule/' .$this->photo)){
           return url('upload/vehicule/' .$this->photo);
        }else{
            return "";
        }
    }

    //affecter vehicule
    public function conducteurs()
{
    return $this->belongsToMany(User::class, 'affectation-vehecule','vehicule_id', 'conducteur_id')
                ->using(AffecterVehiculeModel::class)
                ->withPivot('date_affectation', 'statut')
                ->withTimestamps();
}

}
