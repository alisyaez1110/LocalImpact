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
        .user-details {
            border: 1px solid #ddd;
            background-color: #f1f1f1;
            padding-top: 20px;
            padding-left: 600px;
        }
        .button-container {
            margin-top: 20px;
        }
        .button-container button {
            margin-right: 10px;
            margin-bottom: 20px;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start; /* Change from "space-between" to "flex-start" */
        }

        .card {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 10px;
            margin-left: 10px;
            width: calc(25% - 20px);
            box-sizing: border-box;
        }

        .card h2 {
            font-size: 20px;
            margin-top: 0;
        }

        .card p {
            margin-bottom: 0;
        }
        .card .business-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .card
        {
            text-decoration: none;
            color: black;
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
            <li><a href="publicOrganization.php" class="active">Organization</a></li>
            <li><a href="publicEvents.php">Events</a></li>
            <li><a href="publicAboutUs.php">About Us</a></li>
            <li><a href="publicContactUs.php">Contact Us</a></li>
            <li><a href="index.php">Login</a></li>
        </ul>
    </div>



    <div class="card-container">        
        
        <?php

            session_start();
            include "config.php";

            $sql = "SELECT * FROM company";
            $result = $conn->query($sql);



            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){

                    $username = $row['username'];
                    $businessImage = '<img src="'. $row['businessImage'] .'" / class="business-image" >';
                    
                    echo "<a href='publicBusinessDetail.php?id=$username' class = 'card'>";
                        echo $businessImage;
                        echo "<h2>" . $row['businessName'] . "</h2>";
                        echo "View More";
                    echo "</a>";

                }
            }



        ?>



    </div>



    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
