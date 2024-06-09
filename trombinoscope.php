<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trombinoscope des Candidats</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            width: 100%;
            height: 150px; /* Ajustez la hauteur selon vos besoins */
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row" id="candidates-container">
            <!-- Les cartes des candidats seront insérées ici par JavaScript -->
        </div>
    </div>

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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-yaml/4.1.0/js-yaml.min.js"></script>
    <script>
        // Données YAML converties en JSON
        const yamlData = `
        - id: 1
          nom: Marion Maréchal
          twitter: https://x.com/MarionMarechal
        - id: 2
          nom: Guillaume Peltier
          twitter: https://x.com/G_Peltier
        - id: 3
          nom: Sarah Knafo
          twitter: https://x.com/knafo_sarah
        - id: 4
          nom: Nicolas Bay
          twitter: https://x.com/NicolasBay_
        - id: 5
          nom: Laurence Trochu
          twitter: https://x.com/LaurenceTrochu
        - id: 6
          nom: Stanislas Rigault
          twitter: https://x.com/stanislasrig
        - id: 7
          nom: Agnès Marion
          twitter: https://x.com/_AgnesMarion
        - id: 8
          nom: Jean Messiha
          twitter: https://x.com/JeanMessiha
        - id: 9
          nom: Sophie Grech
          twitter: https://x.com/SophieGrech13
        - id: 10
          nom: Philippe Vardon
          twitter: https://x.com/P_Vardon
        - id: 11
          nom: Eve Froger
          twitter: https://x.com/EveFroger
        - id: 12
          nom: Damien Rieu
          twitter: https://x.com/damienrieu
        - id: 13
          nom: Séverine Duminy
          twitter: https://x.com/SeverineDuminy
        - id: 14
          nom: Marc-Etienne Lansade
          twitter: https://x.com/lansade
        - id: 15
          nom: Emmy Font
          twitter: https://x.com/FontEmmy
        - id: 16
          nom: Philippe Cuignache
          twitter: https://x.com/philippecuigna1
        - id: 17
          nom: Marine Chiaberto
          twitter: https://x.com/ChiabertoMarine
        - id: 18
          nom: Franck Manogil
          twitter: https://x.com/franck_manogil
        - id: 19
          nom: Elodie Weber
          twitter: 
          facebook : "https://www.facebook.com/elodie.weber.509"
        - id: 20
          nom: Hilaire Bouyé
          twitter: https://x.com/HilaireBouye
        - id: 21
          nom: Elisabeth Louvel
          twitter: https://x.com/E_Louvel
        - id: 22
          nom: Olivier Le Coq
          twitter: https://x.com/olivierlecoq
        - id: 23
          nom: Lucy Georges
          twitter: https://x.com/LucyMotherOf4
        - id: 24
          nom: Arnaud Humbert
          twitter: https://x.com/arno_humbert
        - id: 25
          nom: Geneviève Pozzo di Borgo
          twitter: https://x.com/Pozzo_diBorgo
        - id: 26
          nom: Franck Gaillard
          twitter: https://x.com/FGaillard21
        - id: 27
          nom: Paola Plantier
          twitter: https://x.com/Paola_Plantier
        - id: 28
          nom: Stéphane Blanchon
          twitter: https://x.com/S_Blanchon
        - id: 29
          nom: Sabine Clément
          profession: Coiffeuse
          twitter: https://x.com/ClmentSabine
        - id: 30
          nom: Franck Chevrel
          profession: Chef d’entreprise
          twitter: https://x.com/Franckchc1
        - id: 31
          nom: Wendy Lonchampt
          twitter: https://x.com/WendyLonchampt
        - id: 32
          nom: Sébastien Buard
          twitter: https://x.com/BuardSbastien1
        - id: 33
          nom: Corinne Giraud
          twitter: https://x.com/GiraudCorinne3
        - id: 34
          nom: David Meyer
          twitter: https://x.com/david_meyer2022
        - id: 35
          nom: Isabelle Gilbert
          twitter: https://twitter.com/IsabelleGilbert
        - id: 36
          nom: Dany Bonnet
          twitter: https://x.com/Dany_AEZ
        - id: 37
          nom: Sandrine Delatre
          twitter: https://x.com/DelatreSandrin1
        - id: 38
          nom: Serge Lévy
          twitter: https://x.com/sergelevy770
        - id: 39
          nom: Nathalie Ballerand
          twitter: https://x.com/BallerandN/
        - id: 40
          nom: Xavier Fourboul
          twitter: https://x.com/XavierFourboul
        - id: 41
          nom: Isabelle Lamarque
          twitter: https://x.com/LamarqueIsabel2
        - id: 42
          nom: Antoine Camus
          twitter: https://x.com/camusantoine199
        - id: 43
          nom: Annick Pillot
          twitter: https://x.com/AnnickPllt
        - id: 44
          nom: Alexandre Zyzeck
          twitter: https://x.com/AZYZECK
        - id: 45
          nom: Florie Ansannay-Alex
          twitter: https://x.com/Fleur_Z74
        - id: 46
          nom: Maurice Portiche
          twitter: 
        - id: 47
          nom: Pascale Deutsch
          twitter: https://x.com/PascaleDeutsch
        - id: 48
          nom: Cédric Torrens
          twitter: https://x.com/TorrensCedric
        - id: 49
          nom: Fabienne Marquet
          twitter: 
        - id: 50
          nom: Marc Taulelle
          twitter: https://x.com/MarcTaulelle30
        - id: 51
          nom: Maylis Perrot
          twitter: https://x.com/MaylisPerrot
        - id: 52
          nom: Antoine Baudino
          twitter: https://x.com/AntoineBaudino
        - id: 53
          nom: Sabine Léger
          twitter: https://x.com/SabineLeger
        - id: 54
          nom: Raymond Herbreteau
          twitter: https://x.com/HerbreteauRaym2
        - id: 55
          nom: Dominique Piussan
          twitter: https://x.com/DomiPiussan
        - id: 56
          nom: Olivier Cleland
          twitter: https://x.com/OlivierCleland
        - id: 57
          nom: Leïla Rosenstech
          twitter: https://x.com/LeilaMarieR
        - id: 58
          nom: Guy-Eric Imbert
          twitter: https://x.com/ImbertGuyEric
        - id: 59
          nom: Corinne Berardo
          twitter: https://x.com/corinneberardo
        - id: 60
          nom: Jean Moucheboeuf
          twitter: https://x.com/JeanMoucheboeuf
        - id: 61
          nom: Myriam Cadenel
          twitter: https://x.com/CadenelMyriam
        - id: 62
          nom: Praince Loubota
          twitter: https://x.com/Pr1cedechezloub
        - id: 63
          nom: Anne-Marie Veira Da Silva Pinson
          twitter: https://x.com/ana_pinson
        - id: 64
          nom: Eric Laqua
          twitter: https://x.com/EricLaqua
        - id: 65
          nom: Nhu-Anh Do
          twitter: https://x.com/anh_nhu23003
        - id: 66
          nom: Jean-Luc Coronel de Boissezon
          twitter: https://x.com/JLCdeB
        - id: 67
          nom: Karin Hartmann
          twitter: https://x.com/khart06
        - id: 68
          nom: Arnaud Chapon
          twitter: https://x.com/ArnaudChapon
        - id: 69
          nom: Laure Pellier
          twitter: https://x.com/Laure_Pellier
        - id: 70
          nom: Florent Hammerschmitt
          twitter: https://x.com/florenthammer
        - id: 71
          nom: Caroline Hubert
          twitter: https://x.com/HubertCaro26011
        - id: 72
          nom: Alain Smith
          twitter: 
        - id: 73
          nom: Claire-Emmanuelle Gauer
          twitter: https://x.com/GauerClaire
        - id: 74
          nom: Jean-Michel Lamberti
          twitter: https://x.com/Lamberti_JM
        - id: 75
          nom: Fanny Judek
          twitter: https://x.com/FannyJudek
        - id: 76
          nom: Thierry Perret
          twitter: https://x.com/BenouadahSimone
          facebook: https://www.facebook.com/thierry.perret.5
        - id: 77
          nom: Simone Benouadah
          twitter: https://x.com/BenouadahSimone
        - id: 78
          nom: Yann Bompard
          twitter: https://x.com/YannBompard
        - id: 79
          nom: Ornella Evangelista
          twitter: 
          instagram: https://www.instagram.com/ornellaevangelista/
        - id: 80
          nom: Eric Zemmour
          twitter: https://x.com/ZemmourEric
        - id: 81
          nom: Evelyne Reybert
          twitter: 
        `;

        const candidates = jsyaml.load(yamlData);

        function generateCandidateCards(candidates) {
            const container = document.getElementById('candidates-container');
            candidates.forEach(candidate => {
                const card = document.createElement('div');
                card.className = 'col-md-4';
                card.innerHTML = `
                    <div class="card mb-4">
                        <img src="images/${candidate.id}.jpg" class="card-img-top" alt="${candidate.nom}">
                        <div class="card-body">
                            <h5 class="card-title">${candidate.nom}</h5>
                            <p class="card-text">${candidate.twitter ? `<a href="${candidate.twitter}" target="_blank">Twitter</a>` : ''}</p>
                            <button class="btn btn-primary details-link" data-id="${candidate.id}">Voir la fiche</button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        $(document).ready(function(){
            // Appeler la fonction pour générer les cartes
            generateCandidateCards(candidates);

            // Charger les détails dans la modale
            $(document).on('click', '.details-link', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#details-container').load('fiches/' + id + '.php', function(response, status, xhr) {
                    if (status == "error") {
                        var msg = "Désolé, une erreur s'est produite: ";
                        $("#details-container").html(msg + xhr.status + " " + xhr.statusText);
                    } else {
                        $('#detailsModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>