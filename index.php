<?php
 require 'createdb.php';
// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_TDROB4t5s';
$databasePassword = 'TDROB4t5s';
$dbname = "u488180748_TDROB4t5s";


// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the username and password match a record in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["username"];
    $password = $_POST["password"];
    $recaptchaResponse = $_POST["g-recaptcha-response"];

    // Verify reCAPTCHA
    $recaptchaSecretKey = "6Lf6r8MoAAAAAMqOMUNzyQ--QoeMTyeUcSeBHFCO";
    $recaptchaVerifyUrl = "https://www.google.com/recaptcha/api/siteverify";
        $recaptchaVerifyData = [
            'secret' => $recaptchaSecretKey,
            'response' => $recaptchaResponse,
        ];
        
        $recaptchaVerifyOptions = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($recaptchaVerifyData),
            ],
        ];
        
        $recaptchaVerifyContext = stream_context_create($recaptchaVerifyOptions);
        $recaptchaVerifyResult = file_get_contents($recaptchaVerifyUrl, false, $recaptchaVerifyContext);
        
    $recaptchaVerifyData = json_decode($recaptchaVerifyResult);

    if ($recaptchaVerifyData->success) {
        $sql = "SELECT user_id FROM officer WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            // Successful login, redirect to a dashboard page
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['user_id'];
    
            // Use JavaScript to display an alert and then redirect
            echo '<script>alert("Officer Login successful. Click OK to proceed to the home page.");
                  window.location.href = "officer.php";</script>';
            exit();
        }
        else{

        $sql = "SELECT user_id FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Successful login, redirect to a dashboard page
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];

        // Use JavaScript to display an alert and then redirect
        echo '<script>alert("Admin Login successful. Click OK to proceed to the home page.");
              window.location.href = "admin.php";</script>';
        exit();
    } else {
        echo '<script>alert("Invalid email or password.");</script>';
    }
}
    } else {
        // reCAPTCHA verification failed, display an error
        echo '<script>alert("reCAPTCHA verification failed.");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-TYpe" content="text/html; charset=utf-8">
    <meta name="description" content="Transportation Development Regulatory Office">
    <meta name="keywords" content="Transportation Development Regulatory Office">
    <title>TDRO | Please Sign in</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" href="/img/logo.png" />

</head>
<body>

<div class="container py-5 h-100" style= background: #0c2727: >
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col col-xl-10">
<div class="card" style="border-radius: 1rem;">
<div class="row g-0">

<div class="col-md-6 col-lg-5 d-none d-md-block position-relative">
<div class="position-absolute top-50 start-50 translate-middle" style="width: 400px !important; margin-left: 20px !important">
<img src="img/logo.png" class="img-fluid" alt="TDRO Logo">
</div> </div>

<div class="col-md-6 col-lg-7 d-flex align-items-center">
<div class="card-body p-4 p-lg-5 text-black" style=>
								
<div class="d-flex align-items-center mb-3 pb-1">
    <div class="col-md-4 d-flex justify-content-end">
        <img src="img/Background.png" class="img-fluid" style="width: 100px !important; padding-right: 20px" alt="BatangasLogo">
    </div>
    <div class="col-md-4 text-center">
        <span class="h1 fw-bold mb-0">Log In</span>
    </div>
    <div class="col-md-4 d-flex justify-content-start">
        <img src="img/magkatuwang.jpg" class="img-fluid" style="width: 100px !important; padding-left: 20px" alt="Magkatuwang tayo logo">
    </div>
</div>

<form method="POST">
<!-- Email input -->
<div class="form-outline mb-4">
<i class="fas fa-user-alt trailing"></i>
<input type="text" id="username" name="username" class="form-control form-control-lg border form-icon-trailing" required="">
<label class="form-label" for="username">Username</label>
</div>

<!-- Password input -->
<div class="form-outline mb-4">
<i class="fas fa-lock trailing"></i>
<input type="password" id="password" name="password" class="form-control form-control-lg border form-icon-trailing" required="">
<label class="form-label" for="password">Password</label>
</div>

<div class="g-recaptcha" style="margin: auto; width: 55%; " data-sitekey="6Lf6r8MoAAAAALP1tP3pRrAbie3dWG1iRexIkK-a"></div>

<div class="d-flex justify-content-around align-items-center mb-4">
										

</div>

<!-- Submit button -->
<button class="btn btn-primary btn-lg btn-block" type="submit" style="background-color: #1054d4">Log In
</button>


<button class="btn btn-primary btn-lg btn-block" type="button" onclick="gotoPage(event)" style="background-color: #1054d4"> Check Violation (For Drivers) </button>		
<div class="divider d-flex align-items-center my-4">
<a href="#!" class="small text-muted">Copyright © 2023 Transportation Development Regulatory Office. All Rights Reserved </a>
</form>


</div>
									

</div>
</div>	

</div>
</div>
</div>
</div>
</div>

</body>
</body>
<script>
  function gotoPage(event) {
    // Redirect to your PHP file
    window.location.href = 'user.php';
    event.preventDefault();

    console.log("lol");
  }
</script>
<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>
</html>