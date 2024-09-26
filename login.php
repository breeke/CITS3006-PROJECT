<?php
session_start();

// Hardcoded credentials for the user (for demonstration purposes)
$user_credentials = [
    'username' => 'user123',  // Replace with real username
    'password' => 'password123'  // Replace with real hashed password in real-world
];

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password from the form
    $submitted_username = $_POST['username'];
    $submitted_password = $_POST['password'];

    // Authenticate user: check if the submitted credentials match the hardcoded ones
    if ($submitted_username === $user_credentials['username'] && $submitted_password === $user_credentials['password']) {
        // Set session variable to indicate the user is logged in
        $_SESSION['username'] = $submitted_username;

        // Redirect to a protected page (for example, user.php)
        header('Location: user.php');
        exit;
    } else {
        // Invalid credentials
        $error_message = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Display error message if credentials are incorrect -->
    <?php if (isset($error_message)): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="POST" action="login.php">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
