@extends('backend.layouts.app')
@section('content')
    <div class="container-fluid fade-in">
            <h1 class="mb-4">Tableau de Bord</h1>

            <!-- Carte de bienvenue -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Bienvenue, Jean Dupont</h5>
                    <p class="card-text">Gérez votre parc automobile efficacement avec notre plateforme.</p>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Véhicules</h5>
                            <p class="card-text">Total : <strong>25</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Maintenances à venir</h5>
                            <p class="card-text">Nombre : <strong>5</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Coût carburant</h5>
                            <p class="card-text">Mois : <strong>€2,500</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <!-- Correction pour affichage des graphiques Chart.js -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Coût Carburant par Mois</h5>
                            <div class="chart-container">
                                <canvas id="fuelCostChart"></canvas>
                            </div>
                            <figcaption class="text-center text-muted">Coût mensuel du carburant (€)</figcaption>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Types de Maintenance</h5>
                            <div class="chart-container">
                                <canvas id="maintenanceTypeChart"></canvas>
                            </div>
                            <figcaption class="text-center text-muted">Répartition des types de maintenance</figcaption>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Consommation Moyenne par Véhicule</h5>
                            <div class="chart-container">
                                <canvas id="consumptionChart"></canvas>
                            </div>
                            <figcaption class="text-center text-muted">Consommation moyenne (L/100 km)</figcaption>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des véhicules récents -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Véhicules Récents</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Marque</th>
                                    <th>Modèle</th>
                                    <th>Immatriculation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Peugeot</td>
                                    <td>308</td>
                                    <td>ABC-123-CD</td>
                                    <td><a href="/vehicle/1" class="btn btn-primary btn-sm">Voir</a></td>
                                </tr>
                                <tr>
                                    <td>Renault</td>
                                    <td>Clio</td>
                                    <td>XYZ-456-EF</td>
                                    <td><a href="/vehicle/2" class="btn btn-primary btn-sm">Voir</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tableau des véhicules -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Immatriculation <button class="btn btn-link p-0" onclick="sortTable(0)"><i class="fas fa-sort"></i></button></th>
                        <th>Modèle <button class="btn btn-link p-0" onclick="sortTable(1)"><i class="fas fa-sort"></i></button></th>
                        <th>Kilométrage <button class="btn btn-link p-0" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="vehicleTableBody">
                    <tr>
                        <td>AB-123-CD</td>
                        <td>Peugeot 208</td>
                        <td>45 000 km</td>
                        <td><span class="badge bg-success">En service</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="editVehicle(this)"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteVehicle(this)"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>XY-456-ZD</td>
                        <td>Renault Clio</td>
                        <td>78 000 km</td>
                        <td><span class="badge bg-warning">En maintenance</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="editVehicle(this)"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteVehicle(this)"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>EF-789-GH</td>
                        <td>Citroën C3</td>
                        <td>120 000 km</td>
                        <td><span class="badge bg-danger">Hors service</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="editVehicle(this)"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deleteVehicle(this)"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
@endsection