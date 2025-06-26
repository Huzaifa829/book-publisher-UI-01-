<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['quote']['name']) ? htmlspecialchars(trim($_POST['quote']['name'])) : '';
    $email = isset($_POST['quote']['email']) ? htmlspecialchars(trim($_POST['quote']['email'])) : '';
    $phone = isset($_POST['quote']['phone']) ? htmlspecialchars(trim($_POST['quote']['phone'])) : '';
    $message = isset($_POST['quote']['message']) ? htmlspecialchars(trim($_POST['quote']['message'])) : '';

    $data = [$name, $email, $phone, $message, date("Y-m-d H:i:s")];

    $file = fopen("leads.csv", "a");
    fputcsv($file, $data);
    fclose($file);


    $to = "info@amzvirtualassistant.com";
    $subject = "New Lead Submission";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";
    mail($to, $subject, $body);

    header("Location: /get-a-quote/leads/thankyou.html");
    exit;
} else {
    echo "Invalid request method.";
}
