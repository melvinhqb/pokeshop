<?php

// app/models/Contact.php

namespace App\Models;

class Contact extends Model
{
    public string $dateContact;
    public string $lastName;
    public string $firstName;
    public string $email;
    public string $gender;
    public string $birthdate;
    public string $function;
    public string $subject;
    public string $content;
    public array $errors = [];

    public function __construct($row)
    {
        $this->dateContact = htmlspecialchars(date("Y-m-d H:i:s"));
        $this->setLastName($row['lastName']);
        $this->setFirstName($row['firstName']);
        $this->setEmail($row['email']);
        $this->setGender($row['gender'] ?? null);
        $this->setBirthdate($row['birthdate']);
        $this->setFunction($row['function']);
        $this->setSubject($row['subject']);
        $this->setContent($row['content']);
    }

    public function generateContactEmailHtml()
    {
        // Prepare the HTML message
        $htmlMessage = <<<HTML
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; }
                th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
            </style>
        </head>
        <body>
            <h2>Information de Contact</h2>
            <table>
                <tr><th>Date de Contact</th><td>{$this->dateContact}</td></tr>
                <tr><th>Nom</th><td>{$this->lastName}</td></tr>
                <tr><th>Prénom</th><td>{$this->firstName}</td></tr>
                <tr><th>Email</th><td>{$this->email}</td></tr>
                <tr><th>Genre</th><td>{$this->gender}</td></tr>
                <tr><th>Date de Naissance</th><td>{$this->birthdate}</td></tr>
                <tr><th>Fonction</th><td>{$this->function}</td></tr>
                <tr><th>Sujet</th><td>{$this->subject}</td></tr>
                <tr><th>Message</th><td>{$this->content}</td></tr>
            </table>
        </body>
        </html>
        HTML;

        return $htmlMessage;
    }

    private function setLastName($lastName) {
        if (empty($lastName)) {
            $this->errors['lastName'] = "Le nom de famille est requis.";
        } else {
            $this->lastName = htmlspecialchars($lastName);
        }
    }

    private function setFirstName($firstName) {
        if (empty($firstName)) {
            $this->errors['firstName'] = "Le prénom est requis.";
        } else {
            $this->firstName = htmlspecialchars($firstName);
        }
    }

    private function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "L'email est invalide.";
        } else {
            $this->email = htmlspecialchars($email);
        }
    }

    private function setGender($gender)
    {
        $validGenders = ['male', 'female'];
        if (in_array($gender, $validGenders)) {
            $this->gender = htmlspecialchars($gender);
        } else {
            $this->errors['gender'] = "Le genre est requis.";
        }
    }

    private function setBirthdate($date)
    {
        if (empty($date)) {
            $this->errors['birthdate'] = "La date de naissance est requise.";
            return;
        }

        $inputDate = \DateTime::createFromFormat('Y-m-d', $date);

        if (!$inputDate || $inputDate->format('Y-m-d') !== $date) {
            $this->errors['birthdate'] = "La date de naissance n'est pas valide ou mal formatée.";
            return;
        }

        $today = new \DateTime();
        $today->setTime(0, 0, 0);

        if ($inputDate >= $today) {
            $this->errors['birthdate'] = "La date de naissance doit être antérieure à la date actuelle.";
        } else {
            $this->birthdate = $inputDate->format('Y-m-d');
        }
    }

    private function setFunction($function)
    {
        $this->function = htmlspecialchars($function ?? 'undefined');
    }

    private function setSubject($subject)
    {
        if (empty($subject)) {
            $this->errors['subject'] = "Le sujet est requis.";
        } else {
            $this->subject = htmlspecialchars($subject);
        }
    }

    private function setContent($content)
    {
        if (empty($content)) {
            $this->errors['content'] = "Le contenu du message ne peut pas être vide.";
        } else {
            $this->content = nl2br(htmlspecialchars($content, ENT_QUOTES, 'UTF-8'));
        }
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

}