<?php

// app/controllers/HomeController.php

namespace App\Controllers;

use App\Repositories\SerieRepository;

class HomeController extends Controller
{
    // Méthode pour afficher la page d'accueil
    public function index()
    {
        $serieRepository = new SerieRepository();  // Serie hérite de Model, la connexion est gérée dans le modèle
        $series = $serieRepository->getAll();  // Récupération de toutes les séries
    
        $this->view('home', [
            'series' => $series  // Passage des données à la vue
        ]);
    }
}

