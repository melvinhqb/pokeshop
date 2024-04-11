document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById('monFormulaire');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); 

        var isFormValid = true; 

        
        function markInvalidField(field) {
            field.style.borderColor = 'red';
            isFormValid = false; 
        }

         // Réinitialiser l'état visuel de validation de tous les champs
         var fieldsToValidate = form.querySelectorAll('input[type="text"], input[type="email"], select, textarea');
         fieldsToValidate.forEach(function(field) {
             field.style.borderColor = ''; // Réinitialisez le style
         });
 
         
         var genderInputs = document.querySelectorAll('input[name="gender"]');
         var genderLabel = document.querySelector('label[for="gender"]'); 
 
         // Réinitialiser l'état visuel pour le groupe de boutons radio "Genre"
         genderInputs.forEach(function(input) {
             
             input.parentElement.style.color = '';
         });

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

        // Vérifie si les champs sont remplis correctement
        if (!dateContact.value.trim()) markInvalidField(dateContact);
        if (!lastName.value.trim()) markInvalidField(lastName);
        if (!firstName.value.trim()) markInvalidField(firstName);
        if (!email.value.trim() || !email.value.includes('@')) markInvalidField(email);
        if (!gender) { 
            genderInputs.forEach(function(input) {
                input.parentElement.style.color = 'red'; 
                isFormValid = false;
            });
        }
        if (!birthdate.value.trim()) markInvalidField(birthdate);
        if (!userFunction.value.trim()) markInvalidField(userFunction);
        if (!subject.value.trim()) markInvalidField(subject);
        if (!content.value.trim()) markInvalidField(content);

        // Si toutes les validations sont passées, le formulaire peut être soumis
        if (isFormValid) {
            alert("Formulaire prêt à être soumis.");
            form.submit(); 
        }
    });
});


  