<?php
$oldError = "";
$newError = "";
$confirmError = "";
$successMessage = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $oldPassword = htmlspecialchars(trim($_POST["oldPassword"]));
    $newPassword = htmlspecialchars(trim($_POST["newPassword"]));
    $confirmPassword = htmlspecialchars(trim($_POST["confirmPassword"]));
    
    $isOldPasswordValid = true; 

  
    if (empty($oldPassword)) {
        $oldError = "Current password is required.";
    } elseif (!$isOldPasswordValid) {

        $oldError = "Incorrect current password.";
    }


    if (empty($newPassword)) {
        $newError = "New password is required.";
    } elseif (strlen($newPassword) < 6) {
        $newError = "New password must be at least 6 characters.";
    } elseif ($newPassword === $oldPassword) {
        $newError = "New password cannot be the same as current password.";
    }


    if (empty($confirmPassword)) {
        $confirmError = "Confirm password is required.";
    } elseif ($newPassword !== $confirmPassword) {
        $confirmError = "Passwords do not match.";
    }

    if (empty($oldError) && empty($newError) && empty($confirmError)) {

        $successMessage = "Password changed successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Story Weave - Change Password</title>
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
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .error {
      color: red;
      font-size: 13px;
      margin-top: -5px;
      margin-bottom: 5px;
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
    .success-message {
      color: green;
      font-weight: bold;
      text-align: center;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <header>
    <img src="swlogo.png" alt="Story Weave Logo">
    <h1>Change Password</h1>
  </header>

  <div class="container">
    <form id="passwordForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <fieldset>
        <legend>Change Password</legend>
        <?php if (!empty($successMessage)): ?>
            <p class="success-message"><?php echo $successMessage; ?></p>
        <?php endif; ?>
        <input type="password" name="oldPassword" id="oldPassword" placeholder="Current Password" >
        <p class="error"><?php echo $oldError; ?></p>

        <input type="password" name="newPassword" id="newPassword" placeholder="New Password" >
        <p class="error"><?php echo $newError; ?></p>

        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm New Password">
        <p class="error"><?php echo $confirmError; ?></p>

        <button type="submit">Update Password</button>
      </fieldset>
    </form>
  </div>
</body>
</html>
