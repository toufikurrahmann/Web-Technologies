<?php
$errors = [];
$old_data = ['email' => ''];


      if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
 
  
    $old_data['email'] = $email;
 
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
    if (empty($errors)) {
    header('Location: profile.php');
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Story Weave - Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #fcfcfc;
      color: #333;
    }
    header {
      background: #4B0082;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    header img {
      height: 120px;
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
    input.input-error {
        border-color: red;
    }
    .error {
      color: red;
      font-size: 13px;
      min-height: 16px;
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
    .links {
      margin-top: 10px;
      text-align: center;
    }
    .links a {
      color: #4B0082;
      text-decoration: none;
      margin: 0 5px;
    }
    .links a:hover {
      text-decoration: underline;
    }
</style>
</head>
<body>
  <header>
    <img src="swlogo.png" alt="Story Weave Logo">
    <h1>Story Weave - Co-Author</h1>
  </header>
 
  <div class="container">
    <form id="loginForm" action="login.php" method="POST">
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
      <p><a href="register.php">Register</a> |
         <a href="#">Forgot Password?</a></p>
    </div>
  </div>
</body>
</html>