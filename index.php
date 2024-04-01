<?php

// index.php

require_once('app/controllers/Controller.php');
require_once('app/controllers/HomeController.php');
require_once('app/controllers/SerieController.php');
require_once('app/controllers/CardController.php');
require_once('app/controllers/SetController.php');

use App\Controllers\Controller;
use App\Controllers\HomeController;
use App\Controllers\SerieController;
use App\Controllers\SetController;
use App\Controllers\CardController;

if (isset($_GET['route']) && $_GET['route'] !== '') {
    if ($_GET['route'] == 'products') {
        if (isset($_GET['card']) && $_GET['card'] !== '') {
            (new CardController)->show($_GET['card']);
        } else if (isset($_GET['set']) && $_GET['set'] !== '') {
            (new SetController)->show($_GET['set']);
        } else {
            (new SerieController)->index();
        }
    } else if ($_GET['route'] == 'contact') {
        // Page Formulaire de contact
        echo "<h1>Formulaire de contact à implémenter</h1>";
    } else if ($_GET['route'] == 'login') {
        // Page Formulaire de login
        echo "<h1>Formulaire de login à implémenter</h1>";
    } else {
        // Erreur 404
        exit;
    }
} else {
    (new HomeController())->index();
}
