
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById('paymentForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        
        showCustomAlert('Votre paiement est réussi', function() {
            form.submit(); 
        });
    });
});

function showCustomAlert(message, callback) {
    var alertBox = document.getElementById('custom-alert');
    document.getElementById('custom-alert-text').textContent = message;
    
    var closeButton = alertBox.querySelector('.custom-alert-closebtn');
    
    alertBox.className = 'custom-alert-show';

    
    closeButton.onclick = function() {
        alertBox.className = 'custom-alert-hidden';
        callback(); 
    };

    
    window.onclick = function(event) {
        if (event.target === alertBox) {
            alertBox.className = 'custom-alert-hidden';
        }
    };
}