<?php
session_start();

// Check if the session ID (PHPSESSID) is provided in the URL
if (isset($_GET['PHPSESSID']) && $_GET['PHPSESSID'] === 'iamjohnnysilverhand') {
    // Set the session ID to 'iamjohnnysilverhand'
    session_id('iamjohnnysilverhand');
    // Start the session again after setting the session ID
    session_start();

    // Set a session variable to indicate that the user is an admin
    $_SESSION['role'] = 'admin';
}

// If the session role is set to admin, allow access to the admin page
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    echo "Welcome, Johnny! You have successfully accessed the page with a custom session ID.<br><br>";

    // Check if the form is submitted with the correct username and password
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Verify the username and password
        if ($username === 'liam' && $password === 'you found me') {
            // Show the text box with "root/passwd"
            echo "<textarea rows='5' cols='50'>root/passwd</textarea>";
        } else {
            echo "Incorrect username or password. Try again.";
        }
    }
} else {
    echo "Access Denied. You do not have the correct session ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Johnny</title>
</head>
<body>
    <h2>Johnny's page</h2>
    <p>This page is accessible only if the correct session ID is provided in the URL.</p>

    <!-- Form for username and password -->
    <form action="" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Submit">
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>


