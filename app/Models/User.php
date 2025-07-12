<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     // trés important pour le crud
    static public function getSingle($id){
        return User::find($id);
    }


    //Gestionnaire
     static public function getGestionnaire(){
        $return = self::select('*');
            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('nom'))){
                 $return = $return->where('nom', 'like', '%' .Request::get('nom').'%');
            }
             if(!empty(Request::get('prenom'))){
                 $return = $return->where('prenom', 'like', '%' .Request::get('prenom').'%');
            }
            if(!empty(Request::get('email'))){
                    $return = $return->where('email', 'like', '%' .Request::get('email').'%');
             }
            if(!empty(Request::get('address'))){
             $return = $return->where('address', 'like', '%' .Request::get('address').'%');
            } 
            if(!empty(Request::get('statut'))){
                $statut = Request::get('statut');
                if ($statut == 100) {
                    $statut = 0;
                }
                $return = $return->where('statut', '=', $statut);
             }

        $return = $return->where('role','=', 2)  
                ->where('is_delete', '=', 0)//whereIn
                ->orderBy('id', 'desc')
                ->paginate(10);   
        return $return;
    }

    //Comptable
     static public function getComptable(){
        $return = self::select('*');
            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('nom'))){
                 $return = $return->where('nom', 'like', '%' .Request::get('nom').'%');
            }
             if(!empty(Request::get('prenom'))){
                 $return = $return->where('prenom', 'like', '%' .Request::get('prenom').'%');
            }
            if(!empty(Request::get('email'))){
                    $return = $return->where('email', 'like', '%' .Request::get('email').'%');
             }
            if(!empty(Request::get('address'))){
             $return = $return->where('address', 'like', '%' .Request::get('address').'%');
            } 
            if(!empty(Request::get('statut'))){
                $statut = Request::get('statut');
                if ($statut == 100) {
                    $statut = 0;
                }
                $return = $return->where('statut', '=', $statut);
             }

        $return = $return->where('role','=', 3)  
                ->where('is_delete', '=', 0)//whereIn
                ->orderBy('id', 'desc')
                ->paginate(10);   
        return $return;
    }
    

    //Fournisseur
      static public function getFournisseur(){
        $return = self::select('*');
            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('nom'))){
                 $return = $return->where('nom', 'like', '%' .Request::get('nom').'%');
            }
             if(!empty(Request::get('prenom'))){
                 $return = $return->where('prenom', 'like', '%' .Request::get('prenom').'%');
            }
            if(!empty(Request::get('email'))){
                    $return = $return->where('email', 'like', '%' .Request::get('email').'%');
             }
            if(!empty(Request::get('address'))){
             $return = $return->where('address', 'like', '%' .Request::get('address').'%');
            } 
            if(!empty(Request::get('statut'))){
                $statut = Request::get('statut');
                if ($statut == 100) {
                    $statut = 0;
                }
                $return = $return->where('statut', '=', $statut);
             }

        $return = $return->where('role','=', 5)  
                ->where('is_delete', '=', 0)//whereIn
                ->orderBy('id', 'desc')
                ->paginate(10);   
        return $return;
    }

     static public function getFournisseurActive(){ 
        $return = self::select('*')
                 ->where('statut', '=', 1)
                 ->where('role', '=', 5)// 5 represente le fournisseur
                 ->where('is_delete', '=', 0)// pour supprimer et conservé
                ->orderBy('id', 'desc')
                ->get();   
        return $return;
    }
    
    //Conducteur
      static public function getConducteur(){
        $return = self::select('*');
            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('nom'))){
                 $return = $return->where('nom', 'like', '%' .Request::get('nom').'%');
            }
             if(!empty(Request::get('prenom'))){
                 $return = $return->where('prenom', 'like', '%' .Request::get('prenom').'%');
            }
            if(!empty(Request::get('email'))){
                    $return = $return->where('email', 'like', '%' .Request::get('email').'%');
             }
            if(!empty(Request::get('address'))){
             $return = $return->where('address', 'like', '%' .Request::get('address').'%');
            } 
            if(!empty(Request::get('statut'))){
                $statut = Request::get('statut');
                if ($statut == 100) {
                    $statut = 0;
                }
                $return = $return->where('statut', '=', $statut);
             }

        $return = $return->where('role','=', 4)  
                ->where('is_delete', '=', 0)//whereIn
                ->orderBy('id', 'desc')
                ->paginate(10);   
        return $return;
    }

    static public function getConducteurActive(){ 
        $return = self::select('*')
                 ->where('statut', '=', 1)
                 ->where('role', '=', 4)// 5 represente le conducteur
                 ->where('is_delete', '=', 0)// pour supprimer et conservé
                ->orderBy('id', 'desc')
                ->get();   
        return $return;
    }

     public function getCreatedBy(){
        return $this->belongsTo(User::class, 'created_by_id');
    }

       // pour ajouter une photo a la liste
    public function getProfile(){
        if(!empty($this->profile_pic) && file_exists('upload/profile/' .$this->profile_pic)){
           return url('upload/profile/' .$this->profile_pic);
        }else{
            return "";
        }
    }

    //fonction pour ajouter dynamiquement une image la retrouver dans le _sideBar
    public function getProfileLive(){
        if(!empty($this->profile_pic) && file_exists('upload/profile/' .$this->profile_pic)){
           return url('upload/profile/' .$this->profile_pic);
        }else{
            return url('upload/profile/user.png');
        }
    }

        //compter le nombre de conducteur 
   static public function nombreConducteur()
   {
     return self::where('role','=',4)->where('is_delete','=',0)->count();
   }


 
 public function vehicules():BelongsToMany
{
    return $this->belongsToMany(VehiculeModel::class, 'affectation_vehecule', 'conducteur_id', 'vehicule_id')
                ->withPivot('description', 'date_debut', 'date_fin', 'statut', 'is_delete', 'updated_at', 'created_at')
                ->wherePivot('is_delete', 0) // si vous souhaitez filtrer les non-supprimés
                ->wherePivot('statut', 1); // si vous souhaitez filtrer par statut
}


}
