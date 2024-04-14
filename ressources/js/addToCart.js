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
            alert("La carte a été ajouté à votre panier");
        } else {
            // Gérer l'erreur
            alert('Error: ' + xhr.statusText);
        }
    };
    xhr.onerror = function () {
        // Gérer l'erreur de connexion
        alert('Network Error');
    };
    xhr.send(formData);
}