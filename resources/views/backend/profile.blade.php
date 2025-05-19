@extends('backend.layouts.app')
@section('content')

  @include('_message')
    <!-- Formulaire de modification des infos -->
        <div class="center_profile_change_password" >
            <h2 data-i18n="edit_info_title">Modifier mes Informations</h2>
            <form method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label for="name" data-i18n="name">Nom</label>
                    <input type="text" id="name" name="nom" value="{{ old('name',$getRecord->nom) }}" required>
                </div>
                <div class="form-group">
                    <label for="email" data-i18n="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email',$getRecord->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="phone" data-i18n="phone">Téléphone</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone',$getRecord->telephone) }}">
                </div>
                <div class="form-group">
                    <label for="address" data-i18n="address">Adresse</label>
                    <input type="text" id="address" name="address" value="{{ old('address',$getRecord->address) }}">
                </div>
                <div class="form-group">
                    <label for="photo" data-i18n="photo">Photo de Profile</label>
                    <input type="file" id="photo" name="profile_pic" >
                   <div class="photo-preview">
                            <img id="photoPreview"  alt="">
                    </div>
                    @if (!empty($getRecord->getProfile()))
                     <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $getRecord->getProfile() }}" alt="">
                  @endif 
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" data-i18n="save">
                        <i class="fas fa-save"></i> Sauvegarder
                    </button>
                    <button type="button"  class="btn btn-secondary"   data-i18n="cancel">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                </div>
            </form>
        </div>
@endsection

