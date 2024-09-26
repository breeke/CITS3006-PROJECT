<?php
session_start();

// Unset all session variables and destroy the session
session_unset();
session_destroy();

// Clear the user credentials cookie
setcookie('userCredentials', '', time() - 3600, '/');

// Redirect to login page
header('Location: login.php');
exit();
