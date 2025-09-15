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
  <link rel="stylesheet" href="profile.css">
</head>
<body>
  <header>
    <a href="profile.php"><img src="swlogo.png" alt="Story Weave Logo"></a>
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
        <button type="button" onclick="location.href='change_password.php'">Change Password</button>
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
      <a href="login.php">Logout</a>
    </div>
  </div>
</body>
</html>