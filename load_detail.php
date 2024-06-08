<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    //echo "ID reçu: $id<br>"; // Message de débogage
    if ($id >= 1 && $id <= 80) {
        $file = __DIR__ . '/fiches/' . $id . '.php';
        //echo "Chemin du fichier: $file<br>"; // Message de débogage
        if (file_exists($file)) {
            include $file;
        } else {
            echo 'Fichier non trouvé';
        }
    } else {
        echo 'ID invalide';
    }
} else {
    echo 'ID non spécifié';
}
?>