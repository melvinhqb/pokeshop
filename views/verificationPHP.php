<?php
$servername = "localhost";
$username = "nom_d_utilisateur";
$password = "mot_de_passe";
$dbname = "nom_de_donnees";

// Connexion à la base de données MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $dateContact = $_POST['dateContact'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $function = $_POST['function'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    
    $erreurs = [];

    
    if (empty($dateContact)) {
        $erreurs['dateContact'] = "La date de contact est requise.";
    }
    if (empty($lastName)) {
        $erreurs['lastName'] = "Le nom de famille est requis.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'email est invalide.";
    }

    if (!validerDate($birthdate)) {
        $erreurs['birthdate'] = "La date de naissance n'est pas valide.";
    }

    if (empty($subject)) {
        $erreurs['subject'] = "Le sujet est requis.";
    }

    if (empty($content)) {
        $erreurs['content'] = "Le contenu du message ne peut pas être vide.";
    
    // Insertion des données dans la base de données si aucune erreur n'est trouvée
    if (count($erreurs) === 0) {
       
        $stmt = $conn->prepare("INSERT INTO contacts (dateContact, lastName, firstName, email, gender, birthdate, function, subject, content) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $dateContact, $lastName, $firstName, $email, $gender, $birthdate, $function, $subject, $content); //chaque s correspond à une variable, et signifie que cette variable doit être traitée comme une chaîne de caractères (string).

    
        if ($stmt->execute()) {
            // Envoi de l'email au webmaster
            $to = 'webmaster@example.com'; // Remplacez par l'adresse email
            $headers = "From: $email" . "\r\n" .
                        "Reply-To: $email" . "\r\n" .
                        "X-Mailer: PHP/" . phpversion();
            $email_subject = "Nouveau message de formulaire de contact";
            $email_body = "Vous avez reçu un nouveau message. Voici les détails:\n" .
                          "Nom: $lastName\nPrénom: $firstName\nEmail: $email\n" .
                          "Date de naissance: $birthdate\nFonction: $function\nSujet: $subject\nContenu: $content";

            mail($to, $email_subject, $email_body, $headers);

            echo "Merci, vos informations ont été soumises avec succès.";
        } else {
            echo "Erreur lors de l'insertion des données : " . $stmt->error;
        }

        
        $stmt->close();
    } else {
        // Affichage des erreurs de validation
        foreach ($erreurs as $champ => $erreur) {
            echo "Erreur dans le champ $champ : $erreur\n";
        }
    }
}


$conn->close();
?>
