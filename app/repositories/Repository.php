<?php

namespace App\Repositories;

use App\Lib\DatabaseConnection;

class Repository
{
    protected $conn;

    /**
     * Constructor that initializes the database connection from the singleton instance.
     * @throws \Exception If the database connection cannot be established.
     */
    public function __construct() {
        try {
            $this->conn = DatabaseConnection::getInstance()->connect();
            if ($this->conn === null) {
                throw new \Exception("Database connection could not be established.");
            }
        } catch (\Exception $e) {
            throw new \Exception("Failed to connect to the database: " . $e->getMessage());
        }
    }
}
