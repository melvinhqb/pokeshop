const gridViewIcon = document.getElementById("grid-icon");
const tableViewIcon = document.getElementById("table-icon");
const gridView = document.getElementById("grid-view");
const tableView = document.getElementById("table-view");



function toggleView(isGridView) {
  if (isGridView) {
    gridView.style.display = 'grid'; 
    tableView.style.display = 'none';
    gridViewIcon.classList.add('active');
    tableViewIcon.classList.remove('active');
  } else {
    gridView.style.display = 'none';
    tableView.style.display = 'table'; 
    tableViewIcon.classList.add('active');
    gridViewIcon.classList.remove('active');
  }
}


gridViewIcon.addEventListener('click', function() { toggleView(true); });
tableViewIcon.addEventListener('click', function() { toggleView(false); });
