<?php

// app/models/User.php

namespace App\Models;

use App\Exceptions\NotFoundException;
use App\Lib\DatabaseConnection;

class User extends Model
{
    public string $id;
    public string $name;
    public string $email;
    public string $password; // Le mot de passe est stocké sous forme hashée
    public bool $isAdmin;

    // Méthode pour ajouter un nouvel utilisateur
    public function addNewUser(string $name, string $email, string $password): bool|int
    {
        // Vérifier d'abord si l'email existe déjà
        $emailCheckSql = "SELECT COUNT(*) AS emailCount FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($emailCheckSql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $emailCheckResult = $stmt->get_result()->fetch_assoc();
        if ($emailCheckResult['emailCount'] > 0) {
            return false; // Retourne false si l'email existe déjà
        }

        // Insère le nouvel utilisateur si l'email n'existe pas.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        if ($stmt->execute()) {
            return $this->conn->insert_id; // Retourne l'ID de l'utilisateur inséré
        } else {
            return false; // Retourne false en cas d'échec de l'insertion
        }
    }

    // Méthode pour vérifier les identifiants d'un utilisateur
    public function verifyUser(string $email, string $password): ?User
    {
        // Recherche l'utilisateur par email.
        $sql = "SELECT id, name, email, password, isAdmin FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Vérifie le mot de passe hashé si un utilisateur est trouvé.
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                return $this->createUserFromRow($row); // Retourne l'objet User si les identifiants sont valides.
            }
        }
        return null; // Retourne null si utilisateur non trouvé ou mot de passe incorrect
    }

    // Méthode utilitaire pour créer un objet User à partir d'une ligne de résultat SQL
    private function createUserFromRow(array $row): User
    {
        $user = new User();
        $user->id = $row['id'];
        $user->name = $row['name'];
        $user->email = $row['email'];
        $user->password = $row['password']; // Le mot de passe stocké est déjà hashé
        $user->isAdmin = $row['isAdmin'];
        return $user;
    }
}