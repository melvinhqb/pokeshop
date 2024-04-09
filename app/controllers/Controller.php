<?php

// app/controllers/Controller.php

namespace App\Controllers;

require_once 'app/models/Serie.php';
require_once 'app/models/Set.php';
require_once 'app/models/Card.php';
require_once 'app/models/User.php';

class Controller
{
    // Affiche une vue avec des données.
    public function view($view, $data = [])
    {
        extract($data);
        require_once 'views/' . $view . '.php';
    }

    public function pageNotFound($errorMessage = "Page Not Found")
    {
        $this->view('notfound', ["errorMessage" => $errorMessage]);
    }
}
