<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des Tweets du Candidat</title>
<!-- Inclure Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Style reconquete -->
<link href="style_reconquete.css" rel="stylesheet">

</head>
<body>

<table id="tweets-table" class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Tweet</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Lire le fichier JSON
        $jsonFile = 'sorted_tweets.json';
        $jsonData = json_decode(file_get_contents($jsonFile), true);

        // Récupérer le candidate_id depuis les paramètres GET
        $candidateId = isset($_GET['candidate_id']) ? $_GET['candidate_id'] : null;

        // Filtrer les tweets pour le candidat donné et trier par date en ordre décroissant
        $filteredTweets = array_filter($jsonData, function($tweet) use ($candidateId) {
            return $tweet['candidate_id'] == $candidateId;
        });

        usort($filteredTweets, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        // Afficher les tweets filtrés
        foreach ($filteredTweets as $tweet) {
            $date = $tweet['date'];
            $tweetText = $tweet['tweet'];
            echo "<tr>";
            echo "<td>{$date}</td>";
            echo "<td>{$tweetText}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<!-- Inclure jQuery et Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>