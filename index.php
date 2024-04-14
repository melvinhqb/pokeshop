<?php

require_once __DIR__ . '/vendor/autoload.php';

// Utilisation des espaces de noms pour simplifier les références
use App\Controllers\Controller;
use App\Controllers\HomeController;
use App\Controllers\SerieController;
use App\Controllers\SetController;
use App\Controllers\CardController;
use App\Controllers\CartController;
use App\Controllers\UserController;
use App\Controllers\ContactController;
use App\Controllers\AdminController;
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
        case 'profile':
            handleProfile();
            break;
        case 'cart':
            handleCart();
            break;
        case 'payment':
            handlePayment();
            break;
        case 'admin':
            handleAdmin();
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


function handleCart() {
    $cartController = new CartController();
    $action = $_GET['action'] ?? '';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $cartController->show();
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && $_POST['action'] == 'deleteFromCart') {
            $cartController->deleteAll(); // Supprime tous les articles du panier
        } else {
            $cartController->addToCart(); // Ajoute un article au panier
        }
    }
}


function handleNotFound() {
    (new Controller())->pageNotFound();
}

// Gestion des actions de profil
function handleProfile() {
    $userController = new UserController();
    $action = $_GET['action'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        switch ($action) {
            case 'login':
                $userController->loginForm();
                break;
            case 'register':
                $userController->registerForm();
                break;
            case 'logout':
                $userController->logout();
                break;
            default:
                handleNotFound();
                break;
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        switch ($action) {
            case 'login':
                $userController->login();
                break;
            case 'register':
                $userController->register();
                break;
            default:
                handleNotFound();
                break;
        }
    }
}

function handlePayment() {
    $cartController = new CartController();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $cartController->paymentForm();
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cartController->processPayment();
    }
}

function handleAdmin() {
    $adminController = new AdminController();
    $adminController->dashboard();
}

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

// Extraction et routage de la requête
$route = isset($_GET['route']) ? $_GET['route'] : '';
if (!empty($route)) {
    route($route);
} else {
    (new HomeController())->index();
}
