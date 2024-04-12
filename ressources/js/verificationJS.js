document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById('monFormulaire');

    // Automatically apply styles based on data-error attributes when the page loads
    var errorFields = form.querySelectorAll('[data-error="true"]');
    errorFields.forEach(function(field) {
        if (field.type !== 'radio') {
            field.style.borderColor = 'red'; // Apply red border to fields except radio buttons
        } else {
            // Special handling for radio buttons: mark the parent element
            var radioGroup = document.querySelectorAll('input[name="' + field.name + '"]');
            radioGroup.forEach(function(radio) {
                radio.parentElement.style.color = 'red'; // Color the label or parent element
            });
        }
    });
    
    form.addEventListener('submit', function(e) {
        if (confirm("Voulez-vous vraiment soumettre le formulaire ?")) {
            // If the user confirmed, submit the form
            this.submit();
        } else {
            // If the user canceled, do nothing
            alert("Envoi annulé.");
        }
    });
});


  