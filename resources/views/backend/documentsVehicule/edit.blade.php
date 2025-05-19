@extends('backend.layouts.app')
@section('content')
    <div class="add-form-container fade-in">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="fw-bold">Modifier un document </h2>
                <form action=""  method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Disposition en ligne pour Véhicule et Type -->
                    <div class="form-group side-by-side">
                        <div class="form-group full-width">
                            <label for="vehicle">Véhicule</label>
                            <select id="vehicle" name="vehicule_id" required>
                                <option value=""  selected>Choisir un véhicule</option>
                                @foreach ($getVehicule as $item)
                                        <option {{($getRecords->vehicule_id == $item->id) ? 'selected' : ''}} value="{{$item->id}}">{{$item->marque}}-{{$item->immatriculation}}</option>
                                 @endforeach
                            </select>
                        </div>
                         <div class="form-group full-width">
                            <label >Type</label>
                            <select  name="document_vehicule" required>
                                <option value=""  selected>Choisir un document</option>
                                <option {{ ($getRecords->type == "carte_Grise") ? 'selected' : '' }} value="carte_Grise" >Carte Grise</option>
                                <option {{ ($getRecords->type == "assurance") ? 'selected' : '' }} value="assurance">Assurance</option>
                                <option {{ ($getRecords->type == "controle_technique") ? 'selected' : '' }} value="controle_technique"  >Controle technique</option>
                                <option {{ ($getRecords->type == "certificat_conformite") ? 'selected' : '' }} value="certificat_conformite"  >Certificat de conformite</option>
                    
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group side-by-side">
                        <div class="form-group">
                            <label for="date">Date dernière mise a jour</label>
                            <input type="date" id="date" name="date_derniere_mise_ajour" value="{{ old('date_derniere_mise_ajour',$getRecords->date_expiration) }}" required>
                        </div>
                         <div class="form-group">
                            <label for="date">Date expiration</label>
                            <input type="date" id="date" name="date_expiration" value="{{ old('date_expiration',$getRecords->date_expiration) }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group side-by-side">
                        <div class="form-group">
                        <label for="photo">Scan pdf document</label>
                        <input type="file" id="photo" name="profile_pic"  aria-describedby="photoHelp" value="{{ old('profile_pic') }}">
                    </div>

                    <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" required aria-required="true">
                                <option value="">Sélectionnez</option>
                                <option {{ ($getRecords->statut == 1) ? 'selected' : '' }} value="1">Valide</option>
                               <option {{ ($getRecords->statut == 0) ? 'selected' : '' }} value="0">Expiré</option>
                            </select>
                    </div>
                    </div>
                 
                    <!-- Boutons avec classes Bootstrap -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Modifier</button>
                    </div>
                </form>
            </div>
        </div>
     </div>
     
@endsection


