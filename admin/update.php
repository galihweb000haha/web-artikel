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

$id = $_GET['id'];
$type = $_GET['type'];

if(isset($_POST['submitKategori'])){
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
 var_dump($kategori);
    mysqli_query($conn, "UPDATE kategori SET kategori = '$kategori' WHERE id_kategori = $id");
    if(mysqli_affected_rows($conn)){
        echo "<script> alert('kategori telah diubah'); </script>";
    } else{
        echo "<script> alert('kategori tidak diubah'); </script>";
    }
    
}
if(isset($_POST['submitArtikel'])){
    $judul_artikel = $_POST['judulArtikel'];
    $isiArtikel = $_POST['isiArtikel'];
    $kategori = $_POST['kategori'];
    $namaBaru = upload();
    if(!$namaBaru){
    mysqli_query($conn, "UPDATE artikel SET judul_artikel = '$judul_artikel', isi_artikel = '$isiArtikel' , id_kategori = $kategori , waktu_artikel = NOW() WHERE id_artikel = $id");
    } else {
    $result = mysqli_query($conn, "SELECT gambar_artikel FROM artikel WHERE id_artikel = $id");
    $row = mysqli_fetch_assoc($result);
    $file =  $row['gambar_artikel'];

    
        if(file_exists("../assets/img/artikel/$file")){
        unlink("../assets/img/artikel/$file"); 
        
        }
        if(file_exists("../assets/img/artikel/thumbs/thumb_$file")){      
        unlink("../assets/img/artikel/thumbs/thumb_$file");
        }

    mysqli_query($conn, "UPDATE artikel SET judul_artikel = '$judul_artikel', isi_artikel = '$isiArtikel' , id_kategori = $kategori, gambar_artikel = '$namaBaru', waktu_artikel = NOW() WHERE id_artikel = $id");
    
    
    
    }
}



   
    if($type == 'kategori'){
        $query = "SELECT * FROM kategori WHERE id_kategori = $id";
        $kategori = query($query);
    } elseif($type == 'artikel'){
        $query = "SELECT * FROM artikel INNER JOIN kategori ON artikel.id_kategori=kategori.id_kategori WHERE artikel.id_artikel = $id";
        $artikel = query($query);
        
        $query = "SELECT * FROM kategori";
        $kategori = query($query);
    }
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
        <div class="col-md-8 mt-4"">
        <div class="container">
            <?php if($type == 'kategori') :?>
            <form action="" method="post">
            <div class="card">
                 <div class="card-header">
               Ubah Kategori
                 </div>
               <div class="card-body">
               
               <input class="form-control" name="kategori" type="text" value="<?=$kategori[0]['kategori'];?>">
               <button type="submit" name="submitKategori" class="btn btn-outline-primary mt-4">Update</button>
              </div>
            </div>
            </form>
            <?php elseif($type == 'artikel') : ?>
            <div class="card">
                 <div class="card-header">
               Ubah Artikel
                 </div>
               <div class="card-body">          
              
              


               <form action="" method="post" enctype="multipart/form-data">
                <label for="judulArtikel">Judul Artikel</label>
                <input class="form-control" type="text" id="judulArtikel" name="judulArtikel" value="<?=$artikel[0]['judul_artikel'];?>">
                <label for="isiArtikel">Isi Artikel</label>
                <textarea class="form-control" id="tinymceriobermano" name="isiArtikel" rows="3">
                <?=trim($artikel[0]['isi_artikel']);?>
                </textarea>
                
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                        <select class="form-control" id="kategori" name="kategori">
                        <option selected value="<?=$artikel[0]['id_kategori'];?>"><?=$artikel[0]['kategori'];?></option>
                        <?php foreach($kategori as $r) :?>
                            <option value="<?=$r['id_kategori'];?>"><?=$r['kategori'];?></option>
                        <?php endforeach; ?>
                        </select>
                </div>
                
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                    <div class="gambarArtikel mt-3"><img src="../assets/img/artikel/thumbs/thumb_<?=$artikel[0]['gambar_artikel'];?>" alt="Gambar Artikel" ></div>
                    <label class="custom-file-label" for="gambar">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                </div>





               <button type="submit" name="submitArtikel" class="btn btn-lg btn-outline-primary mt-6 float-right" id="tmblUpdate">Update</button>
               
              </div>
            <?php endif;?>

            
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

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script src="../assets/js/jquery-3.3.1.min.js"></script>    
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/scriptAdmin.js"></script>
<script src="../assets/js/script.js"></script>
<script>
tinymce.init({
    selector: '#tinymceriobermano'
});
</script>

</body>
</html>