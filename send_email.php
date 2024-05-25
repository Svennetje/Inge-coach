<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = strip_tags(trim($_POST["naam"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $bericht = trim($_POST["bericht"]);

    if (empty($naam) || empty($bericht) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Er was een probleem met uw inzending. Vul het formulier correct in en probeer het opnieuw.";
        exit;
    }

    $recipient = "svenreeze2010@gmail.com";
    $subject = "Nieuw contactformulier bericht van $naam";

    $email_content = "Naam: $naam\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Bericht:\n$bericht\n";

    $email_headers = "From: $naam <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Bedankt! Uw bericht is verzonden.";
    } else {
        http_response_code(500);
        echo "Er is iets misgegaan en uw bericht kon niet worden verzonden.";
    }
} else {
    http_response_code(403);
    echo "Er was een probleem met uw inzending. Probeer het opnieuw.";
}
?>
