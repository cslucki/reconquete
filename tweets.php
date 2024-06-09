<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des Tweets</title>
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
    color: white;
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

<table id="tweets-table" class="table table-striped">
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
        require 'vendor/autoload.php';
        use Symfony\Component\Yaml\Yaml;

        // Lire le fichier YAML
        $yamlFile = 'data.yaml';
        $yamlData = Yaml::parseFile($yamlFile);

        // Créer un tableau associatif pour les candidats
        $candidates = [];
        foreach ($yamlData as $candidate) {
            $candidates[$candidate['id']] = $candidate['nom'];
        }

        // Lire les fichiers de tweets
        $tweetFiles = glob('./tweets/*.txt');
        $tweetCount = 1;

        foreach ($tweetFiles as $file) {
            $fileId = basename($file, '.txt');
            $candidateName = isset($candidates[$fileId]) ? $candidates[$fileId] : 'Inconnu';
            $tweets = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($tweets as $tweet) {
                if (strpos($tweet, 'Date:') !== false) {
                    $date = str_replace('Date: ', '', $tweet);
                } elseif (strpos($tweet, 'Tweet:') !== false) {
                    $tweetText = str_replace('Tweet: ', '', $tweet);
                    echo "<tr>";
                    echo "<td>{$tweetCount}</td>";
                    echo "<td>{$candidateName}</td>";
                    echo "<td>{$date}</td>";
                    echo "<td>{$tweetText}</td>";
                    echo "</tr>";
                    $tweetCount++;
                }
            }
        }
        ?>
    </tbody>
</table>

<!-- Inclure jQuery et Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>