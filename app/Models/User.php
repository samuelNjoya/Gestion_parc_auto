<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
    
    //Fournisseur
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

    
}
