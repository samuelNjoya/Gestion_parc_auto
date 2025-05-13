<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion PA</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Variables CSS pour les thèmes clair et sombre */
        :root {
            --bg-color: #F3F4F6;
            --card-bg: #FFFFFF;
            --text-color: #4B5563;
            --primary-color: #1E3A8A;
            --accent-color: #DC2626;
            --footer-bg: #1E3A8A;
            --footer-text: #FFFFFF;
        }

        /* Réinitialisation et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Conteneur principal */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 20px;
        }

        /* Carte de connexion */
        .login-card {
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        /* Formulaire */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            position: relative;
            text-align: left;
        }

        .form-group label {
            font-size: 1rem;
            color: var(--text-color);
            margin-bottom: 5px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 10px 10px 10px 35px; /* Espace pour l'icône à gauche */
            border: 1px solid var(--text-color);
            border-radius: 5px;
            font-size: 1rem;
            color: var(--text-color);
            background-color: var(--card-bg);
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        /* Icônes des champs */
        .form-group i {
            position: absolute;
            top: 70%;
            transform: translateY(-50%);
            color: var(--text-color);
            font-size: 1.2rem;
            transition: color 0.2s ease;
        }

        .form-group input:focus + i {
            color: var(--primary-color);
            /* border: 2px solid var(--primary-color); */
        }

        .email-icon,.password-icon{
            left: 10px;
        }

        /* Toggle mot de passe */
        .password-toggle {
            right: 10px;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: var(--accent-color);
        }

        /* Bouton de connexion */
        .login-button {
            background-color: var(--primary-color);
            color: var(--footer-text);
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-button:hover {
            background-color: var(--accent-color);
            transform: scale(1.05);
        }

        /* Lien mot de passe oublié */
        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 10px;
            display: inline-block;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: var(--accent-color);
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .login-card {
                padding: 20px;
                max-width: 90%;
            }

            .logo {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Conteneur de connexion -->
    <div class="login-container">
        <div class="login-card">
            <div class="logo">LOGIN</div>
            <form class="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Entrez votre email">
                    <i class="fas fa-envelope email-icon" aria-hidden="true"></i>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required placeholder="Entrez votre mot de passe">
                    <i class="fas fa-lock password-icon" aria-hidden="true"></i>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword()"></i>
                </div>
                <button type="submit" class="login-button">Se connecter</button>
                <a href="#" class="forgot-password">Mot de passe oublié ?</a>
            </form>
        </div>
    </div>

    <script>
        // Toggle mot de passe
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    
    </script>
</body>
</html>