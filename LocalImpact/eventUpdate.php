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
    $eventCompany = $_POST['eventCompany'];
    $eventDesc = $_POST['eventDesc'];
    $eventDateStart = $_POST['eventDateStart'];
    $eventDateEnd = $_POST['eventDateEnd'];
    $eventTime = $_POST['eventTime'];
    $eventPrice = $_POST['eventPrice'];
    $eventAccNo = $_POST['eventAccNo'];

     // Retrieve the event company from the database based on the username
     $sql = "SELECT businessName FROM company WHERE username = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $result = $stmt->get_result();

      // Fetch the businessName from the result
      $row = $result->fetch_assoc();
      $eventCompany = $row['businessName'];

    // Handle the file upload
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


            if ($result->num_rows > 0) {

                $stmt = $conn->prepare("UPDATE event SET eventCompany=?, eventImage=?, eventDesc=?, eventDateStart=?, eventDateEnd=?, eventTime=?, eventPrice=?, eventAccNo=? WHERE eventName=?");

                $stmt->bind_param("sssssssss", $eventCompany, $eventImage, $eventDesc, $eventDateStart, $eventDateEnd, $eventTime, $eventPrice, $eventAccNo, $eventName);            

                if ($stmt->execute()) {
                    $_SESSION["status"] = "Event information updated successfully.";
                    header("Location: event.php");
                    exit();
                } else {
                    echo "Error updating event information. " . $stmt->error;
                }

            } else {
                $_SESSION["error"] = "No event profile found for the logged-in user.";

                header("Location: event.php");

            }

            // Close the statement
            $stmt->close();
        } else {
            $_SESSION["error"] = "Sorry, error while uploading the details";
            
            header("Location: event.php");

        }
    } else {   

        // $_SESSION["error"] = "Sorry, please insert image";
        // header("Location: event.php");
        

        $stmt = $conn->prepare("UPDATE event SET eventCompany=?, eventDesc=?, eventDateStart=?, eventDateEnd=?, eventTime=?, eventPrice=?, eventAccNo=? WHERE eventName=?");

                $stmt->bind_param("ssssssss", $eventCompany, $eventDesc, $eventDateStart, $eventDateEnd, $eventTime, $eventPrice, $eventAccNo, $eventName);            

                if ($stmt->execute()) {
                    $_SESSION["status"] = "Event information without image updated successfully.";
                    header("Location: event.php");
                    exit();
                } else {
                    echo "Error updating event information. " . $stmt->error;
                }
    }

    // Close the database connection
    $conn->close();
} else {
    echo "User not logged in.";
}
?>