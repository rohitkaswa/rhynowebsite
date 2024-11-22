<?php

require __DIR__ . '/vendor/autoload.php'; // Include Razorpay PHP library

use Razorpay\Api\Api;

$api_key = 'rzp_test_6eaPDVmqBSIJZP';
$api_secret = 'VdI8uO8Cbti0DfhJtAMe8tE0';

$api = new Api($api_key, $api_secret);

// Assuming you have a MySQL database with table 'payments' having columns 'payment_id' and 'amount'
$dsn = 'mysql:host=localhost;dbname=your_database_name';
$username = 'your_username';
$password = 'your_password';

// Connect to the database
try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST['razorpay_payment_id'];
    $amount = 1000000; // Amount in paise (e.g., ₹500.00 = 50000)

    try {
        // Capture payment
        $api->payment->fetch($payment_id)->capture(array('amount' => $amount));

        // Store payment details in the database
        $stmt = $db->prepare("INSERT INTO payments (payment_id, amount) VALUES (:payment_id, :amount)");
        $stmt->bindParam(':payment_id', $payment_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->execute();

        // Redirect to the next page after successful payment
        header('Location: buy.');
        exit;

    } catch (Exception $e) {
        echo 'Payment failed: ' . $e->getMessage();
    }
}
?>
