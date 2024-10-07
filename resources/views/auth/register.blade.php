<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Multi-Étapes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            color: #333;
        }

        .hidden {
            display: none;
        }

        .container {
            max-width: 700px;
            margin: auto;
            padding: 2rem;
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style> -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            color: #333;
        }

        .hidden {
            display: none;
        }

        .container {
            max-width: 700px;
            /* overflow: auto;
            margin: auto; */
            padding: 2rem;
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }

        h2,
        h3 {
            text-align: center;
            color: #677B44;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background-color: #677B44;
            border-color: #677B44;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .step-indicator .step {
            flex-grow: 1;
            position: relative;
            text-align: center;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .step-indicator .step:before {
            content: attr(data-step);
            width: 30px;
            height: 30px;
            background-color: #d1d3e2;
            color: white;
            border-radius: 50%;
            display: inline-block;
            line-height: 30px;
            margin-bottom: 0.5rem;
        }

        .step-indicator .step.active:before {
            background-color: #677B44;
        }

        .step-indicator .step.active {
            color: #677B44;
        }

        .step-indicator .progress-bar {
            position: absolute;
            width: 100%;
            top: 15px;
            left: 50%;
            height: 4px;
            background-color: #e9ecef;
            z-index: -1;
        }

        .step-indicator .step.active+.step .progress-bar {
            background-color: #677B44;
        }

        .step-indicator .step:first-child .progress-bar {
            display: none;
        }

        .form-check {
            position: relative;
            padding-left: .5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .form-check-label {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            color: black;
        }

        .form-check-label:hover {
            color: #677B44;
        }

        .form-check-input {
            position: absolute;
            left: 0;
            height: 1rem;
            width: 1rem;
            background-color: transparent;
            border-radius: 50%;
            border: 2px solid black;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #677B44;
            border-color: #677B44;
        }

        .form-check-input:checked::after {
            content: "";
            font-size: 1rem;
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Animation d'apparition des éléments */
        .form-check-input:checked+.form-check-label {
            color: #677B44;
            font-weight: 500;
        }

        .list-container {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Ajout d'une animation au survol */
        .form-check:hover .form-check-input {
            border-color: #677B44;
        }

        /* Personnalisation de la barre de défilement */
        .list-container::-webkit-scrollbar {
            width: 8px;
        }

        .list-container::-webkit-scrollbar-thumb {
            background-color: #677B44;
            border-radius: 10px;
        }
    </style>
</head>

<body>


    <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscriptionModalLabel">Formules d'abonnement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h6>Formule de Base</h6>
                            <p>Accès limité aux fonctionnalités de base.</p>
                            <p><strong>Prix : 10€/mois</strong></p>
                        </li>
                        <li class="list-group-item">
                            <h6>Formule Standard</h6>
                            <p>Accès aux fonctionnalités avancées.</p>
                            <p><strong>Prix : 20€/mois</strong></p>
                        </li>
                        <li class="list-group-item">
                            <h6>Formule Premium</h6>
                            <p>Accès à toutes les fonctionnalités, y compris le support prioritaire.</p>
                            <p><strong>Prix : 30€/mois</strong></p>
                        </li>
                        <li class="list-group-item">
                            <h6>Formule Entreprise</h6>
                            <p>Solutions sur mesure pour les entreprises.</p>
                            <p><strong>Prix : 50€/mois</strong></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary">Choisir cette formule</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-2">
        <h2>Inscription à la plateforme</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Indicateur de progression -->
        <div class="step-indicator">
            <div class="step active" data-step="1">
                <span>Informations</span>
                <div class="progress-bar"></div>
            </div>
            <div class="step" data-step="2">
                <span>Services</span>
                <div class="progress-bar"></div>
            </div>
            <div class="step" data-step="3">
                <span>Secteurs</span>
                <div class="progress-bar"></div>
            </div>
            <div class="step" data-step="4">
                <span>Sous-secteurs</span>
                <div class="progress-bar"></div>
            </div>
            <div class="step" data-step="5">
                <span>Pays</span>
            </div>
        </div>

        <form id="registrationForm" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Étape 1: Informations personnelles -->
            <div class="step" id="step1">
                <h3>Étape 1: Informations personnelles</h3>

                <div class="row">
                    <!-- Champ Prénom -->
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>

                    <!-- Champ Nom -->
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                </div>

                <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
            </div>

            <!-- Étape 2: Choisir les services -->
            <div class="step hidden" id="step2">
                <h3>Étape 2: Choisir les services</h3>
                <div class="mb-3">
                    @foreach($services as $service)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $service->id }}" id="service{{ $service->id }}" name="services[]">
                        <label class="form-check-label" for="service{{ $service->id }}">
                            {{ $service->libelle }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
            </div>

            <!-- Étape 3: Choisir le secteur -->
            <!-- <div class="step hidden" id="step3">
                <h3>Étape 3: Choisir le secteur</h3>
                <div class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="mb-3">
                    <label class="form-label">Choisir les secteurs d'activité</label>
                    <div class="row">
                        @foreach($secteurs as $secteur)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $secteur->id }}" id="secteur{{ $secteur->id }}" name="secteurs[]" onchange="loadSousSecteurs()">
                                <label class="form-check-label" for="secteur{{ $secteur->id }}">
                                    {{ $secteur->libelle }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
            </div> -->

            <!-- Étape 3: Choisir le secteur -->
            <div class="step hidden" id="step3">
                <h3>Étape 3: Choisir le secteur</h3>
                <div class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="secteurSearch" onkeyup="filterSecteurs()">
                </div>
                <div class="mb-3">
                    <label class="form-label">Choisir les secteurs d'activité</label>
                    <div class="row" id="secteurList">
                        @foreach($secteurs as $secteur)
                        <div class="col-md-4 secteur-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $secteur->id }}" id="secteur{{ $secteur->id }}" name="secteurs[]" onchange="loadSousSecteurs()">
                                <label class="form-check-label" for="secteur{{ $secteur->id }}">
                                    {{ $secteur->libelle }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
            </div>




            <!-- Étape 4: Choisir les sous-secteurs -->
            <div class="step hidden" id="step4">
                <h3>Étape 4: Choisir les sous-secteurs</h3>
                <div class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="soussecteurSearch" onkeyup="filterSousSecteurs()">
                </div>
                <div class="mb-3">
                    <div class="row" id="sousSecteursContainer">

                        <!-- Les sous-secteurs seront chargés ici -->

                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Suivant</button>
            </div>

            <!-- Étape 5: Choisir le pays -->
            <!-- <div class="step hidden" id="step5">
                <h3>Étape 5: Choisir le pays</h3>
                <div class="mb-3">
                    <select class="form-select" id="pays" name="pays" required>
                        @foreach($pays as $p)
                        <option value="{{ $p['id'] }}">{{ $p['fr']}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
                <button type="submit" class="btn btn-success">Créer le compte</button>
            </div> -->

            <div class="step hidden" id="step5">
                <h3>Étape 5: Choisir le pays</h3>
                <div class="mb-3">
                    <label class="form-label">Choisir le pays</label>
                    <div class="row">
                        @foreach($pays as $p)
                        <div class="col-md-4"> <!-- Utilisation de col-md-4 pour trois colonnes par ligne -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="{{ $p['id'] }}" id="p{{ $p['id'] }}" name="pays_partner_id">
                                <label class="form-check-label" for="p{{ $p['id'] }}">
                                    {{ $p['fr'] }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
                <button type="submit" class="btn btn-success">Créer le compte</button>
            </div>
        </form>
    </div>

</body>
<!-- Liens JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>





<script>
    let currentStep = 1;

    function showStep(step) {
        // Cacher toutes les étapes
        const steps = document.querySelectorAll('.step');
        steps.forEach(step => step.classList.add('hidden'));

        // Afficher l'étape actuelle
        document.getElementById('step' + step).classList.remove('hidden');
    }


    function nextStep() {
        document.getElementById('step' + currentStep).classList.add('hidden');
        document.querySelector('.step[data-step="' + currentStep + '"]').classList.remove('active');
        currentStep++;
        document.getElementById('step' + currentStep).classList.remove('hidden');
        document.querySelector('.step[data-step="' + currentStep + '"]').classList.add('active');
    }

    function prevStep() {
        document.getElementById('step' + currentStep).classList.add('hidden');
        document.querySelector('.step[data-step="' + currentStep + '"]').classList.remove('active');
        currentStep--;
        document.getElementById('step' + currentStep).classList.remove('hidden');
        document.querySelector('.step[data-step="' + currentStep + '"]').classList.add('active');
    }

    // Charger les données (services, secteurs, sous-secteurs, pays)
    document.addEventListener('DOMContentLoaded', () => {
        loadServices();
        loadSecteurs();
        loadSousSecteurs();
        loadPays();
    });


    function filterSecteurs() {
        const input = document.getElementById('secteurSearch');
        const filter = input.value.toLowerCase();
        const secteurs = document.getElementsByClassName('secteur-item');

        for (let i = 0; i < secteurs.length; i++) {
            const label = secteurs[i].getElementsByTagName('label')[0];
            if (label) {
                const textValue = label.textContent || label.innerText;
                secteurs[i].style.display = textValue.toLowerCase().includes(filter) ? '' : 'none';
            }
        }
    }

    function filterSousSecteurs() {
        const input = document.getElementById('soussecteurSearch');
        const filter = input.value.toLowerCase();
        const secteurs = document.getElementsByClassName('sous-secteur-item');

        for (let i = 0; i < secteurs.length; i++) {
            const label = secteurs[i].getElementsByTagName('label')[0];
            if (label) {
                const textValue = label.textContent || label.innerText;
                secteurs[i].style.display = textValue.toLowerCase().includes(filter) ? '' : 'none';
            }
        }
    }

    // Fonction pour charger les services
    function loadServices() {
        const services = ['Service 1', 'Service 2', 'Service 3']; // Vous pouvez charger dynamiquement depuis une API
        const servicesList = document.getElementById('servicesList');

        services.forEach(service => {
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'selectedServices[]';
            checkbox.value = service;
            checkbox.id = service;

            const label = document.createElement('label');
            label.htmlFor = service;
            label.innerText = service;

            servicesList.appendChild(checkbox);
            servicesList.appendChild(label);
            servicesList.appendChild(document.createElement('br'));
        });
    }

    // Fonction pour charger les secteurs
    function loadSecteurs() {

        const secteursList = document.getElementById('secteursList');

        secteurs.forEach(secteur => {
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'selectedSecteurs[]';
            checkbox.value = secteur;
            checkbox.id = secteur;

            const label = document.createElement('label');
            label.htmlFor = secteur;
            label.innerText = secteur;

            secteursList.appendChild(checkbox);
            secteursList.appendChild(label);
            secteursList.appendChild(document.createElement('br'));
        });
    }

    function loadSousSecteurs() {
        // Récupérer tous les secteurs sélectionnés
        const secteursChecked = document.querySelectorAll('input[name="secteurs[]"]:checked');
        const selectedSecteurIds = Array.from(secteursChecked).map(input => input.value);

        const sousSecteursContainer = document.getElementById('sousSecteursContainer');
        sousSecteursContainer.innerHTML = ''; // Vider les sous-secteurs précédents

        if (selectedSecteurIds.length === 0) {
            sousSecteursContainer.innerHTML = '<p>Aucun secteur sélectionné</p>';
            return;
        }

        // Requête Ajax pour récupérer les sous-secteurs
        fetch(`/get-sous-secteurs?secteurs[]=${selectedSecteurIds.join('&secteurs[]=')}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(sousSecteur => {
                        sousSecteursContainer.innerHTML += `
                        <div class="col-md-4 sous-secteur-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${sousSecteur.id}" id="sousSecteur${sousSecteur.id}" name="sousSecteurs[]">
                                <label class="form-check-label" for="sousSecteur${sousSecteur.id}">
                                    ${sousSecteur.libelle}
                                </label>
                            </div>
                        </div>
                    `;
                    });
                } else {
                    sousSecteursContainer.innerHTML = '<p>Aucun sous-secteur disponible</p>';
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                sousSecteursContainer.innerHTML = '<p>Une erreur est survenue lors du chargement des sous-secteurs</p>';
            });

    }


    // Fonction pour charger les pays
    function loadPays() {
        const pays = ['Sénégal', 'France', 'Mali']; // À remplacer avec des données réelles
        const paysSelect = document.getElementById('pays');

        pays.forEach(p => {
            const option = document.createElement('option');
            option.value = p;
            option.text = p;
            paysSelect.appendChild(option);
        });
    }
</script>
