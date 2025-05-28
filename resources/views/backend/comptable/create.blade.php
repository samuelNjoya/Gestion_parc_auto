@extends('backend.layouts.app')
@section('content')
        
 <div class="add-form-container fade-in">
            <!-- Formulaire d'ajout d'un conducteur -->
            <div class="card">
                <h2 class="fw-bold">Ajouter un comptable</h2>
                <form action="" method="POST" enctype="multipart/form-data" id="formulaire">
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
                                placeholder="Entrez le prénom" value="{{ old('prenom') }}" required>
                        </div>
                    </div>
                    

                   

                    <!-- Champs Date de naissance et Numéro de permis (côte à côte) -->
                    <div class="form-group side-by-side">
                        <div>
                            <label for="birth_date">Date de naissance <span class="required">*</span></label>
                            <input type="date" id="birth_date" name="date_naiss"  aria-required="true" value="{{ old('date_naiss') }}" required>
                        </div>
                        <div>
                            <label for="license_number">mot de pass <span class="required">*</span></label>
                            <input type="password" id="license_number" name="motDePass" aria-required="true"
                                placeholder="*******" required>
                        </div>
                    </div>

                    <!-- Champs Type de permis et Date d'expiration (côte à côte) -->
                    <div class="form-group side-by-side">
                        <div>
                            <label for="license_type">Departement <span class="required">*</span></label>
                            <select id="license_type" name="departement" aria-required="true" value="{{ old('departement') }}">
                                <option value="">Sélectionnez</option>
                                <option value="departement1">departement1</option>
                                <option value="departement2">departement2</option>
                                <option value="departement3">departement3</option>
                            </select>
                        </div>
                        <div>
                            <label for="license_expiry">Address <span class="required">*</span></label>
                            <input type="text" id="license_expiry" name="address"  aria-required="true" value="{{ old('address') }}">
                        </div>
                    </div>

                
                    <div class="form-group side-by-side">  
                        <!-- Champ Email (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email"  aria-required="true"
                                placeholder="Entrez l'email" value="{{ old('email') }}" required>
                                 <div class="invalid-feedback">Veuillez saisir un email valide.</div>
                                 <div style="color: red">{{ $errors->first('email') }}</div>
                        </div>
                        
                            <!-- Champ Téléphone (pleine largeur) -->
                        <div class="form-group full-width">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" placeholder="Entrez le numéro de téléphone" value="{{ old('phone') }}">
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
                    </div>

                    <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" required required aria-required="true">
                                <option  value="">Sélectionnez</option>
                                <option value="1">actif</option>
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
               // Gestion de l’aperçu de la photo
    document.addEventListener('DOMContentLoaded', () => {
        const photoInput = document.getElementById('photo');
        const photoPreview = document.getElementById('photoPreview');

        if (photoInput && photoPreview) {
            photoInput.addEventListener('change', () => {
                const file = photoInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                   // photoPreview.src = 'https://via.placeholder.com/150'; // Placeholder si pas d’image
                }
            });
        } else {
            console.error('Photo input or preview element not found');
        }
    });
  </script>
@endsection
