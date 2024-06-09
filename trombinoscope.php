<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trombinoscope des Candidats</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            width: 100%;
            height: 150px; /* Ajustez la hauteur selon vos besoins */
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" id="candidates-container">
            <!-- Les cartes des candidats seront insérées ici par JavaScript -->
        </div>
    </div>

    <!-- Modale Bootstrap -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Détails de la fiche</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="details-container">
                    <!-- Les détails seront chargés ici via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php
        require 'vendor/autoload.php';
        use Symfony\Component\Yaml\Yaml;

        // Lire le fichier YAML
        $yamlFile = 'data.yaml';
        $yamlData = Yaml::parseFile($yamlFile);

        // Convertir les données YAML en JSON
        $jsonData = json_encode($yamlData);
        ?>

        // Passer les données JSON à JavaScript
        const candidates = <?php echo $jsonData; ?>;

        function generateCandidateCards(candidates) {
            const container = document.getElementById('candidates-container');
            candidates.forEach(candidate => {
                const card = document.createElement('div');
                card.className = 'col-md-4';
                card.innerHTML = `
                    <div class="card mb-4">
                        <img src="images/${candidate.id}.jpg" class="card-img-top" alt="${candidate.nom}">
                        <div class="card-body">
                            <h5 class="card-title"><a href="#" class="details-link" data-id="${candidate.id}">${candidate.nom}</a></h5>
                            <p class="card-text">${candidate.twitter ? `<a href="${candidate.twitter}" target="_blank">Twitter</a>` : ''}</p>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        $(document).ready(function(){
            // Appeler la fonction pour générer les cartes
            generateCandidateCards(candidates);

            // Charger les détails dans la modale
            $(document).on('click', '.details-link', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#details-container').load('fiches/' + id + '.php', function(response, status, xhr) {
                    if (status == "error") {
                        var msg = "Désolé, une erreur s'est produite: ";
                        $("#details-container").html(msg + xhr.status + " " + xhr.statusText);
                    } else {
                        // Ajouter la photo du candidat à la fin de la fiche
                        const img = `<img src="images/${id}.jpg" class="rounded-circle" style="width: 200px; height: auto;" alt="Photo de ${id}">`;
                        $('#details-container').append(img);
                        $('#detailsModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>