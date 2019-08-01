<?php 
require_once '../functions.php';
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}


$hari = date('l');

function hari($hari){
    if($hari == 'Monday'){
        return "Senin";
    }elseif($hari == 'Tuesday'){
        return "Selasa";
    }elseif($hari == 'Wednesday'){
        return "Rabu";
    }elseif($hari == 'Thursday'){
        return "Kamis";
    }elseif($hari == 'Friday'){
        return "Jum'at";
    }elseif($hari == 'Saturday'){
        return "Sabtu";
    }else{
        return "Minggu";
    }
}
if(isset($_POST['submitWarna'])){
    $sliderM = $_POST['sliderM'];
    $sliderH = $_POST['sliderH'];
    $sliderB = $_POST['sliderB'];
    $warna = $sliderM.",".$sliderH.",".$sliderB;
    
    
}


$ip = $_SERVER['REMOTE_ADDR'];
 
$tanggal = date("Ymd");
$waktu = time();

$s = mysqli_query($conn, "SELECT * FROM statistik WHERE ip = '$ip' AND tanggal = '$tanggal'");

if(mysqli_num_rows($s) == 0){
    mysqli_query($conn, "INSERT INTO statistik VALUES('$ip','$tanggal',1,'$waktu')");
} else{
    mysqli_query($conn, "UPDATE statistik SET hits = hits + 1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
}
$pengunjung  = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
$totalpengunjung = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(hits) FROM statistik"));

$tothitsgbr = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(hits) FROM statistik"));

$bataswaktu = time() - 300;
$pengunjungonline = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM statistik WHERE online > '$bataswaktu'"));



$query = "SELECT * FROM statistik";
$statistik = query($query);

$warna = $_SESSION['warna'];

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
<body style="background-color:rgb("<?=$warna;?>");">

<input type="hidden" name="warna" value="<?php echo $warna;?>" id="warna">
<input type="hidden" name="hari" value="<?php echo hari($hari);?>" id="hari">
    
  <!-- NAVBAR -->
<section>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
         <a class="navbar-brand" href="#">Dashboard</a>
             <ul class="nav justify-content-end">
                  <li class="nav-item">
                     <a class="nav-link active" href="#">
                       <img src="../assets/ico/open-book.svg"  class="icon">
                       Manual</a>
                    </li>
                   <li class="nav-item">
                   <a class="nav-link" href="#">
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
           
    <div class="row">
        <div class="col-md-4 ">
            <ul class="nav flex-column">
                <li class="nav-item text-center text-muted" id="time">
                 
                </li>
                <li class="nav-item navigasi">
                  <a class="nav-link active" href="index.php" id="article">
                      <img src="../assets/ico/story.png"  class="icon">  
                    Articles</a>
                </li>
                <li class="nav-item navigasi">
                  <a class="nav-link" href="kategori.php" id="kategori" >
                      <img src="../assets/ico/list.svg"  class="icon">  
                    Kategori</a>
                </li>
                <li class="nav-item navigasi">
                  <a class="nav-link" href="documents.php" id="documentation">
                      <img src="../assets/ico/camera.svg"  class="icon">  
                    Documentations</a>
                </li>
                <li class="nav-item navigasi">
                  <a class="nav-link" href="contact.php" id="message">
                      <img src="../assets/ico/message.png"  class="icon">  
                    Messages</a>
                </li>
                <li class="nav-item navigasi">
                  <a class="nav-link" href="jadwal.php" id="schedule">
                      <img src="../assets/ico/newspaper.svg"  class="icon">  
                    Schedule</a>
                </li>
                <li class="nav-item navigasi">
                  <a class="nav-link" href="info.php" id="info">
                      <img src="../assets/ico/information.png"  class="icon">  
                    Info</a>
                </li>
                <li class="nav-item navigasi">
                  <a class="nav-link" href="statistik.php" id="statistik">
                      <img src="../assets/ico/information.png"  class="icon">  
                    Statistik</a>
                </li>
                <li class="nav-item navigasi">
                  <a class="nav-link " href="../logout.php">
                      <img src="../assets/ico/logout.svg"  class="icon">  
                    Exit</a>
                </li>
              </ul>
        </div>
        <div class="col-md-8">
        <div class="container">
            
                <h1 class="mt-4">Statistik Pengunjung</h1>

<div class="card" style="width: 18rem;">
  <div class="card-header">
    Statistik Hari Ini
    
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Hits : <?=$tothitsgbr['SUM(hits)'];?></li>
    <li class="list-group-item">Pengunjung Hari Ini : <?=$pengunjung;?></li>
    <li class="list-group-item">Total Pengunjung : <?=$totalpengunjung['COUNT(hits)'];?></li>
    <li class="list-group-item">Pengunjung Online : <?=$pengunjungonline;?></li>
  </ul>
</div>

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





<script src="../assets/js/jquery-3.3.1.min.js"></script>    
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/scriptAdmin.js"></script>
<script src="../assets/js/script.js"></script>

</body>
</html>