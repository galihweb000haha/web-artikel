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
if(isset($_POST['UpdateInfo'])){
    if(UpdateInfo($_POST) > 0){
        echo "<script> alert('Info telah diUpdate!'); </script>";   
    }else{
        echo "<script> alert('maaf, ada kesalahan'); </script>";
    }
}

$query = "SELECT * FROM info";
$info = query($query);

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
         <a class="navbar-brand" href="index.php">Dashboard</a>
             <ul class="nav justify-content-end">
                  <li class="nav-item">
                     <a class="nav-link active" href="manual.php">
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
        <div class="col-md-8 mt-4">
            <div class="container">
            

            <div class="card">
                 <div class="card-header">
                    <h2>Basic Information</h2>
                 </div>
             <div class="card-body">          
              
              


               <form action="" method="post" enctype="multipart/form-data">
                <label for="nama">Nama Majelis</label>
                <input class="form-control" type="text" id="nama" name="nama" value="<?= $info[0]['nama'];?>" >
                <label for="info">Informasi Majelis</label>
                <textarea class="form-control" id="info" name="info" rows="3">
                <?=trim($info[0]['deskripsi']);?>
                </textarea>
                
                <label for="tel" class="mt-3">No. Telp</label>
                <input type="tel" class="form-control " name="tel" id="tel" value="<?=$info[0]['telp'];?>">

                <label for="alamat" class="mt-3">Alamat</label>
                <input type="text" class="form-control " name="alamat" id="alamat" value="<?=$info[0]['alamat'];?>">

                <label for="email" class="mt-3">Email</label>
                <input type="email" class="form-control " name="email" id="email" value="<?=$info[0]['email'];?>">

                <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input " id="logo" name="logo">
                    
                    <label class="custom-file-label" for="logo">Pilih Logo...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                </div>
                <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input" id="background" name="background">
                    
                    <label class="custom-file-label" for="background">Pilih gambar Background...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                </div>
                Logo :
                <div class="gambarArtikel mt-3"><img src="../assets/img/info/logo/thumbs/thumb_<?=$info[0]['logo'];?>" alt="Logo" ></div>
                Background :
                <div class="gambarArtikel mt-3"><img src="../assets/img/info/background/thumbs/thumb_<?=$info[0]['background'];?>" alt="Background" ></div>

               <button type="submit" name="UpdateInfo" class="btn btn-outline-primary mt-5 float-right">Update</button>
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