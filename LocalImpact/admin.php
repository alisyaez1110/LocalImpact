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
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-bottom: 25px;
        }
        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        .user-details button {
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
            <li><a href="admin.php" class="active">User Details</a></li>
            <li><a href="adminBusiness.php">Business Details</a></li>
            <li><a href="eventAdmin.php">Event Details</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="user-details"> <!-- Moved the class to the outer div -->
    
        <?php
            session_start();
            include "config.php";


            if (isset($_GET['delete'])) {
                // get value of id that sent from address bar 
                
                $username = $_GET['delete'];
                
                //echo $username;
            
                // Delete data in mysql from row that has this id 
                //$sql = "DELETE FROM user WHERE username='".$username."'"; -- works
                $sql = "DELETE user, company, event
                FROM user
                LEFT JOIN company ON user.username = company.username
                LEFT JOIN event ON company.businessName = event.eventCompany
                WHERE user.username = '$username'";


                $result = $conn->query($sql);

                
            
                // if successfully deleted
                if ($result){
                    
                    echo '<script>alert("Deleted Successfully")</script>';
                } else {
                    echo "Delete ERROR";
                }
            }

            // Retrieve user details from the database
            
            $sql = "SELECT * FROM user";
            $result = $conn->query($sql);

            echo "<table border = 1px>";
            echo "<tr>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Username</th>";
                //echo "<th>Business Name</th>";
                echo "<th>Gender</th>";
                echo "<th>Email</th>";
                echo "<th>Phone</th>";
                echo "<th>Action</th>";
            echo "</tr>";

            if ($result->num_rows > 0) {
                // Display user details in a table
                
                while ($row = $result->fetch_assoc()) {

                    $username = $row['username'];

                    
                    echo "<tr>";
                    echo "<td>".$row["firstName"]."</td>";
                    echo "<td>".$row["lastName"]."</td>";
                    echo "<td>".$username."</td>";
                    //echo "<td>".$row["businessName"]."</td>";
                    echo "<td>".$row["gender"]."</td>";
                    echo "<td>".$row["email"]."</td>";
                    echo "<td>".$row["phone"]."</td>";
                    echo "<td><button onclick= location.href='admin.php?delete=$username'>Delete</button></td>";
                    echo "</tr>";
                    

                }
                echo "</table>";
            } else {
                echo "No users found.";
            }

            // Close the database connection
            $conn->close();
        ?>
        <br><br>
        
    </div>
    <!-- <div class="button-container">
            <a href="userEdit.php"><button>Edit</button></a>
    </div> -->
    <div id="footer">
        &copy; 2023 Izzah Hayati. All rights reserved.
    </div>
</body>
</html>
