<?php

require_once __DIR__ . '/vendor/autoload.php';

// Utilisation des espaces de noms pour simplifier les références
use App\Controllers\Controller;
use App\Controllers\HomeController;
use App\Controllers\SerieController;
use App\Controllers\SetController;
use App\Controllers\CardController;
use App\Controllers\UserController;
use App\Controllers\ContactController;
use Dotenv\Dotenv;

// Fonction principale de routage
function route($route) {
    switch ($route) {
        case 'products':
            handleProducts();
            break;
        case 'contact':
            handleContact();
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
            handleNotFound();
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

function handleContact() {
    $contactController = new ContactController();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $contactController->contactForm();
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contactController->sendMail();
    }
}


function handleNotFound() {
    (new Controller())->pageNotFound();
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

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Extraction et routage de la requête
$route = isset($_GET['route']) ? $_GET['route'] : '';
if (!empty($route)) {
    route($route);
} else {
    (new HomeController())->index();
}
