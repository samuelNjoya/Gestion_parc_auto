@extends('backend.layouts.app')
@section('content')
        
 <div class="add-form-container fade-in">
            <!-- Formulaire d'ajout d'un conducteur -->
            <div class="card">
                <h2 class="fw-bold">Ajouter un conducteur</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group side-by-side">
                            <!-- Champ Nom (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="last_name">Nom <span class="required">*</span></label>
                            <input type="text" id="last_name" name="nom"  aria-required="true"
                                placeholder="Entrez le nom" value="{{ old('nom') }}" required>
                        </div>
                            <!-- Champ Prénom (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="first_name">Prénom <span class="required">*</span></label>
                            <input type="text" id="first_name" name="prenom"  aria-required="true"
                                placeholder="Entrez le prénom" value="{{ old('prenom') }}">
                        </div>
                    </div>
                    

                   

                    <!-- Champs Date de naissance et Numéro de permis (côte à côte) -->
                    <div class="form-group side-by-side">
                        <div>
                            <label for="birth_date">Date de naissance <span class="required">*</span></label>
                            <input type="date" id="birth_date" name="date_naiss" required aria-required="true" value="{{ old('date_naiss') }}">
                        </div>
                        <div>
                            <label for="license_number">mot de pass <span class="required">*</span></label>
                            <input type="password" id="license_number" name="motDePass" aria-required="true"
                                placeholder="*******">
                        </div>
                    </div>

                
                    <div class="form-group side-by-side">  
                        <!-- Champ Email (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email"  aria-required="true"
                                placeholder="Entrez l'email" value="{{ old('email') }}">
                                 <div style="color: red">{{ $errors->first('email') }}</div>
                        </div>
                        
                            <!-- Champ Téléphone (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Entrez le numéro de téléphone" value="{{ old('phone') }}">
                        </div>
                    </div>


                     <div class="form-group side-by-side">
                         <div>
                            <label for="license_expiry">Numero permis <span class="required">*</span></label>
                            <input type="text" id="license_expiry" name="numero_permis" placeholder="Entrer une numero de permis" required  aria-required="true" value="{{ old('numero_permis') }}">
                        </div>
                        <div>
                            <label for="license_type">type_permis <span class="required">*</span></label>
                            <select id="license_type" name="type_permis" required aria-required="true" value="{{ old('type_permis') }}">
                                <option value="">Sélectionnez</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                       
                    </div>

                    <div class="form-group side-by-side">
                        <div>
                            <label for="birth_date">Date  expiration permis <span class="required">*</span></label>
                            <input type="date" id="birth_date" name="date_expiration_permis"  aria-required="true" value="{{ old('date_expiration_permis') }}" required>
                        </div>
                        <div>
                            <label for="license_expiry">Address <span class="required">*</span></label>
                            <input type="text" id="license_expiry" name="address" placeholder="Entrer une address"  aria-required="true" value="{{ old('address') }}">
                        </div>
                    </div>
                   
                  
                <div class="form-group side-by-side">
                        <div class="">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="profile_pic" accept="image/*" aria-describedby="photoHelp" value="{{ old('profile_pic') }}">
                        <!-- <small id="photoHelp" class="form-text">Choisissez une image (JPEG, PNG).</small> -->
                        <div class="photo-preview">
                            <img id="photoPreview"  alt="">
                        </div>
                    </div>

                    <div class="">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" required aria-required="true">
                                <option value="">Sélectionnez</option>
                                <option value="1">actif</option>
                                <option value="0">inactif</option>
                            </select>
                        </div>
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
