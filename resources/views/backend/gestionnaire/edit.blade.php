@extends('backend.layouts.app')
@section('content')
        
 <div class="add-form-container fade-in">
            <!-- Formulaire d'ajout d'un conducteur -->
            <div class="card">
                <h2>Editer un gestionnaire</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group side-by-side">
                            <!-- Champ Nom (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="last_name">Nom <span class="required">*</span></label>
                            <input type="text" id="last_name" name="nom"  aria-required="true"
                                placeholder="Entrez le nom" value="{{ old('nom',$getRecords->nom) }}">
                        </div>
                            <!-- Champ Prénom (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="first_name">Prénom <span class="required">*</span></label>
                            <input type="text" id="first_name" name="prenom"  aria-required="true"
                                placeholder="Entrez le prénom" value="{{ old('prenom',$getRecords->prenom) }}">
                        </div>
                    </div>
                    

                   

                    <!-- Champs Date de naissance et Numéro de permis (côte à côte) -->
                    <div class="form-group side-by-side">
                        <div>
                            <label for="birth_date">Date de naissance <span class="required">*</span></label>
                            <input type="date" id="birth_date" name="date_naiss"  aria-required="true" value="{{ old('date_naiss',$getRecords->date_naiss) }}">
                        </div>
                        <div>
                            <label for="license_number">mot de pass <span class="required">*</span></label>
                            <input type="text" id="license_number" name="motDePass" aria-required="true"
                                placeholder=""> (voulez vous changé ce mot de passe ?)
                        </div>
                    </div>

                    <!-- Champs Type de permis et Date d'expiration (côte à côte) -->
                    <div class="form-group ">
                       
                        <div>
                            <label for="license_expiry">Address <span class="required">*</span></label>
                            <input type="text" id="license_expiry" name="address"  aria-required="true" value="{{ old('address',$getRecords->address) }}">
                        </div>
                    </div>

                
                    <div class="form-group side-by-side">  
                        <!-- Champ Email (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email"  aria-required="true"
                                placeholder="Entrez l'email" value="{{ old('email',$getRecords->email) }}">
                                 <div style="color: red">{{ $errors->first('email') }}</div>
                        </div>
                        
                            <!-- Champ Téléphone (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" placeholder="Entrez le numéro de téléphone" value="{{ old('phone',$getRecords->telephone) }}">
                        </div>
                    </div>


                   
                    <!-- Champ Photo avec aperçu -->
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="profile_pic" accept="image/*" aria-describedby="photoHelp" value="{{ old('profile_pic') }}">
                        <!-- <small id="photoHelp" class="form-text">Choisissez une image (JPEG, PNG).</small> -->
                        <div class="photo-preview">
                            <img id="photoPreview"  alt="">
                        </div>
                          @if (!empty($getRecords->getProfile()))
                             <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $getRecords->getProfile() }}" alt="">
                          @endif 
                    </div>

                    <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" required aria-required="true">
                               <option {{ ($getRecords->statut == 1) ? 'selected' : '' }} value="1">active</option>
                               <option {{ ($getRecords->statut == 0) ? 'selected' : '' }} value="0">inactive</option>
                            </select>
                        </div>

                    <!-- Bouton de soumission -->
                    <div class="form-group">
                        <button type="submit" class="btn"><i class="fas fa-save"></i> Mettre a jour</button>
                    </div>
                </form>
            </div>
        </div>


@endsection                         

@section('scripts')
  <script>
    
  </script>
@endsection
