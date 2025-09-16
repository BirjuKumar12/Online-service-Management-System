<?php 
  include('../dbConnection.php');  
  session_start();

  if(!isset($_SESSION['is_login'])){
    if(isset($_REQUEST['rEmail'])){
      $rEmail = mysqli_real_escape_string($conn, trim($_REQUEST['rEmail']));
      $rPassword = mysqli_real_escape_string($conn, trim($_REQUEST['rPassword']));

      $sql = "SELECT r_email, r_password FROM requesterlogin_tb WHERE r_email='$rEmail'";
      $result = $conn->query($sql);
      if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        if(password_verify($rPassword, $row['r_password'])) { // Secure password check
          $_SESSION['is_login'] = true;
          $_SESSION['rEmail'] = $rEmail;
          echo "<script> location.href='RequesterProfile.php'; </script>";
          exit;
        } else {
          $msg = '<div class="alert alert-danger text-center mt-2">Invalid Email or Password!</div>';
        }
      } else {
        $msg = '<div class="alert alert-danger text-center mt-2">Invalid Email or Password!</div>';
      }
    }
  } else {
    echo "<script> location.href='RequesterProfile.php'; </script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Online Service Management</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      font-family: 'Arial', sans-serif;
    }
    .login-container {
      max-width: 400px;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin: 80px auto;
    }
    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-login {
      background: #2575fc;
      color: #fff;
    }
    .btn-login:hover {
      background: #1a5ecb;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>🔑 Login</h2>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" name="rEmail" placeholder="Enter your email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="rPassword" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn btn-login w-100">Login</button>
      <p class="text-center mt-3">Don't have an account? <a href="../UserRegistration.php">Sign up here</a></p>
      <?php if(isset($msg)) { echo $msg; } ?>
    </form>
  </div>
</body>
</html>
