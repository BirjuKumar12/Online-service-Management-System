<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


  <title>E-SERVIFY - Online Service Management</title>
</head>

<body>
  <!-- Start Navigation -->
 <!-- Start Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
    <a href="index.php" class="navbar-brand font-weight-bold">E-SERVIFY</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myMenu">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#Services" class="nav-link">Services</a></li>
        <li class="nav-item"><a href="#registration" class="nav-link">Registration</a></li>
        <li class="nav-item"><a href="Requester/RequesterLogin.php" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="Admin/index.php" class="nav-link font-weight-bold text-warning">Admin Login</a></li> 
        <li class="nav-item"><a href="#Contact" class="nav-link">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navigation -->

  <!-- End Navigation -->

  <!-- Hero Section -->
  <header class="jumbotron back-image text-center text-white" style="background-image: url('images/background.jpg');">
    <div class="container py-5">
      <h1 class="display-4 font-weight-bold">Welcome to E-SERVIFY</h1>
      <p class="lead">Customer's Happiness is our Aim</p>
      <a href="Requester/RequesterLogin.php" class="btn btn-light btn-lg">Login</a>
      <a href="UserRegistration.php" class="btn btn-danger btn-lg">Sign Up</a>
    </div>
  </header>
  <!-- End Hero Section -->

  <!-- About Us Section -->
  <div class="container my-5">
    <div class="jumbotron bg-light">
      <h2 class="text-center">About E-SERVIFY</h2>
      <p class="text-center">India’s leading chain of multi-brand Electronics and Electrical service workshops offering a wide range of services. Our goal is to provide high-quality service and customer satisfaction.</p>
    </div>
  </div>
  <!-- End About Us Section -->

  <!-- Start Services -->
  <div class="container text-center" id="Services">
    <h2>Our Services</h2>
    <div class="row mt-4">
      <div class="col-md-4 mb-4">
        <i class="fas fa-tv fa-7x text-success"></i>
        <h4 class="mt-3">Electronic Appliances</h4>
      </div>
      <div class="col-md-4 mb-4">
        <i class="fas fa-tools fa-7x text-primary"></i>
        <h4 class="mt-3">Preventive Maintenance</h4>
      </div>
      <div class="col-md-4 mb-4">
        <i class="fas fa-cogs fa-7x text-info"></i>
        <h4 class="mt-3">Fault Repair</h4>
      </div>
    </div>
  </div>
  <!-- End Services -->

  <!-- Customer Reviews -->
  <div class="jumbotron bg-dark text-white text-center">
    <h2>Happy Customers</h2>
    <div class="row mt-4">
      <div class="images/imagess.webp">
        <img src="images/avatar1.jpg" class="rounded-circle" width="100">
        <h5>Birju Kumar</h5>
        <p>Excellent service and support!</p>
      </div>
      <div class="C:\xampp\htdocs\OSMS\images\Young_woman_working_as_a_software_developer_1600x1200.jpg">
        <img src="images/avatar2.jpg" class="rounded-circle" width="100">
        <h5>sonam kumari</h5>
        <p>Very professional and timely service.</p>
      </div>
      <div class="col-md-3">
        <img src="images/avatar3.jpg" class="rounded-circle" width="100">
        <h5>Amit</h5>
        <p>Highly recommend E-SERVIFY!</p>
      </div>
      <div class="col-md-3">
        <img src="images/avatar4.jpg" class="rounded-circle" width="100">
        <h5>Vishal Sinha</h5>
        <p>Great experience overall.</p>
      </div>
    </div>
  </div>
  <!-- End Customer Reviews -->

  <!-- Contact Section -->
  <div class="container" id="Contact">
    <h2 class="text-center">Contact Us</h2>
    <div class="row">
      <div class="col-md-6">
        <p><strong>Head Office:</strong><br>E-SERVIFY Pvt Ltd, gurugram, railway - 751024<br>Phone: +9608328632</p>
      </div>
      <div class="col-md-6">
        <p><strong>Branch Office:</strong><br> gurugram railwaye - 751024<br>Phone: +00000000</p>
      </div>
    </div>
  </div>
  <!-- End Contact Section -->

  <!-- Footer -->
  <footer class="container-fluid bg-primary text-white text-center py-3 mt-5">
    <p>&copy; 2025 E-SERVIFY | Designed with ❤️ || Developed By @Birju Kumar</p>
  </footer>
  <!-- End Footer -->

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>