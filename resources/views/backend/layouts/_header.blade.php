 <header class="header">
        <h4 class="text-center mx-3 fw-bold" style="color: var(--primary-color);">Parc Automobile</h4>
        <div class="d-flex align-items-center">
            <!-- Ajout du bouton de bascule clair/sombre -->
            <button class="theme-toggle" id="themeToggle" aria-label="Basculer le thème">
                <i class="fas fa-sun"></i>
            </button>
            <div class="user-info mx-2">
                <span>Bonjour <strong>Jean Dupont</strong></span>
            </div>
            <div class="dropdown">
                <img src="{{asset('images/imgSam.jpg')}}" alt="Photo de profil" class="profile-pic" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i> Voir Profil</a></li>
                    <li><a class="dropdown-item" href="/edit-profile"><i class="fas fa-edit me-2"></i> Modifier
                            Profil</a></li>
                    <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>