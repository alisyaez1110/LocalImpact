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
            font-family: 'Actor';
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
            <li><a href="publicOrganization.php" >Organizations</a></li>
            <li><a href="publicEvents.php" >Events</a></li>
            <li><a href="publicAboutUs.php" class="active">About Us</a></li>
            <li><a href="publicContactUs.php">Contact Us</a></li>
            <li><a href="index.php">Login</a></li>
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
                    echo "<p><strong>SparkLocal aims to connect people with local businesses and organizations that have a positive social impact. We believe in supporting ventures that prioritize social responsibility and contribute to the betterment of communities. By providing a platform for users to discover these businesses, we empower individuals to make informed choices and support causes that align with their values.<br><br>

                    Through SparkLocal, users can explore a diverse range of local initiatives that address societal challenges. Whether it's environmental sustainability, social justice, education, health, or other impactful areas, we strive to showcase ventures that are making a difference. By highlighting inspiring stories and providing a comprehensive directory, we enable users to engage with these businesses and organizations easily.<br><br>
                    
                    We foster community engagement by encouraging users to share reviews, recommendations, and connect with like-minded individuals. By building a network of conscious consumers and businesses, we aim to create a ripple effect that extends beyond immediate impact. Together, we can contribute to a more inclusive and sustainable future by supporting and amplifying the efforts of local ventures that are driving positive change in our communities.</strong></p>";
                    echo "</div>";
        ?>
    </div>
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
