<?php
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
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $bio = sanitize_input($_POST['bio'] ?? '');

    $old_data['name'] = $name;
    $old_data['email'] = $email;
    $old_data['bio'] = $bio;
 

    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    }
 

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

    if (empty($confirmPassword)) {
        $errors['confirmPassword'] = 'Please confirm your password.';
    } elseif ($password !== $confirmPassword) {
        $errors['confirmPassword'] = 'Passwords do not match.';
    }

    if (strlen($bio) > 200) {
        $errors['bio'] = 'Bio must not exceed 200 characters.';
    }
 
    if (empty($errors)) {
  
        echo "<!DOCTYPE html><html lang='en'><head><title>Success</title><style>body{font-family: Arial, sans-serif; text-align: center; padding-top: 50px;}</style></head><body><h1>Registration Successful!</h1><p>You can now <a href='login.php'>login</a> with your new account.</p></body></html>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Story Weave - Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #ffffff;
      color: #333;
    }
    header {
      background: #4B0082;
      color: #fff;
      padding: 10px;
      text-align: center;
    }
    header img {
      height: 120px;
    }
    .container {
      max-width: 400px;
      margin: 40px auto;
      padding: 20px;
      background: #ffffff;
      border: 2px solid #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    fieldset {
      border: 1px solid #4B0082;
      border-radius: 8px;
      padding: 20px;
    }
    legend {
      padding: 0 10px;
      color: #4B0082;
      font-weight: bold;
    }
    input, textarea {
      width: 92%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    /* Style for the input field when there is an error */
    input.input-error, textarea.input-error {
      border-color: red;
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
      margin-top: 10px;
    }
    button:hover {
      background: #360061;
    }
    .error {
      color: red;
      font-size: 14px;
      min-height: 16px;
    }
    .login-link {
      text-align: center;
      margin-top: 15px;
    }
    .login-link a {
      color: #4B0082;
      font-weight: bold;
      text-decoration: none;
    }
    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <img src="swlogo.png" alt="Story Weave Logo">
    <h1>Register</h1>
  </header>
 
  <div class="container">
    <!-- The form now submits to this same file -->
    <form id="registerForm" action="register.php" method="POST">
      <fieldset>
        <legend>Registration Form</legend>
        <label for="name">Full Name *</label>
        <!-- PHP now adds the error class and repopulates the value -->
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
 