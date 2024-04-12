<?php

// app/controllers/Controller.php

namespace App\Controllers;

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
