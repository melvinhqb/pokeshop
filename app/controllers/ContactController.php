<?php

// app/controllers/HomeController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;

class ContactController extends Controller
{
    // Méthode pour afficher la page de contact
    public function index()
    {
        $this->view('contact');
    }
}
