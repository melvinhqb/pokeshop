<?php

// app/controllers/HomeController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;

use App\Models\SerieRepository;

class HomeController extends Controller
{
    // Méthode pour afficher la page d'accueil
    public function index()
    {
        $serieRepository = new SerieRepository();
        $serieRepository->conn = new DatabaseConnection();
        $series = $serieRepository->getAll();
    
        $this->view('home', [
            'series' => $series
        ]);
    }
}
