<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des Tweets</title>
<!-- Style reconquete -->
<link href="style_reconquete_tweets.css" rel="stylesheet">

<style>::after

</style>

</head>
<body>

	
Dans le cadre du projet Fachosphère, les tweets émis par les 80 candidats de Reconquête! depuis 2013 ont été compilés. <a href=trombinoscope.php>Voir le trombinoscope</a>.
<table id="datatablesSimple">

    <thead>
        <tr>
            <th>Numéro</th>
            <th>Nom du Candidat</th>
            <th>Date</th>
            <th>Tweet</th>
        </tr>
    </thead>
    <tbody>

        <?php
        // Lire le fichier JSON
        $jsonFile = 'sorted_tweets.json';
        $jsonData = json_decode(file_get_contents($jsonFile), true);

        // Trier les tweets par date en ordre décroissant
        usort($jsonData, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        // Lire les tweets depuis le JSON trié
        $tweetCount = 1;
        foreach ($jsonData as $tweet) {
            $candidateName = $tweet['candidate_name'];
            $date = $tweet['date'];
            $tweetText = $tweet['tweet'];
            echo "<tr>";
            echo "<td>{$tweetCount}</td>";
            echo "<td>{$candidateName}</td>";
            echo "<td>{$date}</td>";
            echo "<td>{$tweetText}</td>";
            echo "</tr>";
            $tweetCount++;
        }
        ?>
    </tbody>
</table>

<!-- Inclure jQuery et Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Inclure le fichier JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTable
    var dataTable = new simpleDatatables.DataTable('#datatablesSimple', {
        perPage: 10,
        columns: [
            { select: 0, sortable: false }, // Désactiver le tri pour la colonne de la case à cocher
        ],
        labels: {
            placeholder: "Rechercher...", // Texte du placeholder pour la recherche
            perPage: " résultats par page", // Texte pour le menu déroulant de sélection du nombre de résultats par page
            noRows: "Aucun résultat trouvé", // Message affiché lorsqu'aucun résultat n'est trouvé
            info: "Affichage de {start} à {end} sur {rows} résultats", // Message affiché indiquant le nombre de résultats affichés
        }
    });


});
</script>
</body>
</html>