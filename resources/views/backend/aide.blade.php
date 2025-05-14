@extends('backend.layouts.app')
@section('content')
    <!-- Conteneur principal -->
    <div class="help-container">
        <h1>Aide et Support</h1>

        <!-- Section FAQ -->
        <div class="faq-section">
            <h2>Foire Aux Questions (FAQ)</h2>
            <div class="faq-item">
                <div class="faq-question">
                    Comment me connecter à la plateforme ?
                    <i class="fas fa-plus"></i>
                </div>
                <div class="faq-answer">
                    Utilisez votre email et mot de passe fournis par l’administrateur. Cliquez sur "Se connecter" sur la page de connexion. Si vous rencontrez des problèmes, utilisez le lien "Mot de passe oublié ?".
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    Comment ajouter un nouvel vehicule ?
                    <i class="fas fa-plus"></i>
                </div>
                <div class="faq-answer">
                    Pour ajouter un véhicule, accédez à la page "Ajouter un véhicule" depuis le tableau de bord, remplissez les champs (marque, modèle, immatriculation, etc.), puis cliquez sur "Ajouter". 
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                   Ou trouver l'historique d'un vehicule
                    <i class="fas fa-plus"></i>
                </div>
                <div class="faq-answer">
                    Dans la page "Véhicules", cliquez sur un véhicule pour voir son historique (entretiens, réparations, kilométrage). 
                </div>
            </div>
             <div class="faq-item">
                <div class="faq-question">
                  Comment planifier une maintenance ?
                    <i class="fas fa-plus"></i>
                </div>
                <div class="faq-answer">
                     Allez dans la section "Maintenance", sélectionnez le véhicule, choisissez une date et un type d’entretien (ex. vidange), puis validez. 
            </div>
        </div>

       
       

        <!-- Guides utilisateur -->
        <div class="guides-section">
            <h2>Guides Utilisateur</h2>
            <div class="guide-item">
                <i class="fas fa-file-pdf"></i>
                <a href="#">Guide pour la Gestion des Inventaires</a>
            </div>
            <div class="guide-item">
                <i class="fas fa-file-pdf"></i>
                <a href="#">Documentation</a>
            </div>
            <div class="guide-item">
                <i class="fas fa-file-pdf"></i>
                <a href="#">Guide pour l’Attribution des Vehicules</a>
            </div>
        </div>

        <!-- Informations de contact -->
        <div class="contact-info">
            <h2>Informations de Contact</h2>
            <p><i class="fas fa-envelope"></i> <a href="mailto:support@metalsecure.fr">support@metalsecure.fr</a></p>
            <p><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
        </div>
    </div>
@endsection

@section('styles')
<style>
   
        /* Conteneur principal */
        .help-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 30px;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 2rem;
            color: var(--primary-color);
            text-align: center;
            font-weight: bold
        }


        /* Section FAQ */
        .faq-section {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .faq-section h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .faq-item {
            border-bottom: 1px solid var(--text-color);
            padding: 10px 0;
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-size: 1.1rem;
            color: var(--text-color);
            transition: color 0.2s ease;
        }

        .faq-question:hover {
            color: var(--accent-color);
        }

        .faq-question i {
            transition: transform 0.3s ease;
        }

        .faq-question.active i {
            transform: rotate(45deg);
        }

        .faq-answer {
            display: none;
            padding: 10px 0;
            font-size: 1rem;
            color: var(--text-color);
            animation: slideIn 0.3s ease;
        }

        .faq-answer.active {
            display: block;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Formulaire de contact */
        .contact-form {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        }

        .contact-form h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }


        /* Guides utilisateur */
        .guides-section {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .guides-section h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .guide-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .guide-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        .guide-item a:hover {
            color: var(--accent-color);
        }

        /* Informations de contact */
        .contact-info {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
            text-align: center;
        }

        .contact-info h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .contact-info p {
            font-size: 1rem;
            color: var(--text-color);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .contact-info a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .contact-info a:hover {
            color: var(--accent-color);
        }
      
    </style>
    
@endsection

@section('scripts')
     <script>
        // FAQ Accordéon
        document.querySelectorAll('.faq-question').forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.nextElementSibling;
                const icon = item.querySelector('i');
                answer.classList.toggle('active');
                item.classList.toggle('active');
                icon.classList.toggle('fa-plus');
                icon.classList.toggle('fa-minus');
            });
        });

        // Validation du formulaire (côté client)
        let support = document.getElementById('support-form');
          support.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            if (name && email && subject && message) {
                alert('Votre message a été envoyé !');
                e.target.reset();
            } else {
                alert('Veuillez remplir tous les champs.');
            }
        });

        // Recherche simulée
        document.getElementById('help-search').addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('.faq-item').forEach(item => {
                const question = item.querySelector('.faq-question').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
                item.style.display = (question.includes(query) || answer.includes(query)) ? 'block' : 'none';
            });
        });
    </script>
@endsection