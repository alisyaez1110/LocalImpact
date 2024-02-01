<?php

session_start();
include "config.php";

// Check if the session status is set
if (isset($_SESSION["status"])) {
    echo '<script>alert("' . $_SESSION["status"] . '");</script>';
    unset($_SESSION["status"]);
}

// Check if the session error is set
if (isset($_SESSION["error"])) {
    echo '<script>alert("' . $_SESSION["error"] . '");</script>';
    unset($_SESSION["error"]);
}

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {

    // Retrieve the logged-in username from the session
    $username = $_SESSION['username'];

    // Retrieve the event details from the form
    $eventName = $_POST['eventName'];
    $eventDesc = $_POST['eventDesc'];
    $eventDateStart = $_POST['eventDateStart'];
    $eventDateEnd = $_POST['eventDateEnd'];
    $eventTime = $_POST['eventTime'];
    $eventPrice = $_POST['eventPrice'];
    $eventAccNo = $_POST['eventAccNo'];

    if (isset($_FILES['eventImage']) && $_FILES['eventImage']['error'] === UPLOAD_ERR_OK) {
        // Retrieve the temporary file path
        $tmpFilePath = $_FILES['eventImage']['tmp_name'];

        // Generate a unique name for the uploaded file
        $fileName = $_FILES['eventImage']['name'];

        // Specify the directory where the file will be saved
        $uploadDirectory = "image/";

        // Build the destination file path
        $eventImage = $uploadDirectory . $fileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($tmpFilePath, $eventImage)) {

            // Retrieve the event company from the database based on the username
            $sql = "SELECT businessName FROM company WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch the businessName from the result
                $row = $result->fetch_assoc();
                $eventCompany = $row['businessName'];

                // Insert the user data into the user table
                $insertEventQuery = "INSERT INTO event (eventName, eventImage, eventDesc, eventDateStart, eventDateEnd, eventTime, eventPrice, eventAccNo, eventCompany) 
                VALUES ('$eventName', '$eventImage', '$eventDesc', '$eventDateStart', '$eventDateEnd', '$eventTime', '$eventPrice', '$eventAccNo', '$eventCompany')";

                if (mysqli_query($conn, $insertEventQuery)) {

                $_SESSION["status"] = "Add Event has been successful";

                header("Location: event.php");
                exit();
                } else {
                $_SESSION["error"] = "Failed to register!";
                header("Location: event.php");
                exit();
                }

            } else {
                $_SESSION["error"] = "No business profile found for the logged-in user.";

                header("Location: event.php");

            }

            // Close the statement
            $stmt->close();
        } else {
            $_SESSION["error"] = "Sorry, only JPG, PNG, JPEG, GIF & WEBP files are allowed.";
            
            header("Location: event.php");

        }
    } else {
        $_SESSION["error"] = "Sorry, image cannot be updated.";

        header("Location: event.php");
    }

    // Close the database connection
    $conn->close();
} else {
    echo "User not logged in.";
}
?>
