@extends('backend.layouts.app')
@section('content')
        
 <div class="add-form-container fade-in">
           
            <div class="card">
                <h2 class="fw-bold">Ajouter un vehicule</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group side-by-side">
                          
                        <div class="form-group full-width">
                            <label for="last_name">immatriculation <span class="required">*</span></label>
                            <input type="text" id="last_name" name="immatriculation"  aria-required="true"
                                placeholder="Entrez l'immatriculation" value="{{ old('immatriculation') }}" required>
                                <div style="color: red">{{ $errors->first('immatriculation') }}</div>
                        </div>
                           
                        <div class="form-group full-width">
                            <label for="first_name">marque <span class="required">*</span></label>
                            <input type="text" id="first_name" name="marque"  aria-required="true"
                                placeholder="Entrez la marque" value="{{ old('marque') }}" required>
                        </div>
                    </div>
                    

                   

                  
                    <div class="form-group side-by-side">
                        <div>
                            <label for="license_number">modèle <span class="required">*</span></label>
                            <input type="text" id="license_number" name="modele" aria-required="true"
                                placeholder="Entrez le modèle" value="{{ old('modele') }}" required>
                        </div>
                        <div>
                            <label for="birth_date">Date d'achat <span class="required">*</span></label>
                            <input type="date" id="birth_date" name="date_buy"  aria-required="true" value="{{ old('date_buy') }}" required>
                        </div>
                        
                    </div>

                 
                    <div class="form-group side-by-side">
                        <div>
                            <label for="license_type">Type caburant<span class="required">*</span></label>
                            <select id="license_type" name="type_caburant" aria-required="true" value="{{ old('type_caburant') }}" required>
                                <option value="">Sélectionnez</option>
                                <option value="essence">essence</option>
                                <option value="diesel">diesel</option>
                                <option value="electrique">electrique</option>
                                <option value="hybride">hybride</option>
                                <option value="super">super</option>
                                <option value="gasoil">gasoil</option>
                            </select>
                        </div>
                     
                        <div>
                            <label for="license_expiry">kilometrage <span class="required">*</span></label>
                            <input type="number" id="license_expiry" name="kilometrage"  aria-required="true" value="{{ old('kilometrage') }}" required>
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
                        </div>
                           <div>
                            <label for="license_type">Departement <span class="required">*</span></label>
                            <select id="license_type" name="departement" aria-required="true" value="{{ old('departement') }}">
                                <option value="">Sélectionnez</option>
                                <option value="technique">technique</option>
                                <option value="financier">financier</option>
                                <option value="commercial">commercial</option>
                            </select>
                        </div>
                         
                    </div>


               
                    <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" required aria-required="true" required>
                                <option value="">Sélectionnez</option>
                                <option value="1">En service</option>
                                <option value="0">inactif</option>
                            </select>
                        </div>

                    <!-- Bouton de soumission -->
                    <div class="form-group">
                        <button type="submit" class="btn"><i class="fas fa-save"></i> Ajouter</button>
                    </div>
                </form>
            </div>
        </div>


@endsection                         

@section('scripts')
  <script>
  
  </script>
@endsection
