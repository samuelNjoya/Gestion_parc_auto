@extends('backend.layouts.app')
@section('content')
    <!-- Formulaire de modification des infos -->
        <div class="center_profile_change_password" >
            <h2 data-i18n="edit_info_title">Modifier mes Informations</h2>
            <form id="profile-info-form">
                <div class="form-group">
                    <label for="name" data-i18n="name">Nom</label>
                    <input type="text" id="name" name="name" value="" required>
                </div>
                <div class="form-group">
                    <label for="email" data-i18n="email">Email</label>
                    <input type="email" id="email" name="email" value="" required>
                </div>
                <div class="form-group">
                    <label for="phone" data-i18n="phone">Téléphone</label>
                    <input type="tel" id="phone" name="phone" value="">
                </div>
                <div class="form-group">
                    <label for="birthdate" data-i18n="birthdate">Date de naissance</label>
                    <input type="date" id="birthdate" name="birthdate" value="">
                </div>
                <div class="form-group">
                    <label for="address" data-i18n="address">Adresse</label>
                    <input type="text" id="address" name="address" value="">
                </div>
                <div class="form-group">
                    <label for="photo" data-i18n="photo">Photo de Profil</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                    <img src="" class="photo-preview" id="photo-preview" alt="Aperçu de la photo">
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

