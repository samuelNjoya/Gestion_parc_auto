@extends('backend.layouts.app')
@section('content')
        
 <div class="add-form-container fade-in">
           
            <div class="card">
                <h2 class="fw-bold">Editer un vehicule</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group side-by-side">
                          
                        <div class="form-group full-width">
                            <label for="last_name">immatriculation <span class="required">*</span></label>
                            <input type="text" id="last_name" name="immatriculation"  aria-required="true"
                                placeholder="Entrez l'immatriculation" value="{{ old('immatriculation',$getRecords->immatriculation) }}">
                                <div style="color: red">{{ $errors->first('immatriculation') }}</div>
                        </div>
                           
                        <div class="form-group full-width">
                            <label for="first_name">marque <span class="required">*</span></label>
                            <input type="text" id="first_name" name="marque"  aria-required="true"
                                placeholder="Entrez la marque" value="{{ old('marque',$getRecords->marque) }}">
                        </div>
                    </div>
                    

                   

                  
                    <div class="form-group side-by-side">
                        <div>
                            <label for="license_number">modèle <span class="required">*</span></label>
                            <input type="text" id="license_number" name="modele" aria-required="true"
                                placeholder="Entrez le modèle" value="{{ old('modele',$getRecords->modele) }}">
                        </div>
                        <div>
                            <label for="birth_date">Date d'achat <span class="required">*</span></label>
                            <input type="date" id="birth_date" name="date_buy"  aria-required="true" value="{{ old('date_buy',$getRecords->date_achat) }}">
                        </div>
                        
                    </div>

                 
                    <div class="form-group side-by-side">
                        <div>
                            <label for="license_type">Type caburant<span class="required">*</span></label>
                            <select id="license_type" name="type_caburant" aria-required="true" value="{{ old('type_caburant') }}">
                                <option value="">Sélectionnez</option>
                                <option {{ ($getRecords->type_carburant == "essence") ? 'selected' : '' }} value="essence">essence</option>
                                <option {{ ($getRecords->type_carburant == "diesel") ? 'selected' : '' }} value="diesel">diesel</option>
                                <option {{ ($getRecords->type_carburant == "electrique") ? 'selected' : '' }} value="electrique">electrique</option>
                                <option {{ ($getRecords->type_carburant == "hybride") ? 'selected' : '' }} value="hybride">hybride</option>
                                <option {{ ($getRecords->type_carburant == "super") ? 'selected' : '' }} value="super">super</option>
                                <option {{ ($getRecords->type_carburant == "gasoil") ? 'selected' : '' }} value="gasoil">gasoil</option>
                            </select>
                        </div>
                     
                        <div>
                            <label for="license_expiry">kilometrage <span class="required">*</span></label>
                            <input type="number" id="license_expiry" name="kilometrage"  aria-required="true" value="{{ old('kilometrage',$getRecords->kilometrage) }}">
                        </div>
                    </div>

                
                    <div class="form-group side-by-side">  
                        
                        <div class="form-group full-width">
                            <label for="photo">Photo</label>
                            <input type="file" id="photo" name="profile_pic" accept="image/*" aria-describedby="photoHelp" value="{{ old('profile_pic') }}">
                            <!-- <small id="photoHelp" class="form-text">Choisissez une image (JPEG, PNG).</small> -->
                            <div class="photo-preview">
                                <img id="photoPreview"  alt="">
                            </div>
                           @if (!empty($getRecords->getPhotoVoiture()))
                             <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $getRecords->getPhotoVoiture() }}" alt="">
                          @endif 
                        </div>
                           <div>
                            <label for="license_type">Departement <span class="required">*</span></label>
                            <select id="license_type" name="departement" aria-required="true" value="{{ old('departement') }}">
                                <option value="">Sélectionnez</option>
                                <option {{ ($getRecords->departement == "technique") ? 'selected' : '' }} value="technique">technique</option>
                                <option {{ ($getRecords->departement == "financier") ? 'selected' : '' }} value="financier">financier</option>
                                <option {{ ($getRecords->departement == "commercial") ? 'selected' : '' }} value="commercial">commercial</option>
                            </select>
                        </div>
                         
                    </div>


               
                    <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" required aria-required="true">
                                <option value="">Sélectionnez</option>
                                <option {{ ($getRecords->statut == 1) ? 'selected' : '' }} value="1">active</option>
                               <option {{ ($getRecords->statut == 0) ? 'selected' : '' }} value="0">inactive</option>
                            </select>
                        </div>

                    <!-- Bouton de soumission -->
                    <div class="form-group">
                        <button type="submit" class="btn"><i class="fas fa-save"></i> Modifier</button>
                    </div>
                </form>
            </div>
        </div>


@endsection                         

@section('scripts')
  <script>
  
  </script>
@endsection
