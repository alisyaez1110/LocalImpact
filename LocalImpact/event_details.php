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



    <div class="event-details">
        <?php

            session_start();
            include "config.php";

            if (!empty($_GET['delete'])) {
                // get value of id that sent from address bar 
                
                $eventDelete = $_GET['delete']; //gets eventName from delete button
                //echo $eventDelete;

                //echo "is this thing even working";
            
                // //Delete data in mysql from row that has this id 
                $sql = "DELETE FROM event WHERE eventName='".$eventDelete."'";
                // // $sql = "DELETE user, company, event
                // // FROM user
                // // JOIN company ON user.username = company.username
                // // JOIN event ON company.companyName = event.eventCompany
                // // WHERE user.username = '".$username_delete."'";
                $result = $conn->query($sql);
            
                // if successfully deleted
                if ($result){
                    
                    echo '
                    <script type="text/javascript">
                        alert("Delete Successful!"); 
                        window.location.href = "eventAdmin.php";</script>';
                } else {
                    echo "Delete ERROR";
                }

                
            }

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

                    echo '<div class="button-container">';
                    //echo "<button onclick= location.href='event_details.php?delete=".$eventName."'>Delete</button>";
                    echo '<a href="event_details.php?delete='.$eventName.'"><button>Delete</button></a>';
                    //echo "<a href='eventAdmin.php?delete=  $eventName '>Delete</a>";
                    //echo '<a href="eventAdmin.php?delete=' . $row['eventName'] . '"><button>Delete</button></a>';
                    
                    //echo "<button onclick =location.href='event_details.php?remove=".$eventName."'>Delete</button>";
                    echo '</div>';

                }
            }

        ?>
        
        
    </div>
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
