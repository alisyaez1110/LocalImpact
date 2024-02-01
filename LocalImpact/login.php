<?php
session_start();
include "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the username and password (you can add more validation logic if needed)
    if (!empty($username) && !empty($password)) {
        // Query the database to check if the username and password match
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Username and password are correct
            $_SESSION["username"] = $username;
            $_SESSION["isLoggedIn"] = true;

            // Redirect the user to user.php
            header("Location: user.php");
            exit();
        } else if ($username == "admin" && $password == "Admin_12345") {
            header("Location: admin.php");
        } else {
            // Username or password is incorrect
            $_SESSION["error"] = "Invalid username or password";

            // Redirect the user back to the login page
            header("Location: index.php");
            exit();
        }
    } else {
        // Username or password is empty
        $_SESSION["error"] = "Please enter username and password";

        // Redirect the user back to the login page
        header("Location: index.php");
        exit();
    }
}
?>