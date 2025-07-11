@extends('backend.layouts.app')
@section('content')
    <div class="add-form-container fade-in">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="fw-bold">Affecter un document a un vehicule</h2>
                <form action=""  method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Disposition en ligne pour Véhicule et Type -->
                    <div class="form-group side-by-side">
                        <div class="form-group full-width">
                            <label for="vehicle">Véhicule</label>
                            <select id="vehicle" name="vehicule_id" required>
                                <option value=""  selected>Choisir un véhicule</option>
                                 @foreach ($getVehicule as $item)
                                        <option value="{{$item->id}}">{{$item->marque}}-{{$item->immatriculation}}</option>
                                 @endforeach
                            </select>
                        </div>
                         <div class="form-group full-width">
                            <label >Type</label>
                            <select  name="document_vehicule" required>
                                <option value=""  selected>Choisir un document</option>
                                <option value="carte Grise"  >Carte Grise</option>
                                <option value="assurance automobile"  >Assurance automobile</option>
                                <option value="controle technique"  >Controle technique</option>
                                <option value="certificat conformite"  >Certificat de conformite</option>
                                <option value="certificat d'immatriculation"  >Certificat d'immatriculation</option>
                                <option value="certificat de visite"  >Certificat de visite</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group side-by-side">
                        <div class="form-group">
                            <label for="date">Date dernière mise a jour</label>
                            <input type="date" id="date" name="date_derniere_mise_ajour" value="{{ old('date_derniere_mise_ajour') }}" required>
                        </div>
                         <div class="form-group">
                            <label for="date">Date expiration</label>
                            <input type="date" id="date" name="date_expiration" value="{{ old('date_expiration') }}" >
                        </div>
                    </div>
                    
                    <div class="form-group side-by-side">
                        <div class="form-group">
                        <label for="photo">Scan pdf document</label>
                        <input type="file" id="photo" name="profile_pic"  aria-describedby="photoHelp" value="{{ old('profile_pic') }}">
                    </div>

                    <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" required name="statut" required aria-required="true">
                                <option value="">Sélectionnez</option>
                                <option value="1">Valide</option>
                                <option value="0">Expirer</option>
                            </select>
                    </div>
                    </div>
                 
                    <!-- Boutons avec classes Bootstrap -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</button>
                        {{-- <button type="button" class="btn btn-secondary" ><i class="fas fa-times"></i> Annuler</button> --}}
                    </div>
                </form>
            </div>
        </div>
     </div>
     
@endsection


