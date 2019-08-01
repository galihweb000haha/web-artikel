<?php 
require_once '../functions.php';
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
$warna = $_SESSION['warna'];


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
    $kategori = strip_tags($_POST['kategori']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    mysqli_query($conn, "INSERT INTO kategori VALUES('','$kategori')");
    if(mysqli_affected_rows($conn)){
        echo "<script> alert('kategori baru telah ditambahkan!'); </script>";
    }
}
$query = "SELECT * FROM kategori";
$kategori = query($query);
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css" />    
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/styleAdmin.css" />    
    
    
</head>
<body>
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
                <h1 class="mt-4">Category</h1>


            <button type="button" class="btn btn-secondary btn-lg mb-2 " data-toggle="modal" data-target="#exampleModalCenter">
                <img src="../assets/ico/story.png"  class="icon">  
                Create Category
            </button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
      <input class="form-control" type="text" placeholder="Category" name="kategori">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>



                    <div id="content">
                        <ul class="list-group ">
                        <?php foreach($kategori as $r) : ?>
                            <li class="list-group-item">
                               <?= $r['kategori'];?>
                                <a href="hapus.php?id=<?=$r['id_kategori'];?>&type=kategori" class="badge float-right"  onclick="return confirm('Menghapus kategori juga akan menghapus artikel yang memiliki kategori ini, apakah anda yakin?');">
                                    <img src="../assets/ico/delete.png"  class="icon">  
                                </a>
                                <a href="update.php?id=<?=$r['id_kategori'];?>&type=kategori" class="badge float-right">
                                    <img src="../assets/ico/pencil.png"  class="icon">  
                                </a>
                              
                                
                            </li>    
                        
                        <?php endforeach;?>                       
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