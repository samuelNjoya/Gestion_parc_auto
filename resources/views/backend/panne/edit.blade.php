@extends('backend.layouts.app')
@section('content')

<div class="add-form-container fade-in">
           
     <div class="card">
            <h2 class="fw-bold">Editer une panne</h2>
        <form method="POST" action="" novalidate id="formulaire" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="affectation_id" id="affectation_id" value="">
                <div class="modal-body">
                    <div class="form-group ">
                        <div class="form-group">
                            <label for="piece_name" class="form-label">Type</label>
                            <input type="text" name="type" class="form-control" value="{{old('type',$getRecords->type)}}"  class="" required>
                            <div class="invalid-feedback">Veuillez Entrer le type(moteur...).</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Localisation</label>
                            <input type="text" name="localisation" class="form-control" value="{{old('localisation',$getRecords->localisation)}}" id="" class="" required>
                            <div class="invalid-feedback">Veuillez entrer la localisation.</div>
                        </div>
                    </div>
                
                    <div class="form-group side-by-side">
                            <div class="form-group">
                                <label for="vehicule" class="form-label">kilometrage </label>
                                <input type="number" name="kilometrage_panne" value="{{old('kilometrage_panne',$getRecords->kilometrage_panne)}}" id="dateIntervention" class="form-control" required />
                                <div class="invalid-feedback">Veuillez saisir le kilometrage.</div>
                            </div>
                            <div class="form-group">
                                <label for="vehicule" class="form-label">Date panne</label>
                                <input type="date" name="date_panne" value="{{old('date_panne',$getRecords->date_panne)}}"  class="form-control" required />
                                <div class="invalid-feedback">Veuillez saisir une date.</div>
                            </div>
                    </div>   
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" class="form-control" name="description" value="{{old('description',$getRecords->description)}}" rows="3" placeholder="Description"></textarea>
                        </div>

                        <div class="form-group full-width">
                                    <label for="photo">Photo</label>
                                    <input type="file" id="photo" name="profile_pic" accept="image/*" aria-describedby="photoHelp" value="{{ old('profile_pic') }}">
                                    <!-- <small id="photoHelp" class="form-text">Choisissez une image (JPEG, PNG).</small> -->
                                    <div class="photo-preview">
                                        <img id="photoPreview"  alt="">
                                    </div>
                                    @if (!empty($getRecords->getPhotoPanne()))
                                    <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $getRecords->getPhotoPanne() }}" alt="">
                                    @endif 
                                </div>

                        <div class="form-group">
                                    <label for="license_type">Statut <span class="required">*</span></label>
                                    <select id="license_type" name="statut" class="form-control" required aria-required="true">
                                        <option value="">Sélectionnez</option>
                                        <option {{ ($getRecords->statut == 1) ? 'selected' : '' }} value="1">En attente</option>
                                        <option {{ ($getRecords->statut == 0) ? 'selected' : '' }} value="0">Résolu</option>
                                    </select>
                                <div class="invalid-feedback">Veuillez saisir le statut.</div>
                        </div>

               
                
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button> --}}
                
            </div>
        </form>
    </div>
</div>

@endsection