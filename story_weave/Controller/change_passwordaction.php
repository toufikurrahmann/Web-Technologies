<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $oldPassword = trim($_POST["oldPassword"] ?? '');
    $newPassword = trim($_POST["newPassword"] ?? '');
    $confirmPassword = trim($_POST["confirmPassword"] ?? '');

    $errors = ['oldError'=>'','newError'=>'','confirmError'=>''];

    // Replace this with real DB check
    $currentPasswordInDB = "123456"; // Example
    $isOldPasswordValid = ($oldPassword === $currentPasswordInDB);

    // Validation
    if(empty($oldPassword)) {
        $errors['oldError'] = "Current password is required.";
    } elseif(!$isOldPasswordValid) {
        $errors['oldError'] = "Incorrect current password.";
    }

    if(empty($newPassword)) {
        $errors['newError'] = "New password is required.";
    } elseif(strlen($newPassword) < 6) {
        $errors['newError'] = "New password must be at least 6 characters.";
    } elseif($newPassword === $oldPassword) {
        $errors['newError'] = "New password cannot be same as current password.";
    }

    if(empty($confirmPassword)) {
        $errors['confirmError'] = "Confirm password is required.";
    } elseif($newPassword !== $confirmPassword) {
        $errors['confirmError'] = "Passwords do not match.";
    }

    // If errors exist, redirect back with session
    if($errors['oldError'] || $errors['newError'] || $errors['confirmError']) {
        $_SESSION = array_merge($_SESSION, $errors);
        header('Location: ../View/PHP/change_password.php');
        exit();
    }

    // TODO: Update password in DB here
    // $currentPasswordInDB = $newPassword;

    $_SESSION['successMessage'] = "Password changed successfully!";
    header('Location: ../View/PHP/change_password.php');
    exit();
}

// Direct access
header('Location: ../View/PHP/change_password.php');
exit();
?>
