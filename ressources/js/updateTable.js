function updateTable(responseData) {
    // Mettre à jour le contenu du tableau avec les nouvelles données
    // Par exemple, vous pouvez remplacer le contenu du tableau avec celui reçu du serveur
    var tableContainer = document.getElementById('tableContainer');
    tableContainer.innerHTML = responseData;
}