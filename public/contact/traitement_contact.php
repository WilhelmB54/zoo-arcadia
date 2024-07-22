<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if ($email) {
        $to = "employe@zoo-arcadia.com";
        $subject = "Contact depuis le site web : " . $titre;
        $message = "Description : " . $description . "\n\nEmail : " . $email;
        $headers = "From: " . $email . "\r\n" .
                   "Reply-To: " . $email . "\r\n" .
                   "Content-Type: text/plain; charset=UTF-8";

        if (mail($to, $subject, $message, $headers)) {
            header('Location: ../contact.php?success=1');
        } else {
            header('Location: ../contact.php?error=1');
        }
    } else {
        header('Location: ../contact.php?error=2');
    }
} else {
    header('Location: ../contact.php');
}
