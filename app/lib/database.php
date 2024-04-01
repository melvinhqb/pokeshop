<?php

// app/lib/database.php

namespace App\Lib;

class DatabaseConnection
{
    public ?\mysqli $connection = null;

    public function connect(): \mysqli
    {
        if ($this->connection === null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "pokeshop_v2";

            // Création d'une nouvelle connexion MySQLi
            $this->connection = new \mysqli($servername, $username, $password, $dbname);

            // Vérification des erreurs de connexion
            if ($this->connection->connect_error) {
                die('Échec de la connexion à la base de données: ' . $this->connection->connect_error);
            }
        }

        return $this->connection;
    }
}
