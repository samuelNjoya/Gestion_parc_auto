<?php

use App\Http\Controllers\AuthController;
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


//Gestionnaire
   Route::get('panel/gestionnaire',[GestionnaireController::class, 'gestionnaire_list']);
   Route::get('panel/gestionnaire/create',[GestionnaireController::class, 'gestionnaire_create']);
   Route::post('panel/gestionnaire/create',[GestionnaireController::class, 'gestionnaire_insert']);
   Route::get('panel/gestionnaire/view/{id}',[GestionnaireController::class, 'gestionnaire_view']);
   Route::get('panel/gestionnaire/edit/{id}',[GestionnaireController::class, 'gestionnaire_edit']);
   Route::post('panel/gestionnaire/edit/{id}',[GestionnaireController::class, 'gestionnaire_update']);
   Route::get('panel/gestionnaire/delete/{id}',[GestionnaireController::class, 'gestionnaire_delete']);

   //fournisseur
   Route::get('panel/fournisseur',[FournisseurController::class, 'fournisseur_list']);
   Route::get('panel/fournisseur/create',[FournisseurController::class, 'fournisseur_create']);
   Route::post('panel/fournisseur/create',[FournisseurController::class, 'fournisseur_insert']);
   Route::get('panel/fournisseur/edit/{id}',[FournisseurController::class, 'fournisseur_edit']);
   Route::post('panel/fournisseur/edit/{id}',[FournisseurController::class, 'fournisseur_update']);
   Route::get('panel/fournisseur/delete/{id}',[FournisseurController::class, 'fournisseur_delete']);

//vehicule
   Route::get('panel/vehicule',[VehiculeController::class, 'vehicule_list']);
   Route::get('panel/vehicule/create',[VehiculeController::class, 'vehicule_create']);
   Route::post('panel/vehicule/create',[VehiculeController::class, 'vehicule_insert']);
   Route::get('panel/vehicule/view/{id}',[VehiculeController::class, 'vehicule_view']);
   Route::get('panel/vehicule/edit/{id}',[VehiculeController::class, 'vehicule_edit']);
   Route::post('panel/vehicule/edit/{id}',[VehiculeController::class, 'vehicule_update']);
   Route::get('panel/vehicule/delete/{id}',[VehiculeController::class, 'vehicule_delete']);