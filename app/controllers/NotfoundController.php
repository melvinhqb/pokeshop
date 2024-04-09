<?php

namespace App\Controllers;

class NotfoundController extends Controller
{
    public function notfound()
    {
        // Affiche la vue notfound.php
        $this->view('notfound');
    }
}
