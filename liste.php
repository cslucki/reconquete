<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des enregistrements</title>
<style>
/* Styles CSS facultatifs pour la mise en page */
table {
    border-collapse: collapse;
    width: 100%;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 8px;
    text-align: left;
    vertical-align: top; /* Alignement des colonnes sur le haut */
}

#pagination {
    margin-top: 10px;
}
#pagination a {
    padding: 5px 10px;
    background-color: Blue; /* Couleur de fond bleu marine */
    color: #fff; /* Couleur du texte blanche */
    border: 1px solid Blue; /* Bordure de la même couleur que le fond */
    text-decoration: none;
    margin-right: 5px;
}

#pagination a:hover {
    background-color: #001a35; /* Couleur de fond bleu marine foncée au survol */
    color: #fff; /* Couleur du texte blanche */
}
/* Style pour cacher les détails par défaut */
.details {
    display: none;
}

/* Style pour le conteneur des détails */
#details-container {
    margin-top: 20px;
}
</style>
</head>
<body>

<!-- Bouton pour afficher les fichiers -->
<button id="show-files-btn">Afficher les fichiers</button>

<table id="records-table">
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

<!-- Conteneur pour afficher les détails -->
<div id="details-container"></div>

<!-- Conteneur pour afficher les fichiers -->
<div id="files-container"></div>

<!-- Script jQuery pour gérer la pagination et afficher les détails -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    $tr.append('<td><a href="#" class="details-link">' + record.id + '</a></td>');
                    $tr.append('<td><a href="#" class="details-link">' + record.nom + '</a></td>');
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
        var id = $(this).closest('tr').find('td:first-child').text();
        $('#details-container').load('load_detail.php?id=' + id, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Désolé, une erreur s'est produite: ";
                $("#details-container").html(msg + xhr.status + " " + xhr.statusText);
            } else {
                console.log(response); // Afficher la réponse pour le débogage
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