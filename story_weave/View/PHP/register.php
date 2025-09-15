<?php
session_start();

// Retrieve errors and old data from session
$errors = $_SESSION['errors'] ?? [];
$old_data = $_SESSION['old_data'] ?? [
    'name' => '',
    'email' => '',
    'bio' => ''
];

// Clear session messages
unset($_SESSION['errors'], $_SESSION['old_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Story Weave - Register</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <header>
    <img src="swlogo.png" alt="Story Weave Logo">
    <h1>Register</h1>
  </header>
 
  <div class="container">
    <form id="registerForm" action="../../Controller/registeraction.php" method="POST">
      <fieldset>
        <legend>Registration Form</legend>

        <label for="name">Full Name *</label>
        <input type="text" id="name" name="name" class="<?php echo isset($errors['name']) ? 'input-error' : ''; ?>" value="<?php echo htmlspecialchars($old_data['name']); ?>" >
        <div id="nameError" class="error"><?php echo $errors['name'] ?? ''; ?></div>
 
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" class="<?php echo isset($errors['email']) ? 'input-error' : ''; ?>" value="<?php echo htmlspecialchars($old_data['email']); ?>" >
        <div id="emailError" class="error"><?php echo $errors['email'] ?? ''; ?></div>
 
        <label for="password">Password *</label>
        <input type="password" id="password" name="password" class="<?php echo isset($errors['password']) ? 'input-error' : ''; ?>" >
        <div id="passwordError" class="error"><?php echo $errors['password'] ?? ''; ?></div>
 
        <label for="confirmPassword">Confirm Password *</label>
        <input type="password" id="confirmPassword" name="confirmPassword" class="<?php echo isset($errors['confirmPassword']) ? 'input-error' : ''; ?>" >
        <div id="confirmPasswordError" class="error"><?php echo $errors['confirmPassword'] ?? ''; ?></div>
 
        <label for="bio">Short Bio (Max 200 characters)</label>
        <textarea id="bio" name="bio" maxlength="200" class="<?php echo isset($errors['bio']) ? 'input-error' : ''; ?>"><?php echo htmlspecialchars($old_data['bio']); ?></textarea>
        <div id="bioError" class="error"><?php echo $errors['bio'] ?? ''; ?></div>
 
        <button type="submit">Register</button>
 
        <div class="login-link">
          <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
      </fieldset>
    </form>
  </div>
</body>
</html>
