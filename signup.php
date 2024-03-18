<?php
// Connectez-vous à la base de données
$db = new mysqli('your_host', 'your_username', 'your_password', 'your_database');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachez le mot de passe pour la sécurité
$email = $_POST['email'];

// Vérifiez si l'utilisateur existe déjà
$checkUser = $db->prepare("SELECT * FROM users WHERE username=? OR email=?");
$checkUser->bind_param("ss", $username, $email);
$checkUser->execute();

if ($checkUser->get_result()->num_rows > 0) {
    echo "Username or Email already exists.";
} else {
    // Insérez le nouvel utilisateur dans la base de données
    $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$db->close();
?>
