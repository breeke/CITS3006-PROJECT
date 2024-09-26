<?php
header("Access-Control-Allow-Origin: http://192.168.56.104/");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);  // Exit after handling preflight request
}

// Regular PHP processing (e.g., phpinfo output)
phpinfo();
?>
