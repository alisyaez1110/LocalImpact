<?php
session_start();
include "config.php";

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    // Retrieve the logged-in username from the session
    $username = $_SESSION['username'];

    // Retrieve the updated user information from the form submission
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $newUsername = $_POST['username'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Check if the new username or email already exist for other users
    $existingUserQuery = "SELECT * FROM user WHERE (username = '$newUsername' OR email = '$email') AND username != '$username'";
    $existingUserResult = mysqli_query($conn, $existingUserQuery);

    if (mysqli_num_rows($existingUserResult) > 0) {
        echo "Username or email already exists for another user. Update failed.";
        header("userEdit.php");
        exit();
    }

    // Update the user information in the database
    $updateUserQuery = "UPDATE user SET firstName='$firstName', lastName='$lastName', gender='$gender', email='$email', phone='$phone' WHERE username='$username'";
    
    if (mysqli_query($conn, $updateUserQuery)) {
        echo "User information updated successfully.";
        header("Location: user.php");
        exit();
    } else {
        echo "Error updating user information: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "You are not logged in. Please log in to update your information.";
}
?>
