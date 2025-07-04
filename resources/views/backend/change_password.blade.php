@extends('backend.layouts.app')
@section('content')

 @include('_message')
    <!-- Formulaire de changement de mot de passe -->
        <div class="center_profile_change_password" >
            <h2 data-i18n="change_password_title" class="fw-bold">Changer mon Mot de Passe</h2>
            <form method="POST">
                @csrf
                <div class="form-group">
                    <label for="password" data-i18n="new_password">Ancien Mot de Passe</label>
                    <input type="password"  name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="password" data-i18n="new_password">Nouveau Mot de Passe</label>
                    <input type="password"  name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="password-confirm" data-i18n="confirm_password">Confirmer le Mot de Passe</label>
                    <input type="password"  name="confirm_password" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" data-i18n="save">
                        <i class="fas fa-save"></i> Mettre a jour
                    </button>
                    
                </div>
            </form>
        </div>
@endsection

