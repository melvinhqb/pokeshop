<?php

// app/controllers/SerieController.php

namespace App\Controllers\SerieController;

require_once('app/lib/database.php');
require_once('app/models/Serie.php');
require_once('app/models/Set.php');

use App\Lib\Database\DatabaseConnection;
use App\Models\Serie\SerieRepository;
use App\Models\Set\SetRepository;

class SerieController
{
    public function execute()
    {
        $serieRepository = new SerieRepository();
        $serieRepository->conn = new DatabaseConnection();
        $series = $serieRepository->getAll();
    
        require('views/home.php');
    }

    public function index()
    {
        $serieRepository = new SerieRepository();
        $serieRepository->conn = new DatabaseConnection();
        $series = $serieRepository->getAll();

        $setRepository = new SetRepository();
        $setRepository->conn = new DatabaseConnection();
        foreach ($series as $serie) {
            $serie->sets = $setRepository->getAllBySerieId($serie->id);
        }

        require('views/serie.php');
    }
}
?>
