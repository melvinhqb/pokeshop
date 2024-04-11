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

window.addEventListener('DOMContentLoaded', function() {
    // Attacher l'événement de clic aux éléments de filtre
    attachFilterEvents();
});

function attachFilterEvents() {
    // Sélectionner tous les éléments de filtre et attacher un gestionnaire de clic pour chacun
    var filterOptions = document.querySelectorAll('.filter-option');
    filterOptions.forEach(function(option) {
        var header = option.querySelector('.filter-name');
        header.addEventListener('click', function() {
            toggleFilter(option.id);
        });
    });
}

function toggleFilter(filterId) {
    // Identifier le contenu de filtre et la flèche à basculer
    var content = document.getElementById(filterId + "-options");
    var arrow = document.querySelector('#' + filterId + ' .arrow');

    // Basculer l'affichage du contenu de filtre et la rotation de la flèche
    if (content.classList.contains('hidden')) {
        // Ouvrir le filtre sélectionné et fermer tous les autres
        closeAllFilters();
        content.classList.remove('hidden');
        content.style.display = 'block'; // ou 'flex', selon votre mise en page
        arrow.classList.add('open');
    } else {
        content.classList.add('hidden');
        content.style.display = 'none';
        arrow.classList.remove('open');
    }
}

function closeAllFilters() {
    // Fermer tous les filtres
    var allContents = document.querySelectorAll('.filter-content');
    var allArrows = document.querySelectorAll('.filter-option .arrow');

    allContents.forEach(function(content) {
        content.style.display = 'none';
        content.classList.add('hidden');
    });

    allArrows.forEach(function(arrow) {
        arrow.classList.remove('open');
    });
}

