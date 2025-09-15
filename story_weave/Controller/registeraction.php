<?php
session_start();

$errors = [];
$old_data = [
    'name' => '',
    'email' => '',
    'bio' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = sanitize_input($_POST['name'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $bio = sanitize_input($_POST['bio'] ?? '');

    $old_data['name'] = $name;
    $old_data['email'] = $email;
    $old_data['bio'] = $bio;

    // Name validation
    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    }

    // Email validation
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }

    // Password validation
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters.';
    }

    // Confirm password validation
    if (empty($confirmPassword)) {
        $errors['confirmPassword'] = 'Please confirm your password.';
    } elseif ($password !== $confirmPassword) {
        $errors['confirmPassword'] = 'Passwords do not match.';
    }

    // Bio validation
    if (strlen($bio) > 200) {
        $errors['bio'] = 'Bio must not exceed 200 characters.';
    }

    // If there are errors, store in session and redirect back to form
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $old_data;
        header('Location: ../View/PHP/profile.php'); // Change this to your form page
        exit();
    }

    // If no errors, continue to profile page or save to database
    $_SESSION['user_data'] = [
        'name' => $name,
        'email' => $email,
        'bio' => $bio
    ];
    header('Location: ../View/PHP/profile.php');
    exit();
}

// If accessed directly
header('Location: ../View/PHP/profile.php');
exit();
?>
