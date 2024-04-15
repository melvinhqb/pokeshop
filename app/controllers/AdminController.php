<?php

// app/controllers/AdminController.php

namespace App\Controllers;

class AdminController extends Controller
{
    public function __construct() {
        if (!isset($_SESSION["admin"]) || $_SESSION["admin"] === false) {
            header("Location: index.php?route=profile&action=login");
        }
    }

    public function dashboard() {
        echo "<h1>Dashboard</h1>";
        //$this->view("admin/dashboard");
    }
}