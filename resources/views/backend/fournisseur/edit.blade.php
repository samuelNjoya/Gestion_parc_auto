@extends('backend.layouts.app')
@section('content')
        
 <div class="add-form-container fade-in">
            <!-- Formulaire d'ajout d'un conducteur -->
            <div class="card">
                <h2 class="fw-bold">Editer un fournisseur</h2>
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
                            <label for="first_name">Type <span class="required">*</span></label>
                            <input type="text" id="first_name" name="prenom"  aria-required="true"
                                placeholder="Entrez le prénom" value="{{ old('prenom',$getRecords->prenom) }}">
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

                  <div class="form-group">
                        <div>
                            <label for="license_expiry">Address <span class="required">*</span></label>
                            <input type="text" id="license_expiry" name="address"  aria-required="true" value="{{ old('address',$getRecords->address) }}">
                        </div>
                    </div>


                    <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" required aria-required="true">
                               <option {{ ($getRecords->statut == 1) ? 'selected' : '' }} value="1">actif</option>
                               <option {{ ($getRecords->statut == 0) ? 'selected' : '' }} value="0">inactif</option>
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
                  
                }
            });
        } else {
            console.error('Photo input or preview element not found');
        }
    });
  </script>
@endsection
