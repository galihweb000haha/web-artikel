<?php
require_once "functions.php";

if(isset($_SESSION['login'])){
  header("Location: admin");
  exit;
}


if(isset($_POST['submit'])){
  if(login($_POST) > 0){
    $_SESSION['login'] = true;
    header("Location: admin");
  }else{
    echo mysqli_error($conn);
    // echo "<script> alert('Username / Password salah');</script>";
  }
}


	
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" /> 
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/styleLogin.css" />    
      
    
</head>
<body>


  <div class="container">
    
    <h1 class="text-center mt-3">Selamat Datang di Danger Zone</h1>
    <h6 class="text-center mt-4 text-muted">Oleh : Galih F.s.</h6>
  
  </div>
<div class="cardLogin">
  <div class="card-body">
    <form method="post" action="">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Username" name="username" autocomplete="off">
        <small id="usernameHelp" class="form-text text-muted">Username is case insensitive.</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password"  autocomplete="off" name="password">
      </div>
      <img src="captcha.php" class="captcha mb-2">
      <label for="pin">Masukan kode disamping</label>
      <input type="text" class="form-control" name="pin" id="pin">
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="document.location.href='index.php';">Kembali</button>
        <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
</div>


  </div>
</div>




<!-- The content of your page would go here. -->
<footer class="footer-distributed">
            <div class="footer-left">
                <h3>Company<span>logo</span></h3>
                <p class="footer-links">
                    <a href="#">Home</a>
                    ·
                    <a href="#">Blog</a>
                    ·
                    <a href="#">Pricing</a>
                    ·
                    <a href="#">About</a>
                    ·
                    <a href="#">Faq</a>
                    ·
                    <a href="#">Contact</a>
                </p>
                <p class="footer-company-name">Company Name &copy; 2017</p>
            </div>
            <div class="footer-center">
                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><span>21 Revolution Street</span> Paris, France</p>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p>+1 555 123456</p>
                </div>
                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:support@company.com">support@company.com</a></p>
                </div>
            </div>
            <div class="footer-right">
                <p class="footer-company-about">
                    <span>About the company</span>
                    Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
                </p>
                <div class="footer-icons">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                </div>
            </div>
        </footer>


<script src="assets/js/jquery-3.3.1.min.js"></script>    
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>