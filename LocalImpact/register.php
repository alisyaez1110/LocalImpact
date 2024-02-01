<?php
session_start();
include "config.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username or email already exist
    $existingUserQuery = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
    $existingUserResult = mysqli_query($conn, $existingUserQuery);

    if (mysqli_num_rows($existingUserResult) > 0) {
        $_SESSION["error"] = "Username or email already exists. Please insert another username and email.";
        header("Location: index.php");
        exit();
    }

    // Insert the user data into the user table
    $insertUserQuery = "INSERT INTO user (firstName, lastName, gender, phone, email, username, password) 
                        VALUES ('$firstName', '$lastName', '$gender', '$phone', '$email', '$username', '$password')";

    if (mysqli_query($conn, $insertUserQuery)) {

        // Insert the username into the company table
        $insertCompanyQuery = "INSERT INTO company (username) VALUES ('$username')";
        mysqli_query($conn, $insertCompanyQuery);

        $_SESSION["status"] = "Successfully registered";

        header("Location: index.php");
        exit();
    } else {
        $_SESSION["error"] = "Failed to register!";
        header("Location: index.php");
        exit();
    }
}
?>
