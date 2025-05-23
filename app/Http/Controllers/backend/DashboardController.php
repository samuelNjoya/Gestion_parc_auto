<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\InterventionTechModel;
use App\Models\User;
use App\Models\VehiculeModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function dashboard(){
      $data['meta_title'] = 'dashboard';//
      $data['getNumberConducteur'] = User::nombreConducteur();//nb driver 
      $data['getNumberIntervention'] = InterventionTechModel::numberOfBoth();
      $data['getNumberMaintenance'] = InterventionTechModel::numberOfMaintenance();
      $data['getNumberEntretien'] = InterventionTechModel::numberOfEntretien(); 
      $data['getNumberCar'] = VehiculeModel::numberOfCar(); 


       $user = Auth::user();
      //   $vehicules = $user->vehicules()->paginate(10);
      //  $data['vehicules'] = User::vehicules($user);
       $data['vehicules'] = $user->vehicules()->paginate(10);
       return view('backend.dashboard', $data);
   }


}
