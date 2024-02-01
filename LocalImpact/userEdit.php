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
            padding-top: 20px;
            padding-left: 80px;
        }
        .user-details2 {
            border: 2px solid #ddd;
            background-color: #f1f1f1;
            padding-top: 20px;
            padding-left: 80px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container button {
            margin-right: 10px;
            margin-bottom: 20px;
        }

        .radio-container {
            margin-top: 5px;
        }

        .radio-container label {
            display: block;
            white-space: nowrap;
        }

        .radio-container input[type="radio"] {
            margin-right: 5px;
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
        </ul>
    </div>
    <?php
        session_start();
        include "config.php";

        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {

            // Retrieve the logged-in username from the session
            $username = $_SESSION['username'];
        
            // Retrieve user details from the database based on the logged-in username
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Display user details in an editable form
                echo "<div class='user-details2'>";
                // Add the div to wrap the user details
                while ($row = $result->fetch_assoc()) {
                    echo "<form action='userUpdate.php' method='POST'>";

                    echo "<div class='user-details'>";  

                    echo "<p><strong>First Name:</strong> <input type='text' name='firstName' value='".$row["firstName"]."'></p>";  
                    
                    echo "<p><strong>Last Name:</strong> <input type='text' name='lastName' value='".$row["lastName"]."'></p>";

                    echo "<p><strong>Username:</strong> ".$row["username"]."</p>";
                    
                    echo "<p><strong>Gender:</strong></p>";
                    echo "<div class='radio-container'>";
                    echo "<label><input type='radio' name='gender' value='Male'" . (strcasecmp($row["gender"], "Male") == 0 ? " checked" : "") . "> Male</label><br>";
                    echo "<label><input type='radio' name='gender' value='Female'" . (strcasecmp($row["gender"], "Female") == 0 ? " checked" : "") . "> Female</label><br>";
                    echo "</div>";

                    echo "<p><strong>Email:</strong> <input type='email' name='email' value='".$row["email"]."'></p>";
                    
                    echo "<p><strong>Phone:</strong> <input type='tel' name='phone' value='".$row["phone"]."'></p>";
                    echo "</div>";

                    echo "<div class='button-container'>";
                    echo "<button onclick='window.history.back();' type='button'>Back</button>";
                    echo "<button type='submit'>Save</button>";
                    echo "</div>";
                    echo "</form>";
                }
                echo "</div>";
            } else {
                echo "<p>No users found.</p>";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "<p>Please log in to view this page.</p>";
        }
    ?>
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
