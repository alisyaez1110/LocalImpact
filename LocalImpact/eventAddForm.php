<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <title>Add Event Page</title>
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
        }
        input[type="text"],
        input[type="eventCompany"],
        input[type="eventName"],
        input[type="eventDesc"],
        input[type="eventStartDate"],
        input[type="eventEndDate"],
        input[type="eventTime"],
        input[type="file"],
        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        textarea,
        select {
            height: 300px;
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        .datepicker {
            display: none;
        }
        .calendar-icon {
            position: relative;
            margin-left: 5px;
            cursor: pointer;
        }
        #eventDateStartCalendar,
        #eventDateEndCalendar {
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            justify-content: center;
            margin-right: 10px;
            margin-bottom: 40px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
  <script>
    $(document).ready(function() {

        var startDate;
        var endDate;
        
        $( "#eventDateStart" ).datepicker({
        dateFormat: 'yy-mm-dd'
        });

        $( "#eventDateEnd" ).datepicker({
        dateFormat: 'yy-mm-dd'
        });
        
        $('#eventDateStart').change(function() {
        startDate = $(this).datepicker('getDate');
        $("#eventDateStart").datepicker("option", "minDate", startDate );
        });

        $('#eventDateEnd').change(function() {
        endDate = $(this).datepicker('getDate');
        $("#eventDateEnd").datepicker("option", "maxDate", endDate );
        });

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

    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {

        // Retrieve the logged-in username from the session
        $username = $_SESSION['username'];

        // Retrieve the business name from the user table based on the username
        $sql = "SELECT businessName FROM company WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            // Fetch the businessName from the result
            $row = $result->fetch_assoc();
            $eventCompany = $row['businessName'];

            echo "<form id='update' method='POST' action='eventAdd.php' enctype='multipart/form-data'>";

                    echo '<h2>'.$eventCompany.'</h2>';

                    echo '<p><strong>Event Company:</strong> '.$eventCompany.'</p>';

                    echo "<label for='eventName'><strong>Event Name:</strong></label>";
                    echo "<input type='text' id='eventName' name='eventName' required>";

                    echo "<label for='eventDesc'><strong>Event Description:</strong></label>";
                    echo "<textarea id='eventDesc' name='eventDesc' required></textarea>";

                    echo "<label for='eventImage'><strong>Event Image:</strong></label>";
                    echo "<input type='file' id='eventImage' name='eventImage'>";

                    echo "<label for='eventDateStart'><strong>Date: Start Date </strong></label>";
                    echo "<input type='text' id='eventDateStart' name='eventDateStart' required>";

                    echo "<label for='eventDateEnd'><strong>Date: End Date </strong></label>";
                    echo "<input type='text' id='eventDateEnd' name='eventDateEnd' required>";

                    echo "<label for='eventTime'><strong>Event Time: (HH:MM:SS)</strong></label>";
                    echo "<input type='text' id='eventTime' name='eventTime' required>";

                    echo "<label for='eventPrice'><strong>Event Price per Person:</strong></label>";
                    echo "<input type='text' id='eventPrice' name='eventPrice' required>";

                    echo "<label for='eventAccNo'><strong>Event Account Number:</strong></label>";
                    echo "<input type='text' id='eventAccNo' name='eventAccNo' required>";

                    echo "<div class='button-container'>";
                    echo "<button type='submit' name='update'>Save</button>";
                    echo "</div>";
                    echo "</form>";

            // Close the statement
            $stmt->close();
        } else {
            echo "No business profile found for the logged-in user.";
        }

        // Close the database connection
        $conn->close();
    }
    ?>
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>