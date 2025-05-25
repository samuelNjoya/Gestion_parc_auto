@extends('backend.layouts.app')
@section('content')

@if (Auth::user()->role == 1 || Auth::user()->role == 2)
<div class="container fade-in">
    <!-- Section de Statistiques -->
    <div class="row g-4">
        <!-- Carte : Nombre de Conducteurs -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="drivers-count">
                <i class="fas fa-users stat-icon" aria-hidden="true"></i>
                <h3 id="drivers-count" class="stat-title">Conducteurs</h3>
                <p class="stat-value" data-count="{{$getNumberConducteur}}">{{$getNumberConducteur}}</p>
            </div>
        </div>
        <!-- Carte : Nombre de Véhicules -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="vehicles-count">
                <i class="fas fa-car stat-icon" ></i>
                <h3 id="vehicles-count" class="stat-title">Véhicules</h3>
                <p class="stat-value" data-count="{{$getNumberCar}}">{{$getNumberCar}}</p>
            </div>
        </div>
        <!-- Carte : Nombre d’Interventions -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="interventions-count">
                <i class="fas fa-tools stat-icon" aria-hidden="true"></i>
                <h3 id="interventions-count" class="stat-title">Interventions</h3>
                <p class="stat-value" data-count="{{$getNumberIntervention}}">{{$getNumberIntervention}}</p>
                
            </div>
        </div>
        <!-- Carte : Nombre d’Assignations -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="assignments-count">
                <i class="fas fa-link stat-icon" aria-hidden="true"></i>
                <h3 id="assignments-count" class="stat-title">Assignations</h3>
                <p class="stat-value" data-count="{{$getNumberAffectation}}">{{$getNumberAffectation}}</p>
            </div>
        </div>
    </div>
</div>
@endif

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
            {{-- <h1 class="mb-4">Tableau de Bord</h1> --}}
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
            

            <!-- Statistiques -->  
     @if (Auth::user()->role == 1)
   
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
@section('scripts')

<script>
    // Animation des compteurs
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.stat-value');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const increment = target / 50; // Vitesse d’animation
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    });
</script>
    
@endsection

@section('styles')

<style>


    /* Conteneur principal */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Carte de statistique */
    .stat-card {
        background-color: var(--card-bg);
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        border: 1px solid var(--accent-color);
    }

    /* Icône */
    .stat-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    /* Titre */
    .stat-title {
        font-size: 1.25rem;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    /* Valeur */
    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        color: var(--text-color);
        margin: 0;
    }

    /* Animation Fade-in */
    .fade-in {
        animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .stat-card {
            padding: 15px;
        }

        .stat-icon {
            font-size: 2rem;
        }

        .stat-title {
            font-size: 1.1rem;
        }

        .stat-value {
            font-size: 1.75rem;
        }
    }
</style>
    
@endsection