<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des enregistrements</title>
<!-- Inclure Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
/* Styles CSS pour la mise en page */
body {
    background-color: black;
    color: white;
}

table {
    border-collapse: collapse;
    width: 100%;
    background-color: black;
    color: white;
}

table, th, td {
    border: 1px solid white;
}

th {
    padding: 10px;
    background-color: red;
    color: white;
}

td {
    padding: 8px;
    text-align: left;
    vertical-align: top; /* Alignement des colonnes sur le haut */
}

a {
    color: white;
}

a:hover {
    color: lightblue;
}

#pagination {
    margin-top: 10px;
}

#pagination a {
    padding: 5px 10px;
    background-color: blue; /* Couleur de fond bleu marine */
    color: #fff; /* Couleur du texte blanche */
    border: 1px solid blue; /* Bordure de la même couleur que le fond */
    text-decoration: none;
    margin-right: 5px;
}

#pagination a:hover {
    background-color: #001a35; /* Couleur de fond bleu marine foncée au survol */
    color: #fff; /* Couleur du texte blanche */
}

/* Styles pour la modale */
.modal-content {
    background-color: black;
    color: white;
}

.modal-header, .modal-footer {
    border-color: white;
}

.modal-title {
    color: white;
}

.modal-body a {
    color: white;
}

.modal-body a:hover {
    color: lightblue;
}
</style>
</head>
<body>

<!-- Bouton pour afficher les fichiers -->
<!--button id="show-files-btn" class="btn btn-primary">Afficher les fichiers</!--button-->

<table id="records-table" class="table table-striped">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>X</th>
        </tr>
    </thead>
    <tbody>
        <!-- Les enregistrements seront chargés ici via AJAX -->
    </tbody>
</table>

<div id="pagination"></div>

<!-- Conteneur pour afficher les fichiers -->
<div id="files-container"></div>

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

<!-- Inclure jQuery et Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
    function loadPage(page) {
        $.ajax({
            url: 'pagination.php',
            type: 'GET',
            data: { page: page },
            success: function(response) {
                var records = response.records;
                var totalPages = response.totalPages;
                var $tbody = $('#records-table tbody');
                $tbody.empty();
                $.each(records, function(index, record) {
                    var $tr = $('<tr>');
                    $tr.append('<td><a href="#" class="details-link" data-id="' + record.id + '">' + record.id + '</a></td>');
                    $tr.append('<td><a href="#" class="details-link" data-id="' + record.id + '">' + record.nom + '</a></td>');
                    $tr.append('<td><a href="' + record.twitter + '" target="_blank">' + record.twitter + '</a></td>');
                    $tbody.append($tr);
                });

                var $pagination = $('#pagination');
                $pagination.empty();
                if (page > 1) {
                    $pagination.append('<a href="#" class="page-link" data-page="' + (page - 1) + '">Précédent</a>');
                }
                $pagination.append('<span> Page ' + page + ' sur ' + totalPages + ' </span>');
                if (page < totalPages) {
                    $pagination.append('<a href="#" class="page-link" data-page="' + (page + 1) + '">Suivant</a>');
                }
            }
        });
    }

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        loadPage(page);
    });

    $(document).on('click', '.details-link', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#details-container').load('load_detail.php?id=' + id, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Désolé, une erreur s'est produite: ";
                $("#details-container").html(msg + xhr.status + " " + xhr.statusText);
            } else {
                $('#detailsModal').modal('show');
            }
        });
    });

    // Charger la première page au démarrage
    loadPage(1);

    // Fonction pour afficher les fichiers
    $('#show-files-btn').click(function() {
        $.ajax({
            url: 'list_files.php',
            type: 'GET',
            success: function(response) {
                var $filesContainer = $('#files-container');
                $filesContainer.empty();
                $.each(response.files, function(index, file) {
                    var fileNameWithoutExtension = file.name.replace('.php', '');
                    $filesContainer.append('<div><h3>Candidat numéro ' + fileNameWithoutExtension + '</h3>' + file.content + '</div>');
                });
            }
        });
    });
});
</script>

</body>
</html>