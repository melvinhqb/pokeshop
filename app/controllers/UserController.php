<?php

// app/controllers/UserController.php

namespace App\Controllers;

use App\Repositories\UserRepository;

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
    
            $userRepository = new UserRepository();
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

            $userRepository = new UserRepository();
            $user = $userRepository->verifyUser($email, $password);

            if ($user !== null) {
                session_start();
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;
                $_SESSION['admin'] = $user->isAdmin;

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
        $currentPage = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        session_unset();
        session_destroy();

        header("Location: $currentPage");
        exit;
    }
}
