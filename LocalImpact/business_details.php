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
            <li><a href="admin.php">User Details</a></li>
            <li><a href="adminBusiness.php" >Business Details</a></li>
            <li><a href="eventAdmin.php">Event Details</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>



    <div class="business1-details">
        <?php

            session_start();
            include "config.php";

            //deleting was not a good idea, maybe can try "deleting" by changing
            //the code to update by default

            if (isset($_GET['delete'])) {
                // get value of id that sent from address bar 
                
                $username_delete = $_GET['delete'];
                echo $username_delete;
            
                //Delete data in mysql from row that has this id 
                //$sql = "DELETE FROM company WHERE username='".$username_delete."'";
                // $sql = "DELETE user, company, event
                // FROM user
                // JOIN company ON user.username = company.username
                // JOIN event ON company.companyName = event.eventCompany
                // WHERE user.username = '".$username_delete."'";
                // $result = $conn->query($sql);
            
                // // if successfully deleted
                // if ($result){
                //     echo '<script>alert("Deleted Successfully")</script>';
                //     echo "window.location.replace('adminBusiness.php')";
                // } else {
                //     echo "Delete ERROR";
                // }
            }


            
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

                    // echo '<div class="button-container">';
                    // //echo '<a href="adminBusiness.php?delete=' . $row['username'] . '">Delete</a>';
                    // echo "<button onclick=location.href='business_details.php?delete=".$row['username']."'>Delete</button>";
                    // echo '</div>';
                    
                }
            }

        ?>
        
        
    </div>
    
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
