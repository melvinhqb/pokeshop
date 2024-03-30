// ressources/js/imageZoomModal.js

$(document).ready(function(){
    // Lorsque vous cliquez sur une image, affichez la version agrandie dans une fenêtre modale
    $('.card_image').click(function(){
        var imgSrc = $(this).attr('src');
        var zoomedImage = $('<img>').attr('src', imgSrc);
        var modalContent = $('<div>').addClass('modal-content').append(zoomedImage);
        var modalDialog = $('<div>').addClass('modal-dialog').append(modalContent);
        var modal = $('<div>').addClass('modal').append(modalDialog);
        $('body').append(modal);
        $('.modal').click(function(){
            $(this).remove();
        });
    });
});
