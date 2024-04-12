<?php

// app/controllers/CardController.php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Lib\DatabaseConnection;
use App\Exceptions\NotFoundException;

use App\Models\SerieRepository;
use App\Models\CardRepository;

class CartController extends Controller
{
    // Méthode pour afficher les détails d'une carte
    public function show() {
        try {
            $serieRepository = new SerieRepository();
            $serieRepository->conn = new DatabaseConnection();
            $series = $serieRepository->getAll();
        
            $this->view('cart', ['series' => $series]);
        } catch (\Exception $e) {
            $this->pageNotFound($e->getMessage());
        }
    }
}
