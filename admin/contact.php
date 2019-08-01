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
    if(sendMessage($_POST)){
        echo '<script>alert("pesan sedang dikirim");</script>';

    }else{
        echo '<script>alert("pesan tidak terkirim");</script>';
    }
}

// $query = "SELECT * FROM artikel";
// $artikel = query($query);


// $query = "SELECT * FROM kategori";
// $kategori = query($query);

$query = "SELECT * FROM kontak";
$kontak = query($query);

if(isset($_SESSION['warna'])){
    $warna = $_SESSION['warna'];
}else{
    $warna = false;
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
                <h1 class="mt-4">Contact</h1>


            <button type="button" class="btn btn-secondary btn-lg mb-2 " data-toggle="modal" data-target="#exampleModalCenter">
                <img src="../assets/ico/story.png"  class="icon">  
                Send Message
            </button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Kirim Pesan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        
      <div class="form-group">
      <form action="" method="post" >                  
         

        <div class="form-group">
              <label for="penerima">Pilih Penerima</label>
                  <select class="form-control" id="penerima" name="penerima">
                  <?php foreach($kontak as $r) :?>
                    <option value="<?=$r['email'];?>"><?=$r['nama_pengirim'];?></option>
                  <?php endforeach; ?>
                 </select>
        </div>
         
        <label for="subject">Subject</label>
        <input class="form-control" type="text" placeholder="Default input" id="subject" name="subject">


          <label for="isiPesan">Pesan</label>
          <textarea class="form-control" id="isiPesan" name="isiPesan" rows="3"></textarea>
          
         
        
  




     </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</div>

                    <div id="content">
                        <ul class="list-group ">
                        <?php foreach($kontak as $r) :?>
                            <li class="list-group-item">
                                <?= $r['nama_pengirim'];?>
                                <a href="hapus.php?id=<?=$r['id_pengirim'];?>&type=kontak" class="badge float-right"  onclick="return confirm('apakah anda yakin?');">
                                    <img src="../assets/ico/delete.png"  class="icon">  
                                </a>
                                
                                <a href="detail.php?id=<?=$r['id_pengirim'];?>&type=kontak" class="badge float-right">
                                    <img src="../assets/ico/eye.png"  class="icon">  
                                </a>
                            </li>
                        <?php endforeach; ?>
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