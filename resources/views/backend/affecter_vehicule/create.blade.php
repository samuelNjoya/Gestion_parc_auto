@extends('backend.layouts.app')
@section('content')

 <div class="add-form-container fade-in">
        <div class="card mb-4">
            <div class="card-body">
                 <h2 class="fw-bold">Affecter un conducteur a un vehicule</h2>
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
                        <label for="">Conducteur</label>
                            <select id="" class="form-select" name="conducteur_id" required>
                                <option value=""  selected>Choisir un conducteur</option>
                                @foreach ($getConducteur as $item)
                                        <option value="{{$item->id}}">{{$item->nom}}-{{$item->prenom}}</option>
                                 @endforeach
                            </select>
                        <div class="invalid-feedback">Veuillez selectionner le nom du conducteur.</div>
                    </div>
                   
                </div>

                 <div class="form-group side-by-side">
                     <div class="form-group">
                        <label for="dateIntervention" class="form-label">Date de Debut</label>
                        <input type="date" name="date_debut" value="{{old('date_debut')}}"  class="form-control" required />
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                    </div>
                   <div class="form-group">
                        <label for="dateIntervention" class="form-label">Date de Fin</label>
                        <input type="date" name="date_fin" value="{{old('date_fin')}}"  class="form-control" required />
                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                    </div>
                </div>


                <!-- Description libre de l'intervention -->
                <div class="form-group">
                    <label for="description" class="form-label">Description </label>
                    <textarea id="description" class="form-control" name="description" value="{{old('description')}}" rows="2" placeholder="Description de l'intervention"></textarea>
                </div>

                <div class="form-group">
                     <label for="license_type">Statut <span class="required">*</span></label>
                     <select id="license_type" name="statut" class="form-select" required aria-required="true">
                        <option value="">Sélectionnez</option>
                        <option value="1">active</option>
                        <option value="0">inactive</option>
                    </select> 
                     <div class="invalid-feedback">Veuillez selectionner un statut.</div>      
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