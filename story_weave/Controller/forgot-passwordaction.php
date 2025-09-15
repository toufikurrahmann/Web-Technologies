<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');

    $emailError = '';
    $successMessage = '';

    // Validation
    if (empty($email)) {
        $emailError = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Please enter a valid email address!";
    }

    // If no error
    if (empty($emailError)) {
        // TODO: Implement actual password reset email logic
        $successMessage = "Password reset link sent to " . htmlspecialchars($email) . ".";
    }

    // Store messages in session to retrieve on form page
    $_SESSION['email'] = $email;
    $_SESSION['emailError'] = $emailError;
    $_SESSION['successMessage'] = $successMessage;

    // Redirect back to the form page
    header('Location: ../View/PHP/forgot-password.php');
    exit();
}

// If accessed directly
header('Location: ../View/PHP/forgot-password.php');
exit();
?>
