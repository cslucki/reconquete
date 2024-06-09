<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id >= 1 && $id <= 80) {
        $file = __DIR__ . '/fiches/' . $id . '.php';
        if (file_exists($file)) {
            include $file;
            echo '<img src="./images/' . $id . '.jpg" class="rounded-circle" alt="Image de la personne" style="width: 200px; height: auto;">';
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