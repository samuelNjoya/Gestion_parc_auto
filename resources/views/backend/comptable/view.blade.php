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
                    <h5 class="card-title">comptable</h5>
                      @if (!empty($getRecords->getProfile()))
                        <img style="" width="550px" height="550px" class="mb-3 w-100 h-100" src="{{ $getRecords->getProfile() }}" alt="">
                       @endif 
                </div>
            </div>
        </div>

        <!-- Partie 2 : Informations -->
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Informations Personnelles</h5>
                    <dl class="info-list">
                        <div class="info-item">
                            <dt><i class="fas fa-user me-2"></i> Nom</dt>
                            <dd>{{$getRecords->nom}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-user me-2"></i> Prénom</dt>
                            <dd>{{$getRecords->prenom}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-envelope me-2"></i> Email</dt>
                           <dd>{{$getRecords->email}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-phone me-2"></i> Téléphone</dt>
                            <dd>{{$getRecords->telephone}}</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-id-card me-2"></i> Numéro de permis</dt>
                            <dd>FR123456789</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-calendar-alt me-2"></i> Date d’expiration</dt>
                            <dd>31/12/2027</dd>
                        </div>
                        <div class="info-item">
                            <dt><i class="fas fa-user-shield me-2"></i> Rôle</dt>
                            <dd>{{ ($getRecords->role == 3) ? 'comptable' : '/' }}</dd>
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
