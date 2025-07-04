<div class="sidebar" id="sidebar">

        {{-- <img src="{{asset('images/imgSam.jpg')}}" alt="Photo de profil" class="profile-pic"> --}}
        <img src="{{ Auth::user()->getProfileLive() }}" alt="{{ Auth::user()->name }}" class="profile-pic"/>
        <div class="info-img">
            <span class="name-s">{{ Auth::user()->nom }}</span>
            <span class="email-s d-block mb-1">{{ Auth::user()->email }}</span>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}" href="{{url('panel/dashboard')}}"><i class="fas fa-tachometer-alt me-2"></i> Tableau de
                    Bord</a>

            </li>
            <!-- Ajout du dropdown Utilisateur -->
            @if (Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-users me-2"></i> Utilisateur
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{url('panel/comptable')}}"><i class="fas fa-calculator me-2"></i> Comptable</a></li>
                    <li><a class="dropdown-item" href="{{url('panel/conducteur')}}"><i class="fas fa-user-shield me-2"></i> Conducteur</a></li>
                    <li class="{{ (Request::segment(2) == 'gestionnaire') ? 'active' : '' }}">
                        <a class="dropdown-item"  href="{{url('panel/gestionnaire')}}"><i class="fas fa-user-shield me-2"></i> Gestionnaire</a>
                    </li>
                    <li><a class="dropdown-item" href="{{url('panel/fournisseur')}}"><i class="fas fa-user-shield me-2"></i> PrestataireExterne</a>
                    </li>

                </ul>
            </li>
            @endif

            @if (Auth::user()->role == 1 || Auth::user()->role == 2 )
            <li class="nav-item " >
                <a class="nav-link {{ (Request::segment(2) == 'vehicule') ? 'active' : '' }}" href="{{url('panel/vehicule')}}"><i class="fas fa-car me-2"></i> Véhicules</a>
            </li>
           

            {{-- <li class="nav-item">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-wrench me-2"></i> Maintenance
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="/"><i class="fas fa-clipboard-list me-2"></i> Etablir
                            Maintenance</a></li>
                <li><a class="dropdown-item" href="/assignment-history"><i class="fas fa-history me-2"></i>
                        Historique</a></li>  
            </li> --}}
        {{-- </ul> --}}
          @endif
          @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3)
            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(2) == 'conso_carburant') ? 'active' : '' }}" href="{{url('panel/conso_carburant')}}"><i class="fas fa-gas-pump me-2"></i>
                    Carburant</a>

            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(2) == 'intervention_tech') ? 'active' : '' }}" href="{{url('panel/intervention_tech')}}"><i class="fas fa-clipboard-list me-2"></i>
                    Maintenance/Entretien</a>

            </li>
        @endif

        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
        <li class="nav-item">
            <a class="nav-link dropdown-toggle" href="#" id="assignmentDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user-check me-2"></i> Attribution
            </a>
            <ul class="dropdown-menu" aria-labelledby="assignmentDropdown">
                <li><a class="dropdown-item" href="{{url('panel/affecter_vehicule')}}"><i class="fas fa-car me-2"></i> Attribuer voiture</a>
                </li>
                <li><a class="dropdown-item" href="{{url('panel/documentsVehicule')}}"><i class="fas fa-clipboard-list me-2"></i> Attribuer Document</a>
                </li>
                {{-- <li><a class="dropdown-item" href="#"><i class="fas fa-history me-2"></i>
                        Historique</a></li> --}}
            </ul>
        </li>
        @endif
        <!-- Fin du dropdown Attribution -->
        @if (Auth::user()->role == 1 || Auth::user()->role == 3)
            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(2) == 'historique_cout') ? 'active' : '' }}" href={{url('panel/historique_cout')}}><i class="fas fa-history me-2"></i> Historique des coûts</a>
            </li>
        @endif

         @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4)
            <li class="nav-item">
                <a class="nav-link {{ (Request::segment(2) == 'panne') ? 'active' : '' }}" href={{url('panel/panne')}}><i class="fas fa-history me-2"></i> Panne</a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link {{ (Request::segment(2) == 'mon_compte') ? 'active' : '' }}" href={{url('panel/mon_compte')}}><i class="fas fa-user me-2"></i> Profil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::segment(2) == 'changer_password') ? 'active' : '' }}" href="{{url('panel/changer_password')}}"><i class="fas fa-key me-2"></i> Changé mot de pass</a>
        </li>
         <li class="nav-item">
            <a class="nav-link {{ (Request::segment(2) == 'aide') ? 'active' : '' }}" href="{{url('panel/aide')}}"><i class="fas fa-question-circle me-2"></i> Aide</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('logout')}}"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a>
        </li>
        </ul>
    </div>

       <!-- Hamburger menu pour mobile -->
    <!-- Correction pour visibilité et fonctionnalité -->
    <div class="hamburger" id="hamburger" aria-controls="sidebar" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </div>