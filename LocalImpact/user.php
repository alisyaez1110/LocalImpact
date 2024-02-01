<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>User Page</title>
    <style>
        .user-details {
            border: 2px solid #ddd;
            background-color: #f1f1f1;
            padding-top: 50px;
            padding-left: 400px;
            padding-right: 400px;
            padding-bottom: 50px;
        }
        .user-details2 {
            border: 2px solid #ddd;
            background-color: #f1f1f1;
            padding-top: 20px;
            padding-left: 250px;
            padding-bottom: 20px;
        }
        .button-container {
            margin-top: 20px;
            padding-left: 350px;
        }
        .button-container button {
            margin-right: 10px;
            margin-bottom: 20px;
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
            <li><a href="user.php" class="active">User Profile</a></li>
            <li><a href="business.php">Business Profile</a></li>
            <li><a href="event.php">Event History</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="contactUs.php">Contact Us</a></li>
            <li><a href="logout.php">Logout</a></li>
            <script>
                // Check if the logout message is set in the session
                <?php if (isset($_SESSION["logoutMessage"])) : ?>
                    // Display the popup message
                    alert("<?php echo $_SESSION["logoutMessage"]; ?>");
                <?php
                    // Unset the logout message session variable
                    unset($_SESSION["logoutMessage"]);
                    endif;
                ?>
            </script>
        </ul>
    </div>
    <div class="user-details">
        <?php
            session_start();
            include "config.php";
            
            // Check if the user is logged in
            if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
                // Retrieve the logged-in username from the session
                $username = $_SESSION['username'];
            
                // Retrieve user details from the database based on the logged-in username
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                    // Display user details in a vertical form
                    echo "<div class='user-details2'>"; // Add the div to wrap the user details
                    while ($row = $result->fetch_assoc()) {
                        echo "<p><strong>First Name:</strong> ".$row["firstName"]."</p>";
                        echo "<p><strong>Last Name:</strong> ".$row["lastName"]."</p>";
                        echo "<p><strong>Username:</strong> ".$row["username"]."</p>";
                        echo "<p><strong>Gender:</strong> ".$row["gender"]."</p>";
                        echo "<p><strong>Email:</strong> ".$row["email"]."</p>";
                        echo "<p><strong>Phone:</strong> ".$row["phone"]."</p>";
                    }
                    echo "</div>"; // Close the div for user details
                } else {
                    echo "No users found.";
                }
            
                // Close the database connection
                $conn->close();
            } else {
                // Redirect the user to the login page if not logged in
                header("Location: login.php");
                exit();
            }
        ?>
        <div class="button-container">
            <a href="userEdit.php"><button>Edit</button></a>
        </div>
    </div>
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
