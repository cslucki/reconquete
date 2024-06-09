<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Génération de fichier PHP pour les candidats</title>
</head>
<body>
    <h1>Génération de fichier PHP pour les candidats</h1>
    <form action="" method="post">
        <label for="candidate">Choisissez un candidat :</label>
        <select name="candidate" id="candidate" required>
            <?php
            $candidates = [
                1 => "Marion Maréchal",
                2 => "Guillaume Peltier",
                3 => "Sarah Knafo",
                4 => "Nicolas Bay",
                5 => "Laurence Trochu",
                6 => "Stanislas Rigault",
                7 => "Agnès Marion",
                8 => "Jean Messiha",
                9 => "Sophie Grech",
                10 => "Philippe Vardon",
                11 => "Eve Froger",
                12 => "Damien Rieu",
                13 => "Séverine Duminy",
                14 => "Marc-Etienne Lansade",
                15 => "Emmy Font",
                16 => "Philippe Cuignache",
                17 => "Marine Chiaberto",
                18 => "Franck Manogil",
                19 => "Elodie Weber",
                20 => "Hilaire Bouyé",
                21 => "Elisabeth Louvel",
                22 => "Olivier Le Coq",
                23 => "Lucy Georges",
                24 => "Arnaud Humbert",
                25 => "Geneviève Pozzo di Borgo",
                26 => "Franck Gaillard",
                27 => "Paola Plantier",
                28 => "Stéphane Blanchon",
                29 => "Sabine Clément",
                30 => "Franck Chevrel",
                31 => "Wendy Lonchampt",
                32 => "Sébastien Buard",
                33 => "Corinne Giraud",
                34 => "David Meyer",
                35 => "Isabelle Gilbert",
                36 => "Dany Bonnet",
                37 => "Sandrine Delatre",
                38 => "Serge Lévy",
                39 => "Nathalie Ballerand",
                40 => "Xavier Fourboul",
                41 => "Isabelle Lamarque",
                42 => "Antoine Camus",
                43 => "Annick Pillot",
                44 => "Alexandre Zyzeck",
                45 => "Florie Ansannay-Alex",
                46 => "Maurice Portiche",
                47 => "Pascale Deutsch",
                48 => "Cédric Torrens",
                49 => "Fabienne Marquet",
                50 => "Marc Taulelle",
                51 => "Maylis Perrot",
                52 => "Antoine Baudino",
                53 => "Sabine Léger",
                54 => "Raymond Herbreteau",
                55 => "Dominique Piussan",
                56 => "Olivier Cleland",
                57 => "Leïla Rosenstech",
                58 => "Guy-Eric Imbert",
                59 => "Corinne Berardo",
                60 => "Jean Moucheboeuf",
                61 => "Myriam Cadenel",
                62 => "Praince Loubota",
                63 => "Anne-Marie Veira Da Silva Pinson",
                64 => "Eric Laqua",
                65 => "Nhu-Anh Do",
                66 => "Jean-Luc Coronel de Boissezon",
                67 => "Karin Hartmann",
                68 => "Arnaud Chapon",
                69 => "Laure Pellier",
                70 => "Florent Hammerschmitt",
                71 => "Caroline Hubert",
                72 => "Alain Smith",
                73 => "Claire-Emmanuelle Gauer",
                74 => "Jean-Michel Lamberti",
                75 => "Fanny Judek",
                76 => "Thierry Perret",
                77 => "Simone Benouadah",
                78 => "Yann Bompard",
                79 => "Ornella Evangelista",
                80 => "Eric Zemmour"
            ];

            $lastSelected = isset($_POST['candidate']) ? $_POST['candidate'] : '';
            foreach ($candidates as $id => $name) {
                $selected = ($id == $lastSelected) ? 'selected' : '';
                echo "<option value=\"$id\" $selected>$id - $name</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="content">Contenu de la fiche :</label>
        <br>
        <textarea name="content" id="content" rows="10" cols="50" required><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
        <br><br>
        <input type="submit" name="generate" value="Générer le fichier">
    </form>

    <?php
    if (isset($_POST['generate'])) {
        $candidateNumber = $_POST['candidate'];
        $content = $_POST['content'];

        // Nom du fichier
        $fileName = "$candidateNumber.php";

        // Contenu du fichier

        $fileContent = $content . "\n";

        // Écrire le fichier
        file_put_contents($fileName, $fileContent);

        echo "<p>Le fichier $fileName a été généré avec succès.</p>";
    }
    ?>
</body>
</html>
