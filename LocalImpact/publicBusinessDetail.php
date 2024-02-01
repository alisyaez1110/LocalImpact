<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>User Page</title>
    <style>
        td {
            padding: 20px;
        }
        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
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
            <li><a href="publicOrganization.php" >Organization</a></li>
            <li><a href="publicEvents.php">Events</a></li>
            <li><a href="publicAboutUs.php">About Us</a></li>
            <li><a href="publicContactUs.php">Contact Us</a></li>
            <li><a href="index.php">Login</a></li>
        </ul>
    </div>



    <div class="business1-details">
        <?php

            session_start();
            include "config.php";
            
            $username = $_GET['id'];
            //echo $username;

            $sql = "SELECT * FROM company WHERE username='".$username."'";
            $result = $conn->query($sql);


            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){

                    $businessImage = '<img src="'. $row['businessImage'] .'" / class="business-image" >';
                    

                    echo $businessImage;
                    echo "<h2>" . $row['businessName'] . "</h2><br>";
                    echo "<p>" .$row['businessDesc']. "</p><br>";
                    echo "<p><b>Our Slogan: </b>".$row['businessSlogan']."</p><br>";
                    echo "<p>Formed since".$row['businessYear']."</p><br>";
                    echo "<p><b>Contact Us Through </b></p>";
                    echo "<p>e-mail: ".$row['businessEmail']."</p>";
                    echo "<p>Phone: ".$row['businessContact']."</p><br><br>";

                    
                }
            }

        ?>
        
        
    </div>
    
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
