<?php

// app/controllers/ContactController.php

namespace App\Controllers;

use App\Models\Contact;
use App\Lib\SMTPSettings;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    // Méthode
    public function contactForm()
    {
        $this->view('contact');
    }

    public function sendMail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $contact = new Contact($_POST);

            // Validation des données ici
            if ($contact->hasErrors()) {
                $this->view('contact', ['errors' => $contact->getErrors(), 'contact' => $contact]);
                exit;
            }

            $mail = (new SMTPSettings())->getMailer();
            
            try {
                $mail->setFrom($contact->email, "Pokeshop - Formulaire de contact");
                $mail->addAddress($_ENV['ADMIN_EMAIL']); // Remplacer par votre adresse email
                $mail->Subject = $contact->subject;
                $mail->Body = $contact->generateContactEmailHtml();
                $mail->send();
                header('Location: index.php');
            } catch(Exception $e) {
                $this->view('contact', ['error' => $e->getMessage()]);
            }

        } else {
            $this->contactForm();
        }
    }
}
