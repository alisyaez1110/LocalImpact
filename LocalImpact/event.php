<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Event Page</title>
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
            margin-bottom: 20px; /* Add margin bottom to create space */
        }

        p {
            text-align: center;
            font-family: 'Actor';
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card img {
            max-width: 100%;
            max-height: 100%;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 300px;
            text-align: center;
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
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var navLinks = document.querySelectorAll("#nav a");

            for (var i = 0; i < navLinks.length; i++) {
                navLinks[i].addEventListener("click", function (e) {
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
        <li><a href="event.php" class="active">Event History</a></li>
        <li><a href="aboutUs.php">About Us</a></li>
        <li><a href="contactUs.php">Contact Us</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
<?php
include "config.php";

if (isset($_GET['delete'])) {
    // get value of id that sent from address bar 
    
    $eventDelete = $_GET['delete'];
    //echo $eventDelete;

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
        echo '<script>alert("Deleted Successfully")</script>';
        //echo "window.location.replace('event.php')";
    } else {
        echo "Delete ERROR";
    }
}

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    // Retrieve the logged-in username from the session
    $username = $_SESSION['username'];

    // Retrieve the business name from the company table based on the username
    $sql = "SELECT businessName FROM company WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the businessName from the result
        $row = $result->fetch_assoc();
        $eventCompany = $row['businessName'];

        // Retrieve event details from the event table based on the event company
        $sql = "SELECT eventName, eventDesc, eventImage, eventDateStart, eventDateEnd, eventPrice FROM event WHERE eventCompany = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $eventCompany);
        $stmt->execute();
        $result = $stmt->get_result();

        echo '<h2>' . $eventCompany . '</h2>';

        if ($result->num_rows > 0) {
            
            // Display event details in a card view
            echo '<div class="card-container">';

            while ($row = $result->fetch_assoc()) {

                unset($eventImage);
                $eventImage = '<img src="'. $row['eventImage'] .'" / class="event-image" >';

                echo '<div class="card">';
                echo $eventImage;
                // echo '<img src="data:image/jpeg;base64,' . base64_encode($row["eventImage"]) . '">';
                echo '<p><strong>Event Name: </strong> ' . $row["eventName"] . '</p>';
                echo '<p><strong>Description: </strong> ' . $row["eventDesc"] . '</p>';
                echo '<p><strong>Date: </strong> ' . $row["eventDateStart"] . ' until ' . $row["eventDateEnd"] . '</p>';
                echo '<p><strong>Price:</strong> RM ' . $row["eventPrice"] . '</p>';
                ?>
                <div class="button-container">
                <a href="editEvent.php?eventName=<?php echo urlencode($row['eventName']); ?>"><button>Edit Event</button></a>
                <a href="event.php?delete=<?php echo $row['eventName']; ?>"><button>Delete</button></a>
                

                

                
                
                </div>

                <?php
                echo '</div>';
            }

            echo '</div>'; // Close the card-container
        } else {
            echo "<p>No event found.</p>";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>
<div class="button-container">
    <a href="eventAddForm.php"><button>Add Event</button></a>
</div>
<div id="footer">
    &copy; 2023 Izzah Hayati. All rights reserved.
</div>
</body>
</html>
