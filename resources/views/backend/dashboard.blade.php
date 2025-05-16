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
       
        </div>
@endsection