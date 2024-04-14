<?php

// app/controllers/UserController.php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{
    // Méthode pour afficher le formulaire d'inscription
    public function registerForm()
    {
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }
        $this->view('profile/register');
    }

    // Méthode pour afficher et traiter le formulaire d'inscription
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            $userRepository = new User();
            $userId = $userRepository->addNewUser($name, $email, $password);
    
            if ($userId) {
                session_start();
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_name'] = $name;
    
                header('Location: index.php');
                exit;
            } else {
                $error = "Cet email est déjà utilisé";
            }
        }
    
        $this->view('profile/register', ['error' => $error]);
    }

    // Méthode pour afficher le formulaire de connexion
    public function loginForm()
    {
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }
        $this->view('profile/login');
    }

    // Méthode pour afficher et traiter le formulaire de connexion
    public function login()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userRepository = new User();
            $user = $userRepository->verifyUser($email, $password);

            if ($user !== null) {
                session_start();
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;

                header('Location: index.php');
                exit;
            } else {
                $error = 'Email ou mot de passe incorrect';
            }
        }

        $this->view('profile/login', ['error' => $error]);
    }

    // Méthode pour déconnecter l'utilisateur
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: index.php');
        exit;
    }
}
