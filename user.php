<?php
session_start();

// Function to encrypt the cookie value using AES-256-CBC and then encode with Base64
function encrypt_cookie_value($value, $key) {
    $iv = '1234567890123456';  // Initialization vector (must be 16 bytes for AES-256-CBC)
    $encrypted = openssl_encrypt($value, 'aes-256-cbc', $key, 0, $iv);  // AES-256-CBC encryption
    return base64_encode($encrypted);  // Base64 encode the encrypted value
}

// Encryption key for AES encryption
$encryption_key = 'this is my special key 123456789';
$encryption_key2 = 'this is my special key 098765432';
// Encrypt the two initial cookie values 'iamjohnnysilverhand' and 'imakey'
$encrypted_cookie3 = encrypt_cookie_value('iamjohnnysilverhand', $encryption_key);
$encrypted_cookie4 = encrypt_cookie_value('this is my special key 123456789', $encryption_key2);

// Generate two random values for the additional cookies
$random_value1 = bin2hex(random_bytes(16));  // Generate a secure random value
$random_value2 = bin2hex(random_bytes(16));  // Generate another secure random value

// Encrypt the random values for the cookies
$encrypted_cookie5 = encrypt_cookie_value($random_value1, $encryption_key);
$encrypted_cookie6 = encrypt_cookie_value($random_value2, $encryption_key);

// Set the encrypted cookies
setcookie('cookie3', $encrypted_cookie3, [
    'expires' => time() + 3600, // Cookie expires in 1 hour
    'path' => '/',              // Valid for the entire domain
    'secure' => false,          // Set to true if using HTTPS
    'httponly' => true,         // Not accessible via JavaScript
    'samesite' => 'Lax'         // Prevents CSRF
]);

setcookie('cookie4', $encrypted_cookie4, [
    'expires' => time() + 3600, // Cookie expires in 1 hour
    'path' => '/',              // Valid for the entire domain
    'secure' => false,          // Set to true if using HTTPS
    'httponly' => true,         // Not accessible via JavaScript
    'samesite' => 'Lax'         // Prevents CSRF
]);

setcookie('cookie5', $encrypted_cookie5, [
    'expires' => time() + 3600, // Cookie expires in 1 hour
    'path' => '/',              // Valid for the entire domain
    'secure' => false,          // Set to true if using HTTPS
    'httponly' => true,         // Not accessible via JavaScript
    'samesite' => 'Lax'         // Prevents CSRF
]);

setcookie('cookie6', $encrypted_cookie6, [
    'expires' => time() + 3600, // Cookie expires in 1 hour
    'path' => '/',              // Valid for the entire domain
    'secure' => false,          // Set to true if using HTTPS
    'httponly' => true,         // Not accessible via JavaScript
    'samesite' => 'Lax'         // Prevents CSRF
]);

// Set a session variable for the user
$_SESSION['username'] = 'user';

// Handle the form input (unsanitized)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_input = $_POST['user_input'];

    // If the input contains '<script>', treat it as JavaScript and execute it in the browser
    if (strpos($user_input, '<script>') !== false) {
        echo $user_input;  // This will execute the JavaScript code directly
    } else {
        // Echo the user input (normal string) after sanitizing
        echo "User input (safe output): " . htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>
<body>
    <h2>Welcome, User!</h2>
    <p>Four encrypted cookies have been set, including two random values.</p>

    <!-- Input form to either echo or execute JavaScript -->
    <form method="POST" action="user.php">
        <label for="user_input">Enter a string or JavaScript:</label><br>
        <input type="text" id="user_input" name="user_input" required><br><br>
        <input type="submit" value="Submit">
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
