<?php

// Définir les répertoires
$tweetsDir = 'D:\reconquete\tweets';
$sortedTweetsFile = 'D:\reconquete\sorted_tweets.json';

// Fonction pour lire et extraire les tweets des fichiers
function readTweetsFromFile($filePath, $candidateId) {
    $tweets = [];
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $tweetData = [];
    foreach ($lines as $line) {
        if (strpos($line, 'Date:') !== false) {
            $tweetData['date'] = str_replace('Date: ', '', $line);
        } elseif (strpos($line, 'Tweet:') !== false) {
            $tweetData['tweet'] = str_replace('Tweet: ', '', $line);
            $tweetData['candidate_id'] = $candidateId;
            $tweets[] = $tweetData;
            $tweetData = [];
        }
    }
    return $tweets;
}

// Lire tous les fichiers de tweets dans le répertoire
$tweetFiles = glob("$tweetsDir/*.txt");
$allTweets = [];

foreach ($tweetFiles as $file) {
    $candidateId = basename($file, '.txt'); // Utiliser le nom du fichier comme ID du candidat
    $tweets = readTweetsFromFile($file, $candidateId);
    $allTweets = array_merge($allTweets, $tweets);
}

// Trier les tweets par date
usort($allTweets, function($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
});

// Enregistrer les tweets triés dans sorted_tweets.json
file_put_contents($sortedTweetsFile, json_encode($allTweets, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

echo "Les tweets triés ont été enregistrés dans $sortedTweetsFile\n";

?>