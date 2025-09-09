<?php
$name = "";
$email = "";
$nameError = "";
$emailError = "";
$successMessage = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    
    $userId = "12345";
    
    
    if (empty($name)) {
        $nameError = "Name is required!";
    } elseif (strlen($name) < 3 || strlen($name) > 50) {
        $nameError = "Name must be between 3 and 50 characters.";
    }

    if (empty($email)) {
        $emailError = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Please enter a valid email address!";
    }

   
    if (empty($nameError) && empty($emailError)) {

        $successMessage = "Profile updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Story Weave - Profile</title>
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
      margin-bottom: 20px;
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
    .error {
      color: red;
      font-size: 13px;
      margin-top: -5px;
      margin-bottom: 8px;
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
    .links {
      margin-top: 15px;
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
    <a href="profile.html"><img src="swlogo.png" alt="Story Weave Logo"></a>
    <h1>Profile</h1>
  </header>

  <div class="container">
    <form id="profileForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <fieldset>
        <legend>Profile Information</legend>
        <?php if (!empty($successMessage)): ?>
            <p class="success-message"><?php echo $successMessage; ?></p>
        <?php endif; ?>
        <label for="name"><b>Name:</b></label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
        <p class="error"><?php echo $nameError; ?></p>

        <label for="email"><b>Email:</b></label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>">
        <p class="error"><?php echo $emailError; ?></p>

        <button type="submit">Save Changes</button>
        <button type="button" onclick="location.href='change-password.html'">Change Password</button>
      </fieldset>
    </form>

    <fieldset>
      <legend>Co-Author Features</legend>
      <button onclick="location.href='story.html'">Story</button>
      <button onclick="location.href='chapter.html'">Chapter</button>
      <button onclick="location.href='submission.html'">Submission</button>
      <button onclick="location.href='comment.html'">Comment</button>
      <button onclick="location.href='portfolio.html'">Portfolio</button>
      <button onclick="location.href='peer_review.html'">Peer Review</button>
    </fieldset>

    <div class="links">
      <a href="logout.html">Logout</a>
    </div>
  </div>
</body>
</html>