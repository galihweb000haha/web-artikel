<?php 
require_once '../functions.php';
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_POST['submitWarna'])){
    $sliderM = $_POST['sliderM'];
    $sliderH = $_POST['sliderH'];
    $sliderB = $_POST['sliderB'];
    $warna = $sliderM.",".$sliderH.",".$sliderB;
    $_SESSION['warna'] = $warna;
    
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css" />    
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/styleAdmin.css" />    
    
    
</head>
<body>

    
  <!-- NAVBAR -->
<section>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
         <a class="navbar-brand" href="index.php">Dashboard</a>
             <ul class="nav justify-content-end">
                  <li class="nav-item">
                     <a class="nav-link active" href="#">
                       <img src="../assets/ico/open-book.svg"  class="icon">
                       Manual</a>
                    </li>
                   <li class="nav-item">
                   <a class="nav-link" href="preferences.php">
                <img src="../assets/ico/preferences.png"  class="icon">
                Preferences</a>
                     </li>
                     <li class="nav-item">
                      <a class="nav-link" href="../logout.php" >
              <img src="../assets/ico/logout.svg"  class="icon">  
                Logout</a>
            </li>
        </ul>
        
    </div>
</nav>
</section>

<section id="artikel">
    <div class="container">
        <div class="card" id="cardColor">
        <h5 class="card-header">Change color Theme</h5>
            <div class="card-body">

            <h3>Choose Color</h3>                
<form action="" method="post">
    <div class="kotak merah"></div>
    <input type="range" name="sliderM" id="sliderM" min="0" max="255" data-warna = 'asdads'>

    <div class="kotak hijau"></div>
    <input type="range" name="sliderH" id="sliderH" min="0" max="255">

    <div class="kotak biru"></div>
    <input type="range" name="sliderB" id="sliderB" min="0" max="255">


    <div class="modal-footer mt-3">
    <button class="btn btn-primary" name="submitWarna">Save Change</button>
    </div>
</form>            
        </div>
    </div>
</div>
</section>



<footer>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-dark mb-3 info">
            <div class="card-header">Selamat Datang</div>
                    <div class="card-body text-dark">
                        <p class="card-text">Selamat datang di Halaman Dashboard, silahkan klik manual terlebih dahulu!</p>
                    </div>
            </div>
            
        </div>
        <div class="col-md-4">
            <div class="card border-dark mb-3 info">
            <div class="card-header">About</div>
                <div class="card-body text-dark">
                     <p class="card-text">Website ini dibuat dengan bantuan toknologi bootstrap, dilengkapi dengan icon keren dari website flaticon.com </p>
                </div>
            </div>
            
        </div>
        <div class="col-md-4">
            <div class="card border-dark mb-3 info">
            <div class="card-header">Info</div>
                <div class="card-body text-dark">
                    <p class="card-text">Beberapa fitur memerlukan authentikasi dari admin, silahkan kirimkan kritik & saran ke galih11120@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>


<script>


const sliderM = document.getElementById("sliderM");
const sliderH = document.getElementById("sliderH");
const sliderB = document.getElementById("sliderB");


sliderM.addEventListener("mousedown", function(){
    const red  = sliderM.value;
    const green  = sliderH.value;
    const blue = sliderB.value;
document.body.style.backgroundColor = 'rgb('+ red +','+ green +','+ blue+')';
});

sliderH.addEventListener("mousedown", function(){
    const green  = sliderH.value;
    const red  = sliderM.value;
    const blue = sliderB.value;
document.body.style.backgroundColor = 'rgb('+ red +','+ green +','+ blue+')';
});

sliderB.addEventListener("mousedown", function(){
    const blue = sliderB.value;
    const green  = sliderH.value;
    const red  = sliderM.value;
document.body.style.backgroundColor = 'rgb('+ red +','+ green +','+ blue+')';
});




document.body.addEventListener('mousemove', function(event){
const xPos = Math.round((event.clientX / window.innerWidth) * 255);

const yPos = Math.round((event.clientY / window.innerHeight) * 255);
document.body.style.backgroundColor = 
'rgb('+xPos+','+ yPos +',100)';
});



</script>



<script src="../assets/js/jquery-3.3.1.min.js"></script>    
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/scriptAdmin.js"></script>
<script src="../assets/js/script.js"></script>

</body>
</html>