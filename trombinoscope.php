<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trombinoscope des Candidats</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row" id="candidates-container">
            <!-- Les cartes des candidats seront insérées ici par JavaScript -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/4.1.0/js-yaml.min.js"></script>
    <script>
        // Exemple de données JSON converties depuis YAML
        const candidates = [
            { id: '1', nom: 'Nom Candidat 1', twitter: '...', facebook: '...', profession: '...', instagram: '...' },
            { id: '2', nom: 'Nom Candidat 2', twitter: '...', facebook: '...', profession: '...', instagram: '...' },
            // Ajoutez d'autres candidats ici
        ];

        // Fonction pour générer les cartes des candidats
        function generateCandidateCards(candidates) {
            const container = document.getElementById('candidates-container');
            candidates.forEach(candidate => {
                const card = document.createElement('div');
                card.className = 'col-md-4';
                card.innerHTML = `
                    <div class="card mb-4">
                        <img src="images/${candidate.id}.jpg" class="card-img-top" alt="${candidate.nom}">
                        <div class="card-body">
                            <h5 class="card-title">${candidate.nom}</h5>
                            <!-- Ajoutez d'autres informations si nécessaire -->
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        // Appeler la fonction pour générer les cartes
        generateCandidateCards(candidates);
    </script>
</body>
</html>