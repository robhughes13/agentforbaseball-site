<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recipient email
    $to = "mkrzem5601@yahoo.com";
    $subject = "New Contact Form Submission from Agentforbaseball.com";

    // Sanitize form inputs
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email = htmlspecialchars(strip_tags(trim($_POST["email"])));
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

    // Validate required fields
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Email content
        $email_body = "You received a new message from your contact form:\n\n";
        $email_body .= "Name: $name\n";
        $email_body .= "Email: $email\n";
        $email_body .= "Message:\n$message\n";

        // Headers
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Send the email
        if (mail($to, $subject, $email_body, $headers)) {
            echo "<h2 style='font-family: sans-serif;'>Thank you! Your message has been sent.</h2>";
        } else {
            echo "<h2 style='font-family: sans-serif; color: red;'>Oops! Something went wrong. Try again later.</h2>";
        }

    } else {
        echo "<h2 style='font-family: sans-serif; color: red;'>Please fill out all required fields correctly.</h2>";
    }
} else {
    // Direct access without POST
    header("Location: index.html");
    exit;
}
?>
