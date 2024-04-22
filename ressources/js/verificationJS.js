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
        e.preventDefault();

        function markInvalidField(field, errorMsg="Ce champ est requis ou mal rempli.") {
            field.style.borderColor = 'red';
            var errorDiv = document.createElement('div');
            errorDiv.className = 'error-field';
            errorDiv.textContent = errorMsg;
            field.parentElement.insertBefore(errorDiv, field.nextSibling);
            isFormValid = false;
        }

        // Réinitialiser l'état visuel de validation de tous les champs
        var fieldsToValidate = form.querySelectorAll('input, textarea, select');
        fieldsToValidate.forEach(function(field) {
            field.style.borderColor = ''; // Réinitialisez le style
        });
        var genderRadioGroup = document.querySelectorAll('input[name="gender"]');
        genderRadioGroup.forEach(function(input) {
            input.parentElement.style.color = '';
        });

        // Effacer tous les messages d'erreur précédents
        var errorMessages = form.querySelectorAll('.error-field');
        errorMessages.forEach(function(message) {
            message.remove();
        });

        var isFormValid = true;

        // Obtenir les valeurs des champs du formulaire
        var dateContact = document.getElementById('dateContact');
        var lastName = document.getElementById('lastName');
        var firstName = document.getElementById('firstName');
        var email = document.getElementById('email');
        var gender = document.querySelector('input[name="gender"]:checked');
        var birthdate = document.getElementById('birthdate');
        var userFunction = document.getElementById('function');
        var subject = document.getElementById('subject');
        var content = document.getElementById('content');

        // Vérifiez si les champs sont remplis correctement
        if (!dateContact.value.trim()) markInvalidField(dateContact);
        if (!lastName.value.trim()) markInvalidField(lastName, "Le nom de famille est requis.");
        if (!firstName.value.trim()) markInvalidField(firstName, "Le prénom est requis.");
        if (!email.value.trim() || !email.value.includes('@')) markInvalidField(email, "L'email est invalide.");
        if (!birthdate.value.trim()) markInvalidField(birthdate, "Une date antérieure à la date actuelle est requise.");
        if (!userFunction.value.trim()) markInvalidField(userFunction, "Une fonction est requise.");
        if (!subject.value.trim()) markInvalidField(subject, "Le sujet est requis");
        if (!content.value.trim()) markInvalidField(content, "Le contenu du message ne peut pas être vide.");
        if (!gender) { 
            var genderRadioGroup = document.querySelectorAll('input[name="gender"]');
        
            genderRadioGroup.forEach(function(input) {
                input.parentElement.style.color = 'red';
            });
        
            var errorDiv = document.createElement('div');
            errorDiv.className = 'error-field';
            errorDiv.textContent = 'Le genre est requis.';
        
            var lastRadio = genderRadioGroup[genderRadioGroup.length - 1];
            lastRadio.parentElement.appendChild(errorDiv);
        
            isFormValid = false;
        }

        if (isFormValid) {
            if (confirm("Voulez-vous vraiment soumettre le formulaire ?")) {
                this.submit();
            } else {
                alert("Envoi annulé.");
            }
        }
    });
});


  