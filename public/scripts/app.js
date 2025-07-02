
        // Tri du tableau
        let sortDirection = 1;
        function sortTable(columnIndex) {
            const tbody = document.getElementById('TriTableBody');
            const rows = Array.from(tbody.getElementsByTagName('tr'));
            rows.sort((a, b) => {
                const aValue = a.getElementsByTagName('td')[columnIndex].textContent.trim();
                const bValue = b.getElementsByTagName('td')[columnIndex].textContent.trim();
                return aValue.localeCompare(bValue, undefined, { numeric: true }) * sortDirection;
            });
            rows.forEach(row => tbody.appendChild(row));
            sortDirection *= -1;
        }
       

                     // Gestion de l’aperçu de la photo
    document.addEventListener('DOMContentLoaded', () => {
        const photoInput = document.getElementById('photo');
        const photoPreview = document.getElementById('photoPreview');

        if (photoInput && photoPreview) {
            photoInput.addEventListener('change', () => {
                const file = photoInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                   // photoPreview.src = 'https://via.placeholder.com/150'; // Placeholder si pas d’image
                }
            });
        } else {
            console.error('Photo input or preview element not found');
        }
    });
       
       // Attendre que le DOM soit chargé
        document.addEventListener('DOMContentLoaded', () => {
            // Correction hamburger menu
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');

            if (hamburger && sidebar && mainContent) {
                hamburger.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                    mainContent.classList.toggle('full-width');
                    hamburger.setAttribute('aria-expanded', sidebar.classList.contains('active'));
                });
            } else {
                console.error('Hamburger, sidebar, or main-content not found');
            }

            // Correction mode clair/sombre
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('i');
            let currentTheme = localStorage.getItem('theme') || 'light';
            document.body.dataset.theme = currentTheme;
            updateThemeIcon();

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    currentTheme = currentTheme === 'light' ? 'dark' : 'light';
                    document.body.dataset.theme = currentTheme;
                    localStorage.setItem('theme', currentTheme);
                    updateThemeIcon();
                });
            }

            function updateThemeIcon() {
                themeIcon.className = currentTheme === 'light' ? 'fas fa-sun' : 'fas fa-moon';
            }

            // Gestion sécurisée des liens sidebar
            const anchors = document.querySelectorAll('.sidebar a');
            anchors.forEach(anchor => {
                if (anchor) {
                    anchor.addEventListener('click', (e) => {
                        const href = anchor.getAttribute('href');
                        if (href) {
                            console.log(`Navigating to ${href}`);
                            // Ajoute ici ta logique pour les clics
                        }
                    });
                }
            });

            // Correction graphiques Chart.js
            const fuelCostCanvas = document.getElementById('fuelCostChart');
            const maintenanceTypeCanvas = document.getElementById('maintenanceTypeChart');
            const consumptionCanvas = document.getElementById('consumptionChart');

            if (fuelCostCanvas && maintenanceTypeCanvas && consumptionCanvas) {
                // Graphique 1: Coût carburant par mois (Bar)
                const fuelCostChart = new Chart(fuelCostCanvas, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai'],
                        datasets: [{
                            label: 'Coût (€)',
                            data: [1200, 1500, 1400, 1600, 2500],
                            backgroundColor: 'rgba(30, 58, 138, 0.6)',
                            borderColor: 'rgba(30, 58, 138, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });

                // Graphique 2: Types de maintenance (Pie)
                const maintenanceTypeChart = new Chart(maintenanceTypeCanvas, {
                    type: 'pie',
                    data: {
                        labels: ['Vidange', 'Réparation', 'Contrôle Technique'],
                        datasets: [{
                            label: 'Nombre',
                            data: [10, 5, 3],
                            backgroundColor: [
                                'rgba(30, 58, 138, 0.6)',
                                'rgba(220, 38, 38, 0.6)',
                                'rgba(75, 85, 99, 0.6)'
                            ],
                            borderColor: [
                                'rgba(30, 58, 138, 1)',
                                'rgba(220, 38, 38, 1)',
                                'rgba(75, 85, 99, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });

                // Graphique 3: Consommation moyenne par véhicule (Line)
                const consumptionChart = new Chart(consumptionCanvas, {
                    type: 'line',
                    data: {
                        labels: ['Peugeot 308', 'Renault Clio', 'Iveco Daily'],
                        datasets: [{
                            label: 'Consommation (L/100 km)',
                            data: [7.0, 6.5, 8.0],
                            fill: false,
                            borderColor: 'rgba(30, 58, 138, 1)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            } else {
                console.error('One or more chart canvases not found');
            }
        });


// Chart.js - Répartition des EPI
const epiDistributionChart = new Chart(document.getElementById('epiDistributionChart'), {
    type: 'doughnut',
    data: {
        labels: ['En service', 'En maintenance', 'Hors service'],
        datasets: [{
            data: [300, 450, 200],
            backgroundColor: ['#1E3A8A', '#DC2626', '#4B5563']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

   // Validation personnalisée avec Bootstrap
    (() => {
      'use strict'
      const form = document.getElementById('formulaire');

      // Écouteur sur la soumission du formulaire
      form.addEventListener('submit', event => {
        // La méthode checkValidity() vérifie si tous les champs requis sont valides
        if (!form.checkValidity()) {
          // Si un champ requis est invalide, on empêche la soumission du formulaire
          event.preventDefault()
          event.stopPropagation()
        }
        // Ajout de la classe Bootstrap 'was-validated' pour afficher les messages d'erreur  +237698394295 formateur
        form.classList.add('was-validated')
      }, false)
    })()