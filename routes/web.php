<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\AffecterVehiculeController;
use App\Http\Controllers\backend\CarburantController;
use App\Http\Controllers\backend\ComptableController;
use App\Http\Controllers\backend\ConducteurController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DocumentsVehiculeController;
use App\Http\Controllers\backend\GestionnaireController;
use App\Http\Controllers\backend\FournisseurController;
use App\Http\Controllers\backend\InterventionTechController;
use App\Http\Controllers\backend\PanneController;
use App\Http\Controllers\backend\PieceController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\VehiculeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/',[AuthController::class,'login']);
Route::get('logout',[AuthController::class, 'logout']);
Route::post('/',[AuthController::class, 'auth_login']);

// Route::middleware('admin')->get('/test-admin', function () {
//     return 'Middleware admin fonctionne';
// });



Route::group(['middleware' => 'common'], function(){

   //Dashboard
   Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);

   Route::get('panel/aide',[UserController::class, 'aide']);
   Route::get('panel/mon_compte',[UserController::class, 'mon_compte']);
   Route::post('panel/mon_compte',[UserController::class, 'update_account']);

   Route::get('panel/changer_password',[UserController::class, 'changer_password']);
   Route::post('panel/changer_password',[UserController::class, 'update_password']);
});

// Route::group(['middleware' => 'admin'], function(){
//     Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);
// });
    Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);

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
   //historique cout dans le diagramme en bande
   Route::get('panel/historique_cout/{annee?}',[CarburantController::class, 'coutParMois']);

   //documentsVehicule
   Route::get('panel/documentsVehicule',[DocumentsVehiculeController::class, 'documentsVehicule_list']);
   Route::get('panel/documentsVehicule/create',[DocumentsVehiculeController::class, 'documentsVehicule_create']);
   Route::post('panel/documentsVehicule/create',[DocumentsVehiculeController::class, 'documentsVehicule_insert']);
   Route::get('panel/documentsVehicule/view/{id}',[DocumentsVehiculeController::class, 'documentsVehicule_view']);
   Route::get('panel/documentsVehicule/edit/{id}',[DocumentsVehiculeController::class, 'documentsVehicule_edit']);
   Route::post('panel/documentsVehicule/edit/{id}',[DocumentsVehiculeController::class, 'documentsVehicule_update']);
   Route::get('panel/documentsVehicule/delete/{id}',[DocumentsVehiculeController::class, 'documentsVehicule_delete']);

   //intervention_tech
   Route::get('panel/intervention_tech',[InterventionTechController::class, 'intervention_tech_list']);
   Route::get('panel/intervention_tech/create',[InterventionTechController::class, 'intervention_tech_create']);
   Route::post('panel/intervention_tech/create',[InterventionTechController::class, 'intervention_tech_insert']);
   Route::get('panel/intervention_tech/edit/{id}',[InterventionTechController::class, 'intervention_tech_edit']);
   Route::post('panel/intervention_tech/edit/{id}',[InterventionTechController::class, 'intervention_tech_update']);
   Route::get('panel/intervention_tech/delete/{id}',[InterventionTechController::class, 'intervention_tech_delete']);

   //Pièce
   Route::get('panel/piece',[PieceController::class, 'piece_list']);
   Route::post('panel/pieces/create', [PieceController::class, 'piece_insert'])->name('pieces.insert');
   Route::get('panel/piece/edit/{id}',[PieceController::class, 'piece_edit']);
   Route::post('panel/piece/edit/{id}',[PieceController::class, 'piece_update']);
   Route::get('panel/piece/delete/{id}',[PieceController::class, 'piece_delete']);

   //affecter_vehicule
   Route::get('panel/affecter_vehicule',[AffecterVehiculeController::class, 'affecter_vehicule_list']);
   Route::get('panel/affecter_vehicule/create',[AffecterVehiculeController::class, 'affecter_vehicule_create']);
   Route::post('panel/affecter_vehicule/create',[AffecterVehiculeController::class, 'affecter_vehicule_insert']);
   Route::get('panel/affecter_vehicule/edit/{id}',[AffecterVehiculeController::class, 'affecter_vehicule_edit']);
   Route::post('panel/affecter_vehicule/edit/{id}',[AffecterVehiculeController::class, 'affecter_vehicule_update']);
   Route::get('panel/affecter_vehicule/delete/{id}',[AffecterVehiculeController::class, 'affecter_vehicule_delete']);

   //Pièce
   Route::get('panel/panne',[PanneController::class, 'panne_list']);
   Route::post('panel/panne/create', [PanneController::class, 'panne_insert'])->name('pannes.insert');
   Route::get('panel/panne/edit/{id}',[PanneController::class, 'panne_edit']);
   Route::post('panel/panne/edit/{id}',[PanneController::class, 'panne_update']);
   Route::get('panel/panne/delete/{id}',[PanneController::class, 'panne_delete']);

   //exportation 

   //conducteur
   Route::get('panel/conducteur/users_excel',[UserController::class, 'users_excel']);
   Route::get('panel/conducteur/users_pdf',[UserController::class, 'users_pdf']);

   //vehicule
   Route::get('panel/vehicule/users_excel',[VehiculeController::class, 'vehicule_excel']);
   Route::get('panel/vehicule/users_pdf',[VehiculeController::class, 'vehicule_pdf']);

   //intervention_tech
   Route::get('panel/intervention_tech/users_excel',[VehiculeController::class, 'intervention_technique_excel']);
   Route::get('panel/intervention_tech/users_pdf',[VehiculeController::class, 'intervention_technique_pdf']);

   //consommation carburant
   Route::get('panel/conso_carburant/users_excel',[VehiculeController::class, 'conso_carburant_excel']);
   Route::get('panel/conso_carburant/users_pdf',[VehiculeController::class, 'conso_carburant_pdf']);

// Route::group(['middleware' => 'gestionnaire'], function(){
//     Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);  
// });

// Route::group(['middleware' => 'comptable'], function(){
//     Route::get('comptable/dashboard',[DashboardController::class, 'dashboard']);
// });

// Route::group(['middleware' => 'conducteur'], function(){
//     Route::get('conducteur/dashboard',[DashboardController::class, 'dashboard']);
// });