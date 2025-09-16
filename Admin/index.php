<?php
include('../dbConnection.php');
session_start();
if (!isset($_SESSION['is_adminlogin'])) {
    if (isset($_REQUEST['aEmail'])) {
        $aEmail = mysqli_real_escape_string($conn, trim($_REQUEST['aEmail']));
        $aPassword = mysqli_real_escape_string($conn, trim($_REQUEST['aPassword']));
        $sql = "SELECT a_email, a_password FROM adminlogin_tb WHERE a_email='$aEmail' AND a_password='$aPassword' LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $_SESSION['is_adminlogin'] = true;
            $_SESSION['aEmail'] = $aEmail;
            echo "<script> location.href='dashboard.php'; </script>";
            exit;
        } else {
            $msg = '<div class="alert alert-danger mt-2 text-center" role="alert">❌ Invalid Email or Password</div>';
        }
    }
} else {
    echo "<script> location.href='dashboard.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">

    <style>
        /* Background Styling */
        body {
            background: url('../images/admin-bg.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Glassmorphism Card */
        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            width: 350px;
            text-align: center;
        }

        /* Title Styling */
        .login-card h2 {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 20px;
        }

        /* Input Field Styling */
        .form-control {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #fff;
            border-radius: 30px;
            padding: 10px;
            text-align: center;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
        }

        /* Login Button */
        .btn-login {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 30px;
            width: 100%;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(45deg, #ff4b2b, #ff416c);
            transform: scale(1.05);
        }

        /* Back to Home Button */
        .btn-home {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px;
            border-radius: 30px;
            transition: 0.3s;
        }

        .btn-home:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        /* Icon Styling */
        .fa-user-secret {
            font-size: 50px;
            color: #ff4b2b;
        }
    </style>

    <title>Admin Login</title>
</head>

<body>
    <div class="login-card">
        <i class="fas fa-user-secret"></i>
        <h2>Admin Login</h2>

        <form action="" method="POST">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Admin Email" name="aEmail" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="aPassword" required>
            </div>
            <button type="submit" class="btn btn-login">Login</button>
            <?php if (isset($msg)) {
                echo $msg;
            } ?>
        </form>
        
        <div class="mt-3">
            <a href="../index.php" class="btn btn-home">⬅ Back to Home</a>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>

</html>
