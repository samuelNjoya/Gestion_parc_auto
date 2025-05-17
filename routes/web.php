<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\CarburantController;
use App\Http\Controllers\backend\ComptableController;
use App\Http\Controllers\backend\ConducteurController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\GestionnaireController;
use App\Http\Controllers\backend\FournisseurController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\VehiculeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/',[AuthController::class,'login']);
Route::get('logout',[AuthController::class, 'logout']);
Route::post('/',[AuthController::class, 'auth_login']);

//Dashboard
Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);

//Dashboard
Route::get('panel/aide',[UserController::class, 'aide']);
Route::get('panel/mon_compte',[UserController::class, 'mon_compte']);
Route::get('panel/changer_password',[UserController::class, 'changer_password']);


//Gestionnaire
   Route::get('panel/gestionnaire',[GestionnaireController::class, 'gestionnaire_list']);
   Route::get('panel/gestionnaire/create',[GestionnaireController::class, 'gestionnaire_create']);
   Route::post('panel/gestionnaire/create',[GestionnaireController::class, 'gestionnaire_insert']);
   Route::get('panel/gestionnaire/view/{id}',[GestionnaireController::class, 'gestionnaire_view']);
   Route::get('panel/gestionnaire/edit/{id}',[GestionnaireController::class, 'gestionnaire_edit']);
   Route::post('panel/gestionnaire/edit/{id}',[GestionnaireController::class, 'gestionnaire_update']);
   Route::get('panel/gestionnaire/delete/{id}',[GestionnaireController::class, 'gestionnaire_delete']);

   //comptable
   Route::get('panel/comptable',[ComptableController::class, 'comptable_list']);
   Route::get('panel/comptable/create',[ComptableController::class, 'comptable_create']);
   Route::post('panel/comptable/create',[ComptableController::class, 'comptable_insert']);
   Route::get('panel/comptable/view/{id}',[ComptableController::class, 'comptable_view']);
   Route::get('panel/comptable/edit/{id}',[ComptableController::class, 'comptable_edit']);
   Route::post('panel/comptable/edit/{id}',[ComptableController::class, 'comptable_update']);
   Route::get('panel/comptable/delete/{id}',[ComptableController::class, 'comptable_delete']);

   //fournisseur
   Route::get('panel/fournisseur',[FournisseurController::class, 'fournisseur_list']);
   Route::get('panel/fournisseur/create',[FournisseurController::class, 'fournisseur_create']);
   Route::post('panel/fournisseur/create',[FournisseurController::class, 'fournisseur_insert']);
   Route::get('panel/fournisseur/edit/{id}',[FournisseurController::class, 'fournisseur_edit']);
   Route::post('panel/fournisseur/edit/{id}',[FournisseurController::class, 'fournisseur_update']);
   Route::get('panel/fournisseur/delete/{id}',[FournisseurController::class, 'fournisseur_delete']);

   //conducteur
   Route::get('panel/conducteur',[ConducteurController::class, 'conducteur_list']);
   Route::get('panel/conducteur/create',[ConducteurController::class, 'conducteur_create']);
   Route::post('panel/conducteur/create',[ConducteurController::class, 'conducteur_insert']);
   Route::get('panel/conducteur/view/{id}',[ConducteurController::class, 'conducteur_view']);
   Route::get('panel/conducteur/edit/{id}',[ConducteurController::class, 'conducteur_edit']);
   Route::post('panel/conducteur/edit/{id}',[ConducteurController::class, 'conducteur_update']);
   Route::get('panel/conducteur/delete/{id}',[ConducteurController::class, 'conducteur_delete']);

//vehicule
   Route::get('panel/vehicule',[VehiculeController::class, 'vehicule_list']);
   Route::get('panel/vehicule/create',[VehiculeController::class, 'vehicule_create']);
   Route::post('panel/vehicule/create',[VehiculeController::class, 'vehicule_insert']);
   Route::get('panel/vehicule/view/{id}',[VehiculeController::class, 'vehicule_view']);
   Route::get('panel/vehicule/edit/{id}',[VehiculeController::class, 'vehicule_edit']);
   Route::post('panel/vehicule/edit/{id}',[VehiculeController::class, 'vehicule_update']);
   Route::get('panel/vehicule/delete/{id}',[VehiculeController::class, 'vehicule_delete']);

   
   //conso carburant
   Route::get('panel/conso_carburant',[CarburantController::class, 'conso_carburant_list']);
   Route::get('panel/conso_carburant/create',[CarburantController::class, 'conso_carburant_create']);
   Route::post('panel/conso_carburant/create',[CarburantController::class, 'conso_carburant_insert']);
   Route::get('panel/conso_carburant/edit/{id}',[CarburantController::class, 'conso_carburant_edit']);
   Route::post('panel/conso_carburant/edit/{id}',[CarburantController::class, 'conso_carburant_update']);
   Route::get('panel/conso_carburant/delete/{id}',[CarburantController::class, 'conso_carburant_delete']);