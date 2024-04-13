document.addEventListener('DOMContentLoaded', function(event) {
checkFilters();
});

let activeFilterKey;
let activeFilterValue;

document.addEventListener('click', function(event) {
    if (!event.target.matches('.select-items div')) return;
    const filterKey = event.target.parentNode.parentNode.id.replace('-options', '');
    const filterValue = event.target.getAttribute(`data-${filterKey}`);

    // Vérifie si le filtre actuel est déjà actif
    if (filterKey === activeFilterKey && filterValue === activeFilterValue) {
        // Enlever le filtre en réinitialisant les cartes et en mettant à jour l'URL
        resetCards();
        updateURL(filterKey, ''); // Passer la clé avec une valeur vide pour supprimer le filtre de l'URL
        activeFilterKey = null; // Réinitialiser les valeurs actives
        activeFilterValue = null;
    } else {
        // Appliquer le nouveau filtre et mettre à jour l'URL
        filterCards(`data-${filterKey}`, filterValue);
        updateURL(`data-${filterKey}`, filterValue);
        activeFilterKey = filterKey;
        activeFilterValue = filterValue;
    }
});

document.getElementById('price').addEventListener('input', function() {
    filterCards('data-price', this.value);
    updateURL('data-price', this.value);
    activeFilterKey = 'price'; // Assurez-vous de mettre à jour les clés actives
    activeFilterValue = this.value;
   
});

function resetCards() {
    const rows = document.querySelectorAll('.card-row');
    rows.forEach(row => row.style.display = ''); // Afficher toutes les cartes
}

function updateURL(key, value) {
    const params = new URLSearchParams(window.location.search);
    params.delete('data-rarity');
    params.delete('data-type');
    params.delete('data-price');
    if (value) {
        params.set(key, value); // Ajoute ou met à jour la paire clé-valeur
    } else {
        params.delete(key); // Supprime le filtre si la valeur est vide
    }
    window.history.pushState(null, '', `${window.location.pathname}?${params.toString()}`);
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



function filterCards(attribute, value) {
    const rows = document.querySelectorAll('.card-row');
    
    rows.forEach(row => {
        if (attribute === 'data-price') {
            // For price, we compare the value as a float
            const priceValue = parseFloat(row.getAttribute('data-price'));
            const maxPrice = parseFloat(value);
            if (priceValue <= maxPrice) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
            
        } else {
            // For rarity and type, we parse the JSON and check if it includes our value
            let cardValues = row.getAttribute(attribute);
            if (cardValues && cardValues.startsWith('[') && cardValues.endsWith(']')) {
                cardValues = JSON.parse(cardValues);
            }
            if (cardValues.includes(value)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}




  function checkFilters() {
    const searchParams = new URLSearchParams(window.location.search);
    ['rarity', 'type', 'price'].forEach(key => {
        if (searchParams.has(key)) {
            let value = searchParams.get(key);
            filterCards(`data-${key}`, value);
        } else {
            document.querySelectorAll(`.card-row[data-${key}]`).forEach(row => row.style.display = '');
        }
    });
}
