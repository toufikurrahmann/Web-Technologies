<?php
// Initialize variables for the form
$email = '';
$emailError = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form
    $email = trim($_POST['email'] ?? '');

    // Validate the email
    if (empty($email)) {
        $emailError = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Please enter a valid email address!";
    }

    // If there are no errors, process the form
    if (empty($emailError)) {
        // Here you would typically send a password reset link to the user's email.
        // For this example, we will just show a success message.
        $successMessage = "Password reset link sent to " . htmlspecialchars($email) . ".";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Story Weave - Forgot Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0; 
      padding: 0;
      background: #f4f4f9;
      color: #333;
    }
    header {
      background: #4B0082; 
      color: #fff;
      padding: 15px;
      text-align: center;
    }
    header img {
      height: 200px;
    }
    .container {
      max-width: 400px;
      margin: 40px auto;
      padding: 20px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    fieldset {
      border: 2px solid #4B0082;
      border-radius: 8px;
      padding: 20px;
    }
    legend {
      padding: 0 10px;
      color: #4B0082;
      font-weight: bold;
    }
    input {
      width: 92%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 4px;
      background: #4B0082;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover {
      background: #360061;
    }
    .error {
      color: red;
      font-size: 13px;
      margin-top: -5px;
      margin-bottom: 8px;
    }
    .success {
        color: green;
        font-size: 16px;
        text-align: center;
        margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <header>
    <img src="swlogo.png" alt="Story Weave Logo">
    <h1>Forgot Password</h1>
  </header>

  <div class="container">
    <?php if (isset($successMessage)): ?>
        <p class="success"><?= htmlspecialchars($successMessage) ?></p>
    <?php endif; ?>
    <form id="forgotPasswordForm" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
      <fieldset>
        <legend>Reset Password</legend>
        <input type="email" name="email" id="email" placeholder="Enter your email" value="<?= htmlspecialchars($email) ?>">
        <p class="error" id="emailError"><?= htmlspecialchars($emailError) ?></p>
        <button type="submit">Send Reset Link</button>
      </fieldset>
    </form>
  </div>
</body>
</html>
