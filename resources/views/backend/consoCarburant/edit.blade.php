@extends('backend.layouts.app')
@section('content')
    <div class="add-form-container fade-in">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="fw-bold">Editer un Ravitaillement</h2>
                <form action=""  method="POST">
                    @csrf
                    <!-- Disposition en ligne pour Véhicule et Type -->
                    <div class="form-group side-by-side">
                        <div class="form-group full-width">
                            <label for="vehicle">Véhicule</label>
                            <select id="vehicle" name="vehicule_id" required>
                                <option value=""  selected>Choisir un véhicule</option>
                                 @foreach ($getVehicule as $item)
                                        <option {{($getRecords->vehicule_id == $item->id) ? 'selected' : ''}} value="{{$item->id}}">{{$item->marque}}-{{$item->immatriculation}}</option>
                                 @endforeach
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="mileage">Kilométrage plein (km)</label>
                            <input type="number" id="mileage" name="kilometrage_plein" value="{{ old('kilometrage_plein',$getRecords->kilometrage_plein) }}" min="0" required>
                        </div>
                    </div>
                    <!-- Disposition en ligne pour Date et Quantité -->
                    <div class="form-group side-by-side">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date_conso" value="{{ old('date_conso',$getRecords->date_conso) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantité (L)</label>
                            <input type="number" id="quantity" name="quantite_conso" value="{{ old('quantite_conso',$getRecords->quantite_conso) }}" step="0.01" min="0" required>
                        </div>
                    </div>
                    <!-- Disposition en ligne pour Coût et Kilométrage -->
                    <div class="form-group side-by-side">
                        <div class="form-group">
                            <label for="cost">Coût (FCFA)</label>
                            <input type="number" id="cost" name="cout_conso" value="{{ old('cout_conso',$getRecords->cout_conso) }}" step="0.01" min="0" required>
                        </div>
                        <div class="form-group full-width">
                            <label for="fournisseur">Fournisseur</label>
                            <select id="fournisseur" name="fournisseur_id" required>
                                <option value=""  selected>Choisir un fournisseur</option>
                                @foreach ($getFournisseur as $item)
                                        <option {{($getRecords->fournisseur_id == $item->id) ? 'selected' : ''}} value="{{$item->id}}">{{$item->nom}}-{{$item->prenom}}</option>
                                 @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Notes en pleine largeur -->
                    <div class="form-group full-width">
                        <label for="notes">Notes</label>
                        <textarea id="notes" name="note" value="{{ old('note',$getRecords->note) }}" placeholder="Détails supplémentaires (optionnel)"></textarea>
                    </div>
                    <!-- Boutons avec classes Bootstrap -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Modifier</button>
                        <button type="button" class="btn btn-secondary" ><i class="fas fa-times"></i> Annuler</button>
                    </div>
                </form>
            </div>
        </div>
     </div>
     
@endsection


