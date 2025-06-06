@extends('backend.layouts.app')
@section('content')
        
 <div class="add-form-container fade-in">
            <!-- Formulaire d'ajout d'un conducteur -->
            <div class="card">
                <h2 class="fw-bold">Editer une piece</h2>
                <form method="POST" action="" novalidate id="formulaire">
                    @csrf
                    <input type="hidden" name="intervention_id" id="intervention_id" value="">
                    <div class="modal-content">
                        
                        
                            <div class="form-group side-by-side">
                                <div class="form-group">
                                    <label for="piece_name" class="form-label">Nom de la pièce</label>
                                    <input type="text" name="nom" class="form-control" value="{{old('nom',$getRecords->nom)}}" id="piece_name" class="" required>
                                    <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">reference</label>
                                    <input type="text" name="reference" class="form-control" value="{{old('reference',$getRecords->reference)}}" id="" class="" required>
                                    <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                                </div>
                            </div>
                            <div class="form-group side-by-side">
                                    <div class="form-group">
                                        <label for="vehicule" class="form-label">Date installation</label>
                                        <input type="date" name="date_installation" value="{{old('date_installation',$getRecords->date_installation)}}" id="dateIntervention" class="form-control" required />
                                        <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dateIntervention" class="form-label">Date expiration</label>
                                        <input type="date" name="date_expiration" value="{{old('date_expiration',$getRecords->date_expiration)}}" id="dateIntervention" class="form-control" required />
                                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                                    </div>
                            </div> 
                            <div class="form-group side-by-side">
                                    <div class="form-group">
                                        <label for="vehicule" class="form-label">Coût unitaire</label>
                                        <input type="text" name="cout_unitaire" value="{{old('cout_unitaire',$getRecords->cout_unitaire)}}" id="dateIntervention" class="form-control" required />
                                        <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dateIntervention" class="form-label">quantite</label>
                                        <input type="number" name="quantite" value="{{old('quantite',$getRecords->quantite)}}" id="dateIntervention" class="form-control" required />
                                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                                    </div>
                            </div>  
                            <div class="form-group side-by-side">
                                    <div class="form-group">
                                        <label for="vehicule" class="form-label">kilometrage installation</label>
                                        <input type="number" name="kilometrage_installation" value="{{old('kilometrage_installation',$getRecords->kilometrage_installation)}}" id="dateIntervention" class="form-control" required />
                                        <div class="invalid-feedback">Veuillez sélectionner un véhicule.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dateIntervention" class="form-label">duree_vie</label>
                                        <input type="text" name="duree_vie" value="{{old('duree_vie',$getRecords->duree_vie)}}" id="dateIntervention" class="form-control" required />
                                        <div class="invalid-feedback">Veuillez saisir une date.</div>
                                    </div>
                            </div>   
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" class="form-control" name="description" value="{{old('description',$getRecords->description)}}" rows="3" placeholder="Description"></textarea>
                                </div>

                         <div class="form-group">
                            <label for="license_type">Statut <span class="required">*</span></label>
                            <select id="license_type" name="statut" class="form-select" required aria-required="true">
                                <option value="">Sélectionnez</option>
                                <option {{ ($getRecords->statut == 1) ? 'selected' : '' }} value="1">Valide</option>
                               <option {{ ($getRecords->statut == 0) ? 'selected' : '' }} value="0">Invalide</option>
                            </select>
                        </div>

                    <!-- Bouton de soumission -->
                    <div class="form-group">
                        <button type="submit" class="btn"><i class="fas fa-save"></i> Modifier</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>


@endsection                         

@section('scripts')

@endsection
