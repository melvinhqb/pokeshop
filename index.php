<?php

require_once('app/controllers/SerieController.php');
require_once('app/controllers/CardController.php');
require_once('app/controllers/SetController.php');

use App\Controllers\SerieController\SerieController;
use App\Controllers\CardController\CardController;
use App\Controllers\SetController\SetController;

if (isset($_GET['route']) && $_GET['route'] !== '') {
    if ($_GET['route'] == 'products') {
        if (isset($_GET['card']) && $_GET['card'] !== '') {
            (new CardController)->index($_GET['card']);
        } else if (isset($_GET['set']) && $_GET['set'] !== '') {
            (new SetController)->index($_GET['set']);
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
    (new SerieController())->execute();
}
