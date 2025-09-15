<?php
session_start();

// Retrieve messages from session
$email = $_SESSION['email'] ?? '';
$emailError = $_SESSION['emailError'] ?? '';
$successMessage = $_SESSION['successMessage'] ?? '';

// Clear session messages after retrieving
unset($_SESSION['email'], $_SESSION['emailError'], $_SESSION['successMessage']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Story Weave - Forgot Password</title>
<link rel="stylesheet" href="forgot-password.css">
</head>
<body>
<header>
    <img src="swlogo.png" alt="Story Weave Logo">
    <h1>Forgot Password</h1>
</header>

<div class="container">
    <?php if (!empty($successMessage)): ?>
        <p class="success"><?= htmlspecialchars($successMessage) ?></p>
    <?php endif; ?>

 <form action="../../Controller/forgot-passwordaction.php" method="POST">

        <fieldset>
            <legend>Reset Password</legend>

            <input type="email" name="email" id="email" placeholder="Enter your email" value="<?= htmlspecialchars($email) ?>">
            <p class="error"><?= htmlspecialchars($emailError) ?></p>

            <button type="submit">Send Reset Link</button>
        </fieldset>
    </form>

    <a href="login.php" class="login-btn">Back to Login</a>
</div>
</body>
</html>