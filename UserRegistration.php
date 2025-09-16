<?php 
  include('dbConnection.php');

  if(isset($_REQUEST['rSignup'])){
    if(($_REQUEST['rName'] == "") || ($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == "")){
      $regmsg = '<div class="alert alert-danger mt-2 text-center" role="alert">All fields are required!</div>';
    } else {
      $sql = "SELECT r_email FROM requesterlogin_tb WHERE r_email='".$_REQUEST['rEmail']."'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        $regmsg = '<div class="alert alert-warning mt-2 text-center" role="alert">Email ID Already Registered!</div>';
      } else {
        $rName = $_REQUEST['rName'];
        $rEmail = $_REQUEST['rEmail'];
        $rPassword = password_hash($_REQUEST['rPassword'], PASSWORD_BCRYPT); // More secure password hashing
        $sql = "INSERT INTO requesterlogin_tb (r_name, r_email, r_password) VALUES ('$rName', '$rEmail', '$rPassword')";
        if($conn->query($sql) == TRUE){
          $regmsg = '<div class="alert alert-success mt-2 text-center" role="alert">Account Successfully Created!</div>';
        } else {
          $regmsg = '<div class="alert alert-danger mt-2 text-center" role="alert">Error: Unable to create account!</div>';
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup | Online Service Management</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      font-family: 'Arial', sans-serif;
    }
    .signup-container {
      max-width: 400px;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin: 80px auto;
    }
    .signup-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-signup {
      background: #2575fc;
      color: #fff;
    }
    .btn-signup:hover {
      background: #1a5ecb;
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <h2>🔐 Create an Account</h2>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" name="rName" placeholder="Enter your name">
      </div>
      <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" name="rEmail" placeholder="Enter your email">
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="rPassword" placeholder="Create a password">
      </div>
      <button type="submit" class="btn btn-signup w-100" name="rSignup">Sign Up</button>
      <p class="text-center mt-3">Already have an account? <a href="Requester/RequesterLogin.php">Login here</a></p>
      <?php if(isset($regmsg)) { echo $regmsg; } ?>
    </form>
  </div>
</body>
</html>
