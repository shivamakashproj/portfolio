<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form inputs
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: index.html?status=error#contact");
        exit;
    }

    // Recipient email (Replace with your actual email if needed)
    $to = "shivamakashpvt@gmail.com";
    
    // Subject of the email
    $subject = "New Contact Form Message from Portfolio: $name";

    // Email Body
    $body = "You have received a new message from your portfolio contact form.\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    // Headers
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect back with success flag
        header("Location: index.html?status=success#contact");
        exit;
    } else {
        // Redirect back with error flag
        header("Location: index.html?status=error#contact");
        exit;
    }
} else {
    // If accessed directly without POST, redirect home
    header("Location: index.html");
    exit;
}
?>
