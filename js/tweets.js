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