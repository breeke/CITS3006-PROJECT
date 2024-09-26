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
    echo "Welcome, Johnny! You have successfully accessed the admin page with a custom session ID.";
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
    <title>Admin Page</title>
</head>
<body>
    <h2>Admin Page</h2>
    <p>This page is accessible only if the correct session ID is provided in the URL.</p>

    <!-- Hidden form field -->
    <form action="some_action.php" method="POST">
        <input type="hidden" name="liam" value="you found me">
        <input type="submit" value="Submit">
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
