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



    <div class="event-details">
        <?php

            session_start();
            include "config.php";

            $eventName = $_GET['id'];
            //echo $username;

            $sql = "SELECT * FROM event WHERE eventName='".$eventName."'";
            $result = $conn->query($sql);


            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){

                    

                    //$eventImage = $row['eventImage'];
                    //$eventImage = '<img src="'. $row['eventImage'] .'" / class="eventImage" >';
                    $eventImage = '<img src="'. $row['eventImage'] .'" / class="eventImage" >';

                    //echo $row['eventImage'];
                    echo $eventImage;

                    $eventName = $row['eventName'];
                    
                    //echo '<img src="image/' . $row['eventImage'] . '">';
                    //echo '<img src="data:image/jpeg;base64,' . base64_encode($row["eventImage"]) . '" /class="eventImage">';
                    echo "<h2>" . $eventName . "</h2><br>";
                    echo "<p><b>Company Name: </b>".$row['eventCompany']."</p><br>";
                    echo "<p>".$row['eventDesc']."</p><br>";
                    echo "<p><b>Event Date: </b>".$row['eventDateStart']." - " .$row['eventDateEnd']."</p><br>";
                    echo "<p><b>Event Time: </b>".$row['eventTime']."</p><br>";
                    echo "<p><b>Event Price: </b> RM".$row['eventPrice']."</p><br>";
                    echo "<p><b>Donate for our cause here: </b>".$row['eventAccNo']."(Maybank)</p>";

                }
            }

        ?>
        
        
    </div>
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
