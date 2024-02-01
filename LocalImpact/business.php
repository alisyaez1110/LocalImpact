<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Business Page</title>
    <?php
    session_start();

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
    ?>

    <style>
        h2 {
            text-align: center;
            font-family: 'Aclonica';
        }
        input[type="text"],
        input[type="businessEmail"],
        input[type="businessName"],
        input[type="businessType"],
        input[type="businessContact"],
        input[type="businessSlogan"],
        input[type="businessYear"],
        input[type="file"],
        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        select#businessType {
            height: auto;
            width: 50%;
            padding: 5px;
            margin-bottom: 10px;
        }

        textarea,
        select {
            height: 300px;
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        .image {
            width: 100px;
            height: 100px;
        }
        button {
            justify-content: center;
            margin-right: 10px;
            margin-bottom: 40px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var navLinks = document.querySelectorAll("#nav a");

            for (var i = 0; i < navLinks.length; i++) {
                navLinks[i].addEventListener("click", function(e) {
                    e.preventDefault(); // Prevent the default link behavior

                    // Remove the "active" class from all navigation links
                    for (var j = 0; j < navLinks.length; j++) {
                        navLinks[j].classList.remove("active");
                    }

                    // Add the "active" class to the clicked navigation link
                    this.classList.add("active");

                    // Open the corresponding page
                    var href = this.getAttribute("href");
                    window.location.href = href;
                });
            }
        });
    </script>

</head>
<body>
<div id="header">
    <h1>SparkLocal</h1>
</div>
<div id="nav">
    <ul>
    <li><a href="user.php">User Profile</a></li>
            <li><a href="business.php" class="active">Business Profile</a></li>
            <li><a href="event.php">Event History</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="contactUs.php">Contact Us</a></li>
            <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<?php
include "config.php";

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    // Retrieve the logged-in username from the session
    $username = $_SESSION['username'];

    // Retrieve business details from the database based on the logged-in username
    $sql = "SELECT * FROM company WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display business details in an editable form
        while ($row = $result->fetch_assoc()) {

            unset($businessImage);
            $businessImage = '<img src="'. $row['businessImage'] .'" / class="business-image" >';

            echo "<form id='update' method='POST' action='businessUpdate.php' enctype='multipart/form-data'>";

            echo "<h2>".$row["businessName"]."</h2>";

            echo "<label for='username'><strong>Username:</strong></label>";
            echo "<input type='text' id='username' name='username' value='".$row["username"]."' required>";

            echo "<label for='businessEmail'><strong>Business Email:</strong></label>";
            echo "<input type='text' id='businessEmail' name='businessEmail' value='".$row["businessEmail"]."' required>";

            echo "<label for='businessName'><strong>Business Name:</strong></label>";
            echo "<input type='text' id='businessName' name='businessName' value='".$row["businessName"]."' required>";

            echo "<label for='businessType'><strong>Business Type:<br></strong></label>";
            echo "<select id='businessType' name='businessType' required>";

            echo "<option value='Charity/Volunteer' ";
            if ($row["businessType"] == 'Charity/Volunteer') echo 'selected';
            echo ">Charity/Volunteer</option>";

            echo "<option value='Cleaning Services' ";
            if ($row["businessType"] == 'Cleaning Services') echo 'selected';
            echo ">Cleaning Services</option>";
            
            echo "<option value='Coffee Shop' ";
            if ($row["businessType"] == 'Coffee Shop') echo 'selected';
            echo ">Coffee Shop</option>";

            echo "<option value='Fashion' ";
            if ($row["businessType"] == 'Fashion') echo 'selected';
            echo ">Fashion</option>";
            
            echo "<option value='Foods and Snacks' ";
            if ($row["businessType"] == 'Foods and Snacks') echo 'selected';
            echo ">Foods and Snacks</option>";

            echo "<option value='Laundry' ";
            if ($row["businessType"] == 'Laundry') echo 'selected';
            echo ">Laundry</option>";

            echo "<option value='Marathon' ";
            if ($row["businessType"] == 'Marathon') echo 'selected';
            echo ">Marathon</option>";
            
            echo "<option value='Restaurant'";
            if ($row["businessType"] == 'Restaurant') echo 'selected';
            echo ">Restaurant</option>";

            echo "<option value='smartphone_pc_repair' ";
            if ($row["businessType"] == 'smartphone_pc_repair') echo 'selected';
            echo ">Smartphone and PC Repair</option>";
            
            echo "<option value='Tourism' ";
            if ($row["businessType"] == 'Tourism') echo 'selected';
            echo ">Tourism</option>";
            
            echo "<option value='Travel Agency' ";
            if ($row["businessType"] == 'Travel Agency') echo 'selected';
            echo ">Travel Agency</option>";
            
            echo "<option value='Others' ";
            if ($row["businessType"] == 'Others') echo 'selected';
            echo ">Others</option>";
            echo "</select>";

            echo "<label for='businessDesc'><strong><br>Business Description:</strong></label>";
            echo "<textarea id='businessDesc' name='businessDesc' required>".$row["businessDesc"]."</textarea>";

            echo "<label for='businessContact'><strong>Business Contact:</strong></label>";
            echo "<input type='text' id='businessContact' name='businessContact' value='".$row["businessContact"]."' required>";

            echo "<label for='businessSlogan'><strong>Business Slogan:</strong></label>";
            echo "<input type='text' id='businessSlogan' name='businessSlogan' value='".$row["businessSlogan"]."' required>";

            echo "<label for='businessYear'><strong>Business Started Since:</strong></label>";
            echo "<input type='text' id='businessYear' name='businessYear' value='".$row["businessYear"]."' required>";

            // Display the business image if it exists
            if ($row['businessImage']) {
                echo "<label for='businessImage'><strong>Current Image:<br></strong></label>";
                echo $businessImage;
            }

            echo "<label for='businessImage'><strong><br>Profile Image:</strong></label>";
            echo "<input type='file' id='businessImage' name='businessImage' accept='image/*'>";

            echo "<div class='button-container'>";
            echo "<button type='submit' name='update'>Update</button>";
            echo "</div>";
            echo "</form>";
        }
    } else {
        echo "No business profile found.";
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>