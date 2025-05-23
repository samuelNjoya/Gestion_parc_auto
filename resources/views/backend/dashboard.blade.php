@extends('backend.layouts.app')
@section('content')


@if (Auth::user()->role == 4)
<div class="container">
    <h2>Mes véhicules assignés</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Immatriculation</th>
                <th>Modèle</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Statut</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicules as $vehicule)
            <tr>
                <td>{{ $vehicule->immatriculation }}</td>
                <td>{{ $vehicule->modele }}</td>
                <td>{{ \Carbon\Carbon::parse($vehicule->pivot->date_debut)->format('d/m/Y') }}</td>
                <td>
                    @if($vehicule->pivot->date_fin)
                        {{ \Carbon\Carbon::parse($vehicule->pivot->date_fin)->format('d/m/Y') }}
                    @else
                        En cours
                    @endif
                </td>
                <td>{{ $vehicule->pivot->statut ? 'Actif' : 'Inactif' }}</td>
                <td>{{ $vehicule->pivot->description }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Aucun véhicule assigné</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $vehicules->links() }}
</div>
@endif


    <div class="container-fluid fade-in">
            <h1 class="mb-4">Tableau de Bord</h1>
               <div class="charts-grid">
                    <div class="chart-container">
                        <h3></h3>
                        <canvas id="epiDistributionChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Coût (par mois)</h3>
                        <canvas id="maintenanceAlertsChart"></canvas>
                    </div>
                </div>
            <!-- Carte de bienvenue -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Bienvenue, Jean Dupont</h5>
                    <p class="card-text">Gérez votre parc automobile efficacement avec notre plateforme.</p>
                </div>
            </div>
             <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Nombre de conducteur</h5>
                    <p class="card-text">{{$getNumberConducteur}}</p>
                </div>
            </div>

            <!-- Statistiques -->  
      @if (Auth::user()->role == 1)
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Véhicules</h5>
                            <p class="card-text">Total : <strong>{{$getNumberCar}}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Intervention technique</h5>
                            <p class="card-text">Nombre : <strong>{{$getNumberIntervention}}</strong></p>
                            <p class="card-text">Nombre Maintenance: <strong>{{$getNumberMaintenance}}</strong></p>
                             <p class="card-text">Nombre Entretien: <strong>{{$getNumberEntretien}}</strong></p>
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
            @endif

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