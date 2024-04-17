window.addEventListener('pageshow', function() {
    // Sélectionner tous les champs de quantité et les boutons de diminution associés
    var quantityInputs = document.querySelectorAll('.quantity-input #quantity');

    quantityInputs.forEach(function(input) {
        var decreaseButton = quantityInputs.parentNode.querySelector('.quantity-change-btn minus disabled');
        var quantity = parseInt(input.value);

        // Réinitialiser la valeur de l'input basé sur son attribut 'value' si nécessaire
        input.value = input.getAttribute('value');

        // Réajuster l'état du bouton de diminution
        if (quantity > 1) {
            decreaseButton.className= ('.quantity-change-btn minus');
        } else {
            decreaseButton.className= ('.quantity-change-btn minus disabled');
        }
    });
});

function increaseQuantity(button) {
    var quantityInput = button.parentNode.querySelector('#quantity');
    var stock = parseInt(quantityInput.max);
    var quantity = parseInt(quantityInput.value);
    var decreaseButton = button.parentNode.querySelector('.quantity-change-btn.minus');
    var stockMessage = button.parentNode.parentNode.querySelector('.stock-message');

    if (quantity < stock) {
        quantityInput.value = quantity + 1;
        decreaseButton.classList.remove('disabled');
    }
    else {
        displayStockMessage(stock, stockMessage);

        quantityInput.parentNode.querySelector('.quantity-change-btn').onclick = function(){
        quantityInput.parentNode.style.borderColor = '#ccc';
        decreaseQuantity(button);
        button.parentNode.parentNode.querySelector('.stock-message').className = 'stock-message error-message-hidden';
    }
}
}
function decreaseQuantity(button) {
    var quantityInput = button.parentNode.querySelector('#quantity');
    var quantity = parseInt(quantityInput.value);
    var decreaseButton = button.parentNode.querySelector('.quantity-change-btn.minus');

    if (quantity > 1) {
        quantityInput.value = quantity - 1;
        decreaseButton.classList.remove('disabled');
        if (quantity - 1 === 1) {
            decreaseButton.classList.add('disabled');
        }
    }
    else{
        decreaseButton.classList.add('disabled');
    }
}

function displayStockMessage(stock, stockMessageContainer) {
    
    stockMessageContainer.textContent = "Le stock est limité à " + stock;
    stockMessageContainer.className = 'stock-message error-message-shown';
    var quantityContainer = stockMessageContainer.parentNode.parentNode.querySelector('.quantity-input');

    quantityContainer.style.borderColor = 'red';
    setTimeout(function() {
        stockMessageContainer.className = 'stock-message error-message-hidden';
        quantityContainer.style.borderColor = '#ccc';
    }, 3000);
    

}


  



