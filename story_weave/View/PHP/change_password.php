<?php
session_start();

// Retrieve errors and success message from session
$oldError = $_SESSION['oldError'] ?? '';
$newError = $_SESSION['newError'] ?? '';
$confirmError = $_SESSION['confirmError'] ?? '';
$successMessage = $_SESSION['successMessage'] ?? '';

// Clear session after retrieving
unset($_SESSION['oldError'], $_SESSION['newError'], $_SESSION['confirmError'], $_SESSION['successMessage']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
<link rel="stylesheet" href="change_password.css">
</head>
<body>
<div class="container">
    <form action="../../Controller/change_passwordaction.php" method="post">
        <fieldset>
            <legend>Change Password</legend>

            <?php if(!empty($successMessage)): ?>
                <p class="success-message"><?php echo $successMessage; ?></p>
            <?php endif; ?>

            <input type="password" name="oldPassword" placeholder="Current Password">
            <p class="error"><?php echo $oldError; ?></p>

            <input type="password" name="newPassword" placeholder="New Password">
            <p class="error"><?php echo $newError; ?></p>

            <input type="password" name="confirmPassword" placeholder="Confirm New Password">
            <p class="error"><?php echo $confirmError; ?></p>

            <button type="submit">Update Password</button>
        </fieldset>
    </form>
</div>
</body>
</html>
