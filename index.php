<?php

// Chargement des contrôleurs
require_once('app/controllers/Controller.php');
require_once('app/controllers/HomeController.php');
require_once('app/controllers/SerieController.php');
require_once('app/controllers/CardController.php');
require_once('app/controllers/SetController.php');
require_once('app/controllers/UserController.php');
require_once('app/controllers/NotfoundController.php');

// Utilisation des espaces de noms pour simplifier les références
use App\Controllers\HomeController;
use App\Controllers\SerieController;
use App\Controllers\SetController;
use App\Controllers\CardController;
use App\Controllers\UserController;
use App\Controllers\NotfoundController;

// Fonction principale de routage
function route($route) {
    switch ($route) {
        case 'notfound':
            handleNotfound();
        break;
        case 'products':
            handleProducts();
            break;
        case 'contact':
            echo "<h1>Formulaire de contact à implémenter</h1>";
            break;
        case 'login':
        case 'register':
        case 'logout':
            handleUserActions($route);
            break;
        case 'cart':
            echo "<h1>Page panier à implémenter</h1>";
            break;
        default:
            show404();
            break;
    }
}

// Gestion des routes produit
function handleProducts() {
    if (isset($_GET['card']) && $_GET['card'] !== '') {
        (new CardController())->show($_GET['card']);
    } else if (isset($_GET['set']) && $_GET['set'] !== '') {
        (new SetController())->show($_GET['set']);
    } else {
        (new SerieController())->index();
    }
}


function handleNotfound() {
    (new NotfoundController())->notfound();
}

// Gestion des actions utilisateur
function handleUserActions($action) {
    $userController = new UserController();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if ($action === 'login') {
            $userController->loginForm();
        } elseif ($action === 'register') {
            $userController->registerForm();
        } elseif ($action === 'logout') {
            $userController->logout();
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($action === 'login') {
            $userController->login();
        } elseif ($action === 'register') {
            $userController->register();
        }
    }
}

// Afficher une page 404
function show404() {
    http_response_code(404);
    echo "<h1>Page non trouvée</h1>";
    exit;
}

// Extraction et routage de la requête
$route = isset($_GET['route']) ? $_GET['route'] : '';
if (!empty($route)) {
    route($route);
} else {
    (new HomeController())->index();
}
