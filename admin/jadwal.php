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
    if(insertJadwal($_POST) > 0 ){
        echo "<script>alert('Success');</script>";
    }else{
        echo "<script>alert('Falied');</script>";
    }
}

$query = "SELECT * FROM jadwal";
$jadwal = query($query);


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
    <link rel="stylesheet" href="http://cdn.jsdelivr.net/timepicker/latest/timepicker.min.css">
    
    
</head>
<body style="background-color:rgb("<?=$warna;?>");">

<input type="hidden" name="hari" value="<?php echo hari($hari);?>" id="hari">
<input type="hidden" name="warna" value="<?php echo $warna;?>" id="warna">
    
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
        <div class="col-md-8">
        <div class="container">
            
                <h1 class="mt-4">Schedule</h1>
                

             <button type="button" class="btn btn-secondary btn-lg mb-2 " data-toggle="modal" data-target="#exampleModalCenter">
                <img src="../assets/ico/story.png"  class="icon">  
                Create Event
            </button>


<div class="card">
  <div class="card-body">
<table class="table table-striped">
    <thead>
        <th>No</th>
        <th>Acara</th>
        <th>Waktu</th>
        <th>Jam</th>
        <th>Lokasi</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach($jadwal as $r) :?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$r['acara'];?></td>
            <td><?=$r['waktu'];?></td>
            <td><?=$r['jam'];?></td>
            <td><?=$r['lokasi'];?></td>
            <td><?=$r['deskripsi'];?></td>
            <td><a href="hapus.php?id=<?=$r['id_acara'];?>&type=acara" onclick="return confirm('apakah anda yakin?');">Hapus</a></td>
            
        </tr>
        <?php $i++;?>
    <?php endforeach;?>
        </tbody>
    </table>
  </div>
</div>


                </div>
            </div>
        </div>
</section>




<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Buat Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        
      <div class="form-group">
      <form action="" method="post" enctype="multipart/form-data">
        <label for="acara">Acara</label>
        <input class="form-control" type="text" id="acara" name="acara">
        <label for="lokasi">Lokasi</label>
        <input class="form-control" type="text" id="lokasi" name="lokasi">
          <label for="deskripsi">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
          <label for="waktu">Waktu</label>
        <input type="date" name="waktu" id="waktu">
        <input type="time" name="jam" id="time">

     </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- akhir Modal -->


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
<script src="http://cdn.jsdelivr.net/timepicker/latest/timepicker.min.css"></script>
<script>
var timepicker = new TimePicker('time', {
    lang: 'en',
    theme: 'dark'
});
timepicker.on('change', function(evt){
    var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    evt.element.value = value;
});

</script>

</body>
</html>