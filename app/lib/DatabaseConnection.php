<?php

// app/lib/database.php

namespace App\Lib;

use mysqli;

class DatabaseConnection
{
    private static ?DatabaseConnection $instance = null;
    private ?mysqli $connection = null;

    private function __construct() {
        $this->connect();
    }

    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function connect(): mysqli
    {
        if ($this->connection === null) {
            $servername = $_ENV['DB_HOST'];
            $username = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASSWORD'];
            $dbname = $_ENV['DB_NAME'];

            // Création d'une nouvelle connexion MySQLi
            $this->connection = new mysqli($servername, $username, $password, $dbname);

            // Vérification des erreurs de connexion
            if ($this->connection->connect_error) {
                // Il est préférable de gérer l'erreur plutôt que de terminer le script
                throw new \Exception('Échec de la connexion à la base de données: ' . $this->connection->connect_error);
            }
        }

        return $this->connection;
    }
}
