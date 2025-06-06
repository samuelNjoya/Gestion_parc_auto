@extends('backend.layouts.app')
@section('content')
 <h1>Plus d'information</h1>
 <div class="container fade-in">
    <!-- Conteneur pour le profil utilisateur -->
    <div class="row g-4">
        <!-- Partie 1 : Photo -->
        <div class="col-md-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Vehicule</h5>
                      @if (!empty($getRecords->getPhotoVoiture()))
                        <img style="" width="550px" height="550px" class="mb-3 w-100 h-100" src="{{ $getRecords->getPhotoVoiture() }}" alt="">
                       @endif 
                </div>
            </div>
        </div>

        <!-- Partie 2 : Informations -->
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Plus d'Informations </h5>
                    <dl class="info-list">
                        <div class="info-item">
                            <dt><i class="fas fa-user me-2"></i> immatriculation</dt>
                            <dd>{{$getRecords->immatriculation}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-user me-2"></i> marque</dt>
                            <dd>{{$getRecords->marque}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-envelope me-2"></i> modele</dt>
                           <dd>{{$getRecords->modele}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-phone me-2"></i> Téléphone</dt>
                            <dd>{{$getRecords->telephone}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-id-card me-2"></i> kilometrage</dt>
                            <dd>{{$getRecords->kilometrage}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-calendar-alt me-2"></i> departement</dt>
                            <dd>{{$getRecords->departement}}</dd>
                        </div>
                         <div class="info-item">
                            <dt><i class="fas fa-calendar-alt me-2"></i> Type carburant</dt>
                            <dd>{{$getRecords->type_carburant}}</dd>
                        </div>
                          <p>
                            statut  : {{ ($getRecords->statut == 1) ? 'Active' : 'inative' }}
                          </p>
                    </dl>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
