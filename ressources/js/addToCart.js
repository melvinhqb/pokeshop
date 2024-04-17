function addToCart(event) {
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
            showCustomAlert("La carte a été ajouté à votre panier");
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


function showCustomAlert(message) {
    var alertBox = document.getElementById('custom-alert');
    document.getElementById('custom-alert-text').textContent = message;

    // Determine the active view by checking which icon has the 'active' class
    var activeIcon = document.querySelector('.icon.active');
    var targetView = activeIcon.id === 'grid-icon' ? document.getElementById('grid-view') : document.getElementById('table-view');

    // Append the alert box to the active view container
    targetView.appendChild(alertBox);

    // Show the alert box
    alertBox.className = 'custom-alert-show';
    // Fermer le popup sur le bouton de fermeture
    alertBox.querySelector('.custom-alert-closebtn').onclick = function() {
        alertBox.className = 'custom-alert-hidden';
        
    };

    // Fermer le popup si l'utilisateur clique à l'extérieur
    window.onclick = function(event) {
        if (event.target === alertBox) {
            alertBox.className = 'custom-alert-hidden';
        }
    };
}
