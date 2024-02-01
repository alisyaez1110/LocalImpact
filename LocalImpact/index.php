<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
    <title>Welcome Page</title>
    
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
    <script>

    // Function to change the form heading based on active tab
    function changeHeading(tabName) {
      const formHeading = document.getElementById("formHeading");
      formHeading.innerText = tabName;
    }

    function displaySuccess() {

    alert("Registration success.");
    }
    </script>
</head>
<body>
    <div class="container">
        <h1 id="formHeading" class="form-heading">Registration</h1>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="register-tab" data-bs-toggle="tab" href="#register" onclick="changeHeading('Registration')">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="login-tab" data-bs-toggle="tab" href="#login" onclick="changeHeading('Login')">Login</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="register">
                <form id="registerForm" action="register.php" method="post">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" required>
                            <label class="form-check-label" for="genderMale">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" required>
                            <label class="form-check-label" for="genderFemale">Female</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" >Register</button>
                </form>
            </div>
            <div class="tab-pane fade" id="login">
                <form id="loginForm" action="login.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>

        <br><center><a href="publicOrganization.php" >Return to Homepage</a></center>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
