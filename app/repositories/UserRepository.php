<?php

namespace App\Repositories;

use App\Models\User;
use App\Exceptions\NotFoundException;

class UserRepository extends Repository
{
    /**
     * Adds a new user to the database if the email does not already exist.
     *
     * @param string $name User's name.
     * @param string $email User's email.
     * @param string $password User's password (unhashed).
     * @return bool|int False if the email already exists, otherwise returns the new user's ID.
     */
    public function addNewUser(string $name, string $email, string $password): bool|int
    {
        if ($this->emailExists($email)) {
            return false; // Email already exists
        }

        return $this->insertUser($name, $email, $password);
    }

    /**
     * Checks if an email already exists in the database.
     *
     * @param string $email The email to check.
     * @return bool True if the email exists, false otherwise.
     */
    private function emailExists(string $email): bool
    {
        $sql = "SELECT COUNT(*) AS emailCount FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result['emailCount'] > 0;
    }

    /**
     * Inserts a new user into the database.
     *
     * @param string $name User's name.
     * @param string $email User's email.
     * @param string $password User's password (unhashed).
     * @return bool|int The new user's ID if successful, false otherwise.
     */
    private function insertUser(string $name, string $email, string $password): bool|int
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        if ($stmt->execute()) {
            $insertId = $this->conn->insert_id;
            $stmt->close();
            return $insertId;
        } else {
            $stmt->close();
            return false;
        }
    }

    /**
     * Verifies a user's credentials.
     *
     * @param string $email User's email.
     * @param string $password User's password.
     * @return User|null The User object if credentials are valid, null otherwise.
     */
    public function verifyUser(string $email, string $password): ?User
    {
        $sql = "SELECT id, name, email, password, isAdmin FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                return new User($row);
            }
        }
        return null;
    }
}
