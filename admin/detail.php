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
if(isset($_POST['submit'])){
    insertArtikel($_POST);
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $type = $_GET['type'];
}
if($type == 'artikel'){
    
    $query = "SELECT user.nama_pengguna, kategori.kategori, artikel.judul_artikel, artikel.waktu_artikel, artikel.isi_artikel,artikel.gambar_artikel FROM artikel INNER JOIN kategori ON kategori.id_kategori=artikel.id_kategori INNER JOIN user ON user.id_user=artikel.id_user WHERE artikel.id_artikel=$id";
    $artikel = query($query);    

} elseif ($type == 'kontak') {
    $query = "SELECT * FROM kontak WHERE id_pengirim = $id";
    $kontak = query($query);
    
    
}else{

}



$query = "SELECT * FROM kategori";
$kategori = query($query);

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
        <div class="col-md-4 navigasi">
            <ul class="nav flex-column">
                <li class="nav-item text-center text-muted" id="time">
                 
                 </li>
                <li class="nav-item navigasi">
                  <a class="nav-link" href="index.php" id="article">
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

        <div class="card mb-3">
<?php if($type == 'artikel') :?>
             <img class="card-img-top" src="../assets/img/artikel/<?=$artikel[0]['gambar_artikel'];?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$artikel[0]['judul_artikel'];?></h5>
                    <p class="card-text"><?=$artikel[0]['isi_artikel'];?></p>
                    <p class="card-text">
                    <small class="text-muted">
                      <img src="../assets/ico/time.png" alt="" class="icon">
                        <?="Last update ". $artikel[0]['waktu_artikel'];?>
                    </small>
                  </p>
                    <p class="card-text">
                      <small class="text-muted">
                        <img src="../assets/ico/folder.png" class="icon">
                         <?=$artikel[0]['kategori'];?>
                      </small>
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                          <img src="../assets/ico/user.png" class="icon">
                           <?='Posted by '.$artikel[0]['nama_pengguna'];?>
                        </small>
                    </p>
               </div>
<?php elseif($type == 'kontak') :  ?>


 <div class="card">
  <div class="card-header">
    <?=$kontak[0]['nama_pengirim'];?>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><?=$kontak[0]['isi_pesan']; ?></p>
      <div class="blockquote-footer"><?=$kontak[0]['email'];?></footer>
    </blockquote>
  </div>
</div>




<?php endif; ?>
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