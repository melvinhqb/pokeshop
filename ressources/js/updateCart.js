function deleteToCart(event) {
    // Empêcher le formulaire de se soumettre normalement
    event.preventDefault();

    // Récupérer le formulaire soumis
    var form = event.target;

    // Récupérer les données du formulaire
    var formData = new FormData(form);

    // Envoyer les données du formulaire via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?route=cart', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Gérer la réponse réussie
            // Identifier la ligne du tableau correspondant à la carte supprimée
            var cardId = formData.get('card_id');
            var tableRow = document.getElementById('row_' + cardId);

            // Supprimer la ligne du tableau
            if (tableRow) {
                setTimeout(function(){ //
                location.reload(); //a changer si jamais compris reload que la partie pagner
            }, 1000); //
            
                tableRow.parentNode.removeChild(tableRow);
                showCustomAlert("la carte a bien été supprimée");
                
            }

            
        } else {
            // Gérer l'erreur
            showCustomAlert('Error: ' + xhr.statusText);
        }
    };
    xhr.onerror = function () {
        // Gérer l'erreur de connexion
        showCustomAlert('Network Error');
    };
    xhr.send(formData);
}

function modifyCart(event) {
    // Empêcher le formulaire de se soumettre normalement
    event.preventDefault();

    // Récupérer le formulaire soumis
    var form = event.target;

    // Récupérer les données du formulaire
    var formData = new FormData(form);

    // Envoyer les données du formulaire via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?route=cart', true);  // Notez le changement de l'URL pour la mise à jour
    // Inside the modifyCart function
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Gérer la réponse réussie
            // Mettre à jour l'interface utilisateur pour refléter les modifications
            var cardId = formData.get('card_id');
            var newQuantity = formData.get('quantity');
            
            var quantityElement = document.getElementById('quantity_' + cardId);
            if (quantityElement) {
                quantityElement.value = newQuantity; // Mise à jour de l'élément de quantité
            }
             
        } else {
            // Gérer l'erreur
            showCustomAlert('Error: ' + xhr.statusText);
        }
    };

    xhr.onerror = function () {
        // Gérer l'erreur de connexion
        showCustomAlert('Network Error');
    };
    xhr.send(formData);
}