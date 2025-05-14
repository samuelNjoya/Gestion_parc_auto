@extends('backend.layouts.app')
@section('content')
        
 <div class="add-form-container fade-in">
            <!-- Formulaire d'ajout d'un conducteur -->
            <div class="card">
                <h2>Ajouter un Conducteur</h2>
                <form action="/drivers/store" method="POST">
                    <!-- Champ Nom (pleine largeur) -->
                    <div class="form-group full-width">
                        <label for="last_name">Nom <span class="required">*</span></label>
                        <input type="text" id="last_name" name="last_name" required aria-required="true"
                            placeholder="Entrez le nom">
                    </div>

                    <!-- Champ Prénom (pleine largeur) -->
                    <div class="form-group full-width">
                        <label for="first_name">Prénom <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" required aria-required="true"
                            placeholder="Entrez le prénom">
                    </div>

                    <!-- Champs Date de naissance et Numéro de permis (côte à côte) -->
                    <div class="form-group side-by-side">
                        <div>
                            <label for="birth_date">Date de naissance <span class="required">*</span></label>
                            <input type="date" id="birth_date" name="birth_date" required aria-required="true">
                        </div>
                        <div>
                            <label for="license_number">Numéro de permis <span class="required">*</span></label>
                            <input type="text" id="license_number" name="license_number" required aria-required="true"
                                placeholder="Entrez le numéro">
                        </div>
                    </div>

                    <!-- Champs Type de permis et Date d'expiration (côte à côte) -->
                    <div class="form-group side-by-side">
                        <div>
                            <label for="license_type">Type de permis <span class="required">*</span></label>
                            <select id="license_type" name="license_type" required aria-required="true">
                                <option value="">Sélectionnez</option>
                                <option value="B">B (Voiture)</option>
                                <option value="C">C (Camion)</option>
                                <option value="D">D (Bus)</option>
                            </select>
                        </div>
                        <div>
                            <label for="license_expiry">Date d'expiration <span class="required">*</span></label>
                            <input type="date" id="license_expiry" name="license_expiry" required aria-required="true">
                        </div>
                    </div>

                    <!-- Champ Email (pleine largeur) -->
                    <div class="form-group full-width">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required aria-required="true"
                            placeholder="Entrez l'email">
                    </div>

                    <!-- Champ Téléphone (pleine largeur) -->
                    <div class="form-group full-width">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Entrez le numéro de téléphone">
                    </div>
                    <!-- Champ Photo avec aperçu -->
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="photo" accept="image/*" aria-describedby="photoHelp">
                        <!-- <small id="photoHelp" class="form-text">Choisissez une image (JPEG, PNG).</small> -->
                        <div class="photo-preview">
                            <img id="photoPreview" src="https://via.placeholder.com/150" alt="">
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="form-group">
                        <button type="submit" class="btn"><i class="fas fa-save"></i> Ajouter Conducteur</button>
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
                    photoPreview.src = 'https://via.placeholder.com/150'; // Placeholder si pas d’image
                }
            });
        } else {
            console.error('Photo input or preview element not found');
        }
    });
  </script>
@endsection
