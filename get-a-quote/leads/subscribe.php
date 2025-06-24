<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get email
    $email = isset($_POST['quote']['email']) ? htmlspecialchars(trim($_POST['quote']['email'])) : '';

    if ($email) {
        // Optional: save email to CSV
        $file = fopen("subscribers.csv", "a");
        fputcsv($file, [$email, date("Y-m-d H:i:s")]);
        fclose($file);

        // Send email to you
        $to = "info@amzvirtualassistant.com";
        $subject = "New Email Subscription";
        $body = "A new user subscribed with this email:\n\n$email";

        mail($to, $subject, $body);


        header("Location: /get-a-quote/leads/thank-you-subscribe.html");
        exit;
    } else {
        echo "Invalid email address.";
    }
} else {
    echo "Invalid request method.";
}
