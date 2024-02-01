<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] === true) {
    // Clear all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    $_SESSION["logoutMessage"] = "You have been logged out.";

    // Redirect the user to the login page or any other desired page
    header("Location: index.php");
    exit();
} else {
    
    $_SESSION["logoutMessage"] = "Please log in first.";

    // If the user is not logged in, redirect them to the login page or any other desired page
    header("Location: index.php");
    exit();
}
?>