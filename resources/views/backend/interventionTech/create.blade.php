@extends('backend.layouts.app')
@section('content')

 <div class="add-form-container fade-in">
        <div class="card mb-4">
            <div class="card-body">
                 <h2 class="fw-bold">Ajouter un Entretien/Maintenance</h2>
                <form id="interventionForm" class="mt-4" novalidate method="POST">
                    @csrf
                <div class="form-group side-by-side">
                    <div class="form-group">
                        <label for="vehicule" class="form-label">Véhicule</label>
                        <select id="vehicule" class="form-select" name="vehicule_id" required>
                        <option value="" selected disabled>Choisir un véhicule</option>
                        @foreach ($getVehicule as $item)
                            <option value="{{$item->id}}">{{$item->marque}}-{{$item->immatriculation}}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                    </div>
                    <div class="form-group">
                        <label for="dateIntervention" class="form-label">Date de l'intervention</label>
                        <input type="date" name="date" value="{{old('date')}}" id="dateIntervention" class="form-control" required />
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                    </div>
                </div>

                 <div class="form-group side-by-side">
                    <div class="form-group">
                        <label  class="form-label">Titre</label>
                        <input type="text" name="titre" value="{{old('titre')}}"  class="form-control" min="0" required />
                        <div class="invalid-feedback">Veuillez saisir un titre.</div>
                    </div>
                    <div class="form-group">
                        <label for="">Coût</label>
                            <input type="text" name="cout" value="{{old('cout')}}" class="form-control" required>
                        <div class="invalid-feedback">Veuillez saisir un cout.</div>
                    </div>
                </div>

                <div class="form-group side-by-side">
                    <div class="form-group">
                        <label for="kilometrage" class="form-label">Kilométrage</label>
                        <input type="number" name="kilometrage" value="{{old('kilometrage')}}" id="kilometrage" class="form-control" min="0" required />
                        <div class="invalid-feedback">Veuillez saisir un kilométrage valide.</div>
                    </div>
                    <div class="form-group">
                        <label for="fournisseur">Prestataire</label>
                            <select id="fournisseur" class="form-select" name="fournisseur_id" required>
                                <option value=""  selected>Choisir un fournisseur</option>
                                @foreach ($getFournisseur as $item)
                                        <option value="{{$item->id}}">{{$item->nom}}-{{$item->prenom}}</option>
                                 @endforeach
                            </select>
                        <div class="invalid-feedback">Veuillez saisir le nom du technicien.</div>
                    </div>
                </div>

                <!-- Description libre de l'intervention -->
                <div class="form-group">
                    <label for="description" class="form-label">Description de l'intervention</label>
                    <textarea id="description" class="form-control" name="description" value="{{old('description')}}" rows="3" placeholder="Description de l'intervention"></textarea>
                </div>

                <!-- ========================= -->
                <!-- Choix du type d'intervention -->
                <!-- ========================= -->

                <div class="form-group">
                    <label for="typeIntervention" class="form-label">Type d'intervention</label>
                    <select id="typeIntervention" name="type" class="form-select" required>
                    <option value="" selected disabled>Choisir un type</option>
                    <option value="entretien">Entretien</option>
                    <option value="maintenance">Maintenance</option>
                    </select>
                    <div class="invalid-feedback">Veuillez choisir un type d'intervention.</div>
                </div>

                <!-- ========================= -->
                <!-- Champs spécifiques à l'entretien -->
                <!-- Ces champs sont cachés par défaut et affichés uniquement si "Entretien" est choisi -->
                <!-- ========================= -->

                <div id="entretienFields" class="d-none">
                    <div class="form-group side-by-side">
                        <!-- Prochaine date d'entretien (obligatoire si entretien) -->
                        <div class="">
                            <label for="prochaineDate" class="form-label">Prochaine date d'entretien</label>
                            <input type="date" id="prochaineDate" name="prochaine_date" value="{{old('prochaine_date')}}" class="form-control" />
                            <div class="invalid-feedback">Veuillez saisir la prochaine date d'entretien.</div>
                        </div>

                        <!-- Fréquence d'entretien (optionnel) -->
                        <div class="">
                            <label for="frequenceEntretien" class="form-label">Fréquence d'entretien (km ou mois)</label>
                            <input type="text" id="frequenceEntretien" name="frequence" value="{{old('frequence')}}" class="form-control" placeholder="Ex : 10000 km ou 12 mois" />
                        </div>
                    </div>
                </div>

                <!-- ========================= -->
                <!-- Champs spécifiques à la maintenance -->
                <!-- Ces champs sont cachés par défaut et affichés uniquement si "Maintenance" est choisi -->
                <!-- ========================= -->

                <div id="maintenanceFields" class="d-none">
                    <!-- Durée d'immobilisation (obligatoire si maintenance) -->
                    <div class="form-group">
                        <label for="dureeImmobilisation" class="form-label">Durée d'immobilisation (jours)</label>
                        <input type="number" id="dureeImmobilisation" name="duree" value="{{old('duree')}}" class="form-control" min="0" />
                        <div class="invalid-feedback">Veuillez saisir une durée d'immobilisation valide.</div>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</button>
                </form>
           </div>
        </div>
  </div>
     
@endsection


@section('scripts')
     <script>
    // Récupération des éléments du DOM nécessaires pour gérer l'affichage dynamique
    const typeInterventionSelect = document.getElementById('typeIntervention');
    const entretienFields = document.getElementById('entretienFields');
    const maintenanceFields = document.getElementById('maintenanceFields');

    // Champs spécifiques Entretien
    const prochaineDateInput = document.getElementById('prochaineDate');
    const frequenceEntretienInput = document.getElementById('frequenceEntretien');

    // Champs spécifiques Maintenance
    const dureeImmobilisationInput = document.getElementById('dureeImmobilisation');


    // Écouteur sur le changement du type d'intervention
    typeInterventionSelect.addEventListener('change', () => {
      const value = typeInterventionSelect.value;

      // 1. Cacher tous les blocs spécifiques au départ
      entretienFields.classList.add('d-none');
      maintenanceFields.classList.add('d-none');

      // 2. Réinitialiser les attributs 'required' des champs spécifiques (important pour la validation)
      prochaineDateInput.required = false;
      frequenceEntretienInput.required = false;

      dureeImmobilisationInput.required = false;
    

      // 3. Réinitialiser les valeurs des champs spécifiques pour éviter des données résiduelles non désirées
      prochaineDateInput.value = '';
      frequenceEntretienInput.value = '';

      dureeImmobilisationInput.value = '';
    

      // 4. Afficher et rendre obligatoire les champs spécifiques selon le choix
      if (value === 'entretien') {
        entretienFields.classList.remove('d-none');  // Affiche les champs Entretien
        prochaineDateInput.required = true;           // Rendre obligatoire la prochaine date d'entretien
      } else if (value === 'maintenance') {
        maintenanceFields.classList.remove('d-none'); // Affiche les champs Maintenance
        dureeImmobilisationInput.required = true;     // Rendre obligatoire la durée d'immobilisation
      }
    });

    // Validation personnalisée avec Bootstrap
    (() => {
      'use strict'
      const form = document.getElementById('interventionForm');

      // Écouteur sur la soumission du formulaire
      form.addEventListener('submit', event => {
        // La méthode checkValidity() vérifie si tous les champs requis sont valides
        if (!form.checkValidity()) {
          // Si un champ requis est invalide, on empêche la soumission du formulaire
          event.preventDefault()
          event.stopPropagation()
        }
        // Ajout de la classe Bootstrap 'was-validated' pour afficher les messages d'erreur
        form.classList.add('was-validated')
      }, false)
    })()
  </script>
@endsection