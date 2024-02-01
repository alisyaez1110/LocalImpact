<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Actor' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>About Us Page</title>
    <style>
        h2{
            text-align: center;
            font-family: 'Aclonica';
        }
        p{
            text-align: center;
            font-family: 'Alegreya Sans SC';
        }
        .user-details {
            border: 2px solid #ddd;
            background-color: #f1f1f1;
            padding-top: 10px;
            padding-left: 400px;
            padding-right: 400px;
            padding-bottom: 50px;
        }
        .user-details2 {
            border: 2px solid #ddd;
            background-color: #f1f1f1;
            padding-top: 20px;
            padding-left: 50px;
            padding-right: 50px;
            padding-bottom: 20px;
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
            <li><a href="business.php">Business Profile</a></li>
            <li><a href="event.php">Event History</a></li>
            <li><a href="aboutUs.php" >About Us</a></li>
            <li><a href="contactUs.php"class="active">Contact Us</a></li>
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
    <h2>SparkLocal</h2>
        <?php
            
                    echo "<div class='user-details2'>";
                    
                    echo "<p><strong>Website Name: </strong>SparkLocal</p>";
                    echo "<p><strong>Email: </strong>sparklocal@gmail.com</p>";echo "<p><strong>Phone Number: </strong>011-19828487</p>";

                    echo "</div>";
        ?>
    </div>
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
