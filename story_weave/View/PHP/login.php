<?php
// Start a new session or resume the existing one.
session_start();

// Retrieve errors and old data from the session if they exist.
// This is done after loginaction.php redirects back to this page.
$errors = $_SESSION['errors'] ?? [];
$old_data = $_SESSION['old_data'] ?? ['email' => ''];

// Clear the session variables to prevent errors and old data
// from reappearing on page refresh.
unset($_SESSION['errors']);
unset($_SESSION['old_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Story Weave - Login</title>
  <!-- NOTE: Change the folder path for the CSS file if needed. -->
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <header>
    <!-- NOTE: Change the folder path for the image file if needed. -->
    <img src="swlogo.png" alt="Story Weave Logo">
    <h1>Story Weave - Co-Author</h1>
  </header>
 
  <div class="container">
    <!-- The form's action now points to the new loginaction.php file. -->
<form id="loginForm" action="http://localhost/story_weave/Controller/loginaction.php" method="POST">
      <fieldset>
        <legend>Login</legend>
        <input type="email" id="email" name="email" placeholder="Email" class="<?php echo isset($errors['email']) ? 'input-error' : ''; ?>" value="<?php echo htmlspecialchars($old_data['email']); ?>">
        <div id="emailError" class="error"><?php echo $errors['email'] ?? ''; ?></div>
 
        <input type="password" id="password" name="password" placeholder="Password" class="<?php echo isset($errors['password']) ? 'input-error' : ''; ?>">
        <div id="passwordError" class="error"><?php echo $errors['password'] ?? ''; ?></div>
 
        <button type="submit">Login</button>
      </fieldset>
    </form>
    <div class="links">
      <p><a href="register.php">Register</a>
         <a href="forgot-password.php">Forgot Password?</a>
   
      </p>
    </div>
  </div>
</body>
</html>