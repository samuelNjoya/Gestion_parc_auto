@extends('backend.layouts.app')
@section('content')

@if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3)
<div class="container fade-in">
    <!-- Section de Statistiques -->
    <div class="row g-4">
        <!-- Carte : Nombre de Conducteurs -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="drivers-count">
                <i class="fas fa-users stat-icon" aria-hidden="true"></i>
                <h3 id="drivers-count" class="stat-title">Conducteurs</h3>
                <p class="stat-value" data-count="{{$getNumberConducteur}}">0</p>
            </div>
        </div>
        <!-- Carte : Nombre de Véhicules -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="vehicles-count">
                <i class="fas fa-car stat-icon" ></i>
                <h3 id="vehicles-count" class="stat-title">Véhicules</h3>
                <p class="stat-value" data-count="{{$getNumberCar}}">0</p>
            </div>
        </div>
        <!-- Carte : Nombre d’Interventions -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="interventions-count">
                <i class="fas fa-tools stat-icon" aria-hidden="true"></i>
                <h3 id="interventions-count" class="stat-title">Interventions</h3>
                <p class="stat-value" data-count="{{$getNumberIntervention}}">0</p>
                
            </div>
        </div>
        <!-- Carte : Nombre d’Assignations  Gérez vos véhicules, conducteurs et interventions en toute simplicité.-->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="assignments-count">
                <i class="fas fa-link stat-icon" aria-hidden="true"></i>
                <h3 id="assignments-count" class="stat-title">Assignations</h3>
                <p class="stat-value" data-count="{{$getNumberAffectation}}">0</p>
            </div>
        </div>

         <!-- Carte : Nombre d’Assignations -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="assignments-count">
                <i class="fas fa-link stat-icon" aria-hidden="true"></i>
                <h3 id="assignments-count" class="stat-title">Coût total Entretien</h3>
                <p class="stat-value" data-count="{{$getSumEntretien}}">0</p><span class="fw-bold ">FCFA</span>
            </div>
        </div>
         <!-- Carte : Nombre d’Assignations -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="assignments-count">
                <i class="fas fa-tools stat-icon" aria-hidden="true"></i>
                <h3 id="assignments-count" class="stat-title">Coût total Maintenance</h3>
                <p class="stat-value" data-count="{{$getSumMaintenance}}">0</p><span class="fw-bold ">FCFA</span>
            </div>
        </div>
         <!-- Carte : Nombre d’Assignations -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" role="region" aria-labelledby="assignments-count">
               <i class="fas fa-gas-pump stat-icon"></i>
                <h3 id="assignments-count" class="stat-title">Coût total Consommation du carburant</h3>
                <p class="stat-value" data-count="{{$getSumConsoCarburant}} ">0</p><span class="fw-bold ">FCFA</span>
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
                <th>signaler problème</th>
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
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPieceModal" data-affectation-id="{{ $vehicule->id }}">
                       Signaler
                    </button>
                </td>
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
{{-- @php
    dd($vehicule->pivot); // Affiche toute la structure du pivot
@endphp --}}
<!-- Modal Bootstrap -->
<div class="modal fade" id="addPieceModal" tabindex="-1" aria-labelledby="addPieceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{route('pannes.insert')}}" novalidate id="formulaire" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="affectation_id" id="affectation_id" value="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPieceModalLabel">Declarer une panne</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
            <div class="form-group ">
                <div class="form-group">
                    <label for="piece_name" class="form-label">Type</label>
                    <input type="text" name="type" class="form-control" value="{{old('type')}}"  class="" required>
                     <div class="invalid-feedback">Veuillez Entrer le type(moteur...).</div>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Localisation</label>
                    <input type="text" name="localisation" class="form-control" value="{{old('localisation')}}" id="" class="" required>
                     <div class="invalid-feedback">Veuillez entrer la localisation.</div>
                </div>
            </div>
          
            <div class="form-group side-by-side">
                    <div class="form-group">
                        <label for="vehicule" class="form-label">kilometrage </label>
                         <input type="number" name="kilometrage_panne" value="{{old('kilometrage_panne')}}" id="dateIntervention" class="form-control" required />
                        <div class="invalid-feedback">Veuillez saisir le kilometrage.</div>
                    </div>
                    <div class="form-group">
                        <label for="vehicule" class="form-label">Date panne</label>
                         <input type="date" name="date_panne" value="{{old('date_panne')}}"  class="form-control" required />
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                    </div>
            </div>   
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" class="form-control" name="description" value="{{old('description')}}" rows="3" placeholder="Description"></textarea>
                </div>

                <div class="form-group full-width">
                            <label for="photo">Photo</label>
                            <input type="file" id="photo" name="profile_pic" accept="image/*" aria-describedby="photoHelp" value="{{ old('profile_pic') }}">
                            <!-- <small id="photoHelp" class="form-text">Choisissez une image (JPEG, PNG).</small> -->
                            <div class="photo-preview">
                                <img id="photoPreview"  alt="">
                            </div>
                        </div>

                 <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" class="form-control" required aria-required="true">
                                <option value="">Sélectionnez</option>
                                <option value="1">En attente</option>
                                <option value="0">Résolu</option>
                            </select>
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                 </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </div>
    </form>
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


 // Trés important pour l'ID de l'affectation en paramettre
  document.addEventListener('DOMContentLoaded', function () {
        var addPieceModal = document.getElementById('addPieceModal');
        addPieceModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Bouton qui a déclenché le modal
            var affectationId = button.getAttribute('data-affectation-id');
            var inputAffectation = addPieceModal.querySelector('#affectation_id');
            inputAffectation.value = affectationId;
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