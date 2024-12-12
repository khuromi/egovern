<?php
// Ensure session_start() is called before any output
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['user'] = 'Test User'; // Set a session variable
echo "Session started and variable set!"; // Confirm session start

// Print session data
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
