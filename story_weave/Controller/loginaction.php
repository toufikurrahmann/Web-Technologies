<?php
// Start a new session or resume the existing one to store data
// before redirecting.
session_start();

// This script only processes POST requests from the form.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
 
    $errors = [];
    $old_data = ['email' => $email];
 
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters.';
    }
    
    // Check if there are any validation errors.
    if (!empty($errors)) {
        // Store errors and old data in the session to be retrieved by login.php.
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $old_data;
        // Redirect back to the login form page.
        // NOTE: Change the folder path if the file is in a different directory.
        header('Location: ../View/PHP/login.php');

        exit();
    }
    
    // If there are no errors, the login is considered successful.
    
    // In a real application, you would verify the email and password against a database here.
    // Set a session variable to indicate the user is logged in.
    $_SESSION['user_email'] = $email;

    // Set a cookie to remember the user's email for 30 days.
    setcookie('remember_email', $email, time() + (86400 * 30), "/"); // 86400 = 1 day
    
    // Redirect to the user's profile page.
    // NOTE: Change the folder path if the file is in a different directory.
   header('Location: ../View/PHP/profile.php');
    exit();
}
// If the script is accessed directly without a POST request, redirect to the login page.
header('Location: ../View/PHP/login.php');

exit();
?>
