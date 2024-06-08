<?php
$directory = __DIR__ . '/fiches/';
$files = array_diff(scandir($directory), array('..', '.'));

// Trier les fichiers par ordre naturel
natsort($files);

$fileContents = [];
foreach ($files as $file) {
    $filePath = $directory . '/' . $file;
    if (is_file($filePath)) {
        $content = file_get_contents($filePath);
        $fileContents[] = [
            'name' => $file,
            'content' => $content
        ];
    }
}

header('Content-Type: application/json');
echo json_encode(['files' => array_values($fileContents)]);
?>