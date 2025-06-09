<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AffecterVehiculeModel;
use App\Models\ConsoCarburantModel;
use App\Models\InterventionTechModel;
use App\Models\User;
use App\Models\VehiculeModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function dashboard(){
      $data['meta_title'] = 'dashboard';// 
      $data['getNumberConducteur'] = User::nombreConducteur();//nb driver  
      $data['getNumberIntervention'] = InterventionTechModel::numberOfBoth();
      $data['getNumberMaintenance'] = InterventionTechModel::numberOfMaintenance();
      $data['getNumberEntretien'] = InterventionTechModel::numberOfEntretien(); 
      $data['getNumberCar'] = VehiculeModel::numberOfCar(); 
      $data['getNumberAffectation'] = AffecterVehiculeModel::nombreAffectation();
      $data['getSumEntretien'] = InterventionTechModel::sumOfEntretien(); 
      $data['getSumMaintenance'] = InterventionTechModel::sumOfMaintenance();
      $data['getSumConsoCarburant'] = ConsoCarburantModel::sumOfConsoCarburant();

       $user = Auth::user();
      //  $vehicules = $user->vehicules()->paginate(10);
      //  $data['vehicules'] = User::vehicules($user);
       $data['vehicules'] = $user->vehicules()->paginate(10);

       return view('backend.dashboard', $data);
   }


}
