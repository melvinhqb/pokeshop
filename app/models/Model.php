<?php

namespace App\Models;

use App\Lib\DatabaseConnection;

class Model
{
    protected $conn;

    public function __construct() {
        // Obtenez l'instance de la connexion à la base de données à partir du singleton
        $this->conn = DatabaseConnection::getInstance()->connect();
    }
}

