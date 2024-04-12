<?php

// app/lib/SMTPSettings.php

namespace App\Lib;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SMTPSettings
{
    public ?PHPMailer $mailer = null;

    public function getMailer(): PHPMailer
    {

        if ($this->mailer === null) {
            $this->mailer = new PHPMailer(true);
            
            try {
                // Configuration de PHPMailer pour l'envoi via SMTP
                $this->mailer->isSMTP();                                     // Utiliser SMTP
                $this->mailer->Host = $_ENV['SMTP_HOST'];                     // Utiliser l'hôte SMTP à partir des variables d'environnement
                $this->mailer->Port = $_ENV['SMTP_PORT'];                     // Utiliser le port SMTP à partir des variables d'environnement
                $this->mailer->SMTPAuth = true;                              // Activer l'authentification SMTP
                $this->mailer->Username = $_ENV['SMTP_USERNAME'];             // Utiliser l'adresse e-mail SMTP à partir des variables d'environnement
                $this->mailer->Password = $_ENV['SMTP_PASSWORD'];             // Utiliser le mot de passe SMTP à partir des variables d'environnement
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Activer le chiffrement TLS
                $this->mailer->CharSet = 'UTF-8';
                $this->mailer->isHTML(true);
            } catch (Exception $e) {
                die('Erreur de configuration du mailer: ' . $e->getMessage());
            }
        }

        return $this->mailer;
    }
}
