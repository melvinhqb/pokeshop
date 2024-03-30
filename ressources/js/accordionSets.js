// ressources/js/accordionSets.js

window.addEventListener('DOMContentLoaded', function() {
    // Vérifier l'URL actuelle lors du chargement de la page
    checkURL();

    // Écouter les changements d'URL
    window.addEventListener('popstate', function() {
        checkURL();
    });
});

function checkURL() {
    var urlParams = new URLSearchParams(window.location.search);
    var serieParam = urlParams.get('serie');

    if (serieParam) {
        var series = document.getElementById(serieParam);
        if (series) {
            closeAllSets(); // Ferme toutes les sets ouvertes
            toggleSets(serieParam); // Ouvre la série correspondante
        }
    }
}

function toggleSets(seriesId) {
    var sets = document.getElementById(seriesId + '-sets');
    var arrow = document.querySelector('#' + seriesId + ' .arrow');
    if (sets.style.display === 'none' || sets.classList.contains('hidden')) {
        sets.style.display = 'flex';
        sets.classList.remove('hidden');
        arrow.classList.add('open');
    } else {
        sets.style.display = 'none';
        sets.classList.add('hidden');
        arrow.classList.remove('open');
    }
}

function closeAllSets() {
    var allSets = document.querySelectorAll('.sets');
    allSets.forEach(function(set) {
        set.style.display = 'none';
        set.classList.add('hidden');
    });
}
