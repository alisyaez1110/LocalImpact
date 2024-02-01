<?php
session_start();
include "config.php";

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    // Retrieve the logged-in username from the session
    $username = $_SESSION['username'];

    // Retrieve the updated business information from the form submission
    $businessEmail = $_POST['businessEmail'];
    $businessName = $_POST['businessName'];
    $businessType = $_POST['businessType'];
    $businessDesc = $_POST['businessDesc'];
    $businessContact = $_POST['businessContact'];
    $businessSlogan = $_POST['businessSlogan'];
    $businessYear = $_POST['businessYear'];

    // Handle the file upload
    if (isset($_FILES['businessImage']) && $_FILES['businessImage']['error'] === UPLOAD_ERR_OK) {
        // Retrieve the temporary file path
        $tmpFilePath = $_FILES['businessImage']['tmp_name'];

        // Generate a unique name for the uploaded file
        $fileName = $_FILES['businessImage']['name'];

        // Specify the directory where the file will be saved
        $uploadDirectory = "image/";

        // Build the destination file path
        $businessImage = $uploadDirectory . $fileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($tmpFilePath, $businessImage)) {
            // File upload successful
            // Save the image link (destination path) in the database
            // Update your SQL statement to include the image link column
            $stmt = $conn->prepare("UPDATE company SET businessEmail=?, businessName=?, businessType=?, businessDesc=?, businessContact=?, businessSlogan=?, businessYear=?, businessImage=? WHERE username=?");
            
            $stmt->bind_param("sssssssss", $businessEmail, $businessName, $businessType, $businessDesc, $businessContact, $businessSlogan, $businessYear, $businessImage, $username);            

            if ($stmt->execute()) {
                $_SESSION["status"] = "Business information updated successfully.";
                header("Location: business.php");
                exit();
            } else {
                $_SESSION["status"] = "Error updating business information. " . $stmt->error;
            }

            // Close the statement
            $stmt->close();

        } else {
            $_SESSION["status"] = "Error uploading the file.";
        }
    } else {
         
        $stmt = $conn->prepare("UPDATE company SET businessEmail=?, businessName=?, businessType=?, businessDesc=?, businessContact=?, businessSlogan=?, businessYear=? WHERE username=?");
        
        $stmt->bind_param("ssssssss", $businessEmail, $businessName, $businessType, $businessDesc, $businessContact, $businessSlogan, $businessYear, $username);            

            if ($stmt->execute()) {
                $_SESSION["status"] = "Business information updated successfully.";
                header("Location: business.php");
                exit();
            } else {
                $_SESSION["status"] = "Error updating business information. " . $stmt->error;
            }
    }

    // Close the database connection
    $conn->close();
} else {
    $_SESSION["status"] = "You are not logged in. Please log in to update your business information.";
}
?>
