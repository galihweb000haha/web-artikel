<?php
require_once 'functions.php';
if(isset($_SESSION['login'])){
  header("Location: admin");
  exit;
}






$query = "SELECT * FROM kategori";
$kategori = query($query);



$query = "SELECT * FROM artikel";
$artikel = query($query);

$jumlahDataPerHalaman = 6;
$jumlahData = count($artikel);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;

$awalData = ($halamanAktif * $jumlahDataPerHalaman) - $jumlahDataPerHalaman;


if(isset($_POST['submit'])){
  $keyword = $_POST['keyword'];
  $query = "SELECT user.nama_pengguna, kategori.kategori, artikel.judul_artikel, artikel.waktu_artikel, artikel.id_artikel, artikel.isi_artikel,artikel.gambar_artikel FROM artikel INNER JOIN kategori ON kategori.id_kategori=artikel.id_kategori INNER JOIN user ON user.id_user=artikel.id_user WHERE judul_artikel LIKE '%$keyword%' ORDER BY id_artikel DESC LIMIT $awalData,$jumlahDataPerHalaman";

} elseif(isset($_GET['kategori'])) {
  $kategoriTerpilih = mysqli_real_escape_string($conn, $_GET['kategori']);
  $query = "SELECT user.nama_pengguna, kategori.kategori, artikel.judul_artikel, artikel.waktu_artikel, artikel.id_artikel,artikel.isi_artikel,artikel.gambar_artikel FROM artikel INNER JOIN kategori ON kategori.id_kategori=artikel.id_kategori INNER JOIN user ON user.id_user=artikel.id_user WHERE kategori = '$kategoriTerpilih' ORDER BY id_artikel DESC LIMIT $awalData,$jumlahDataPerHalaman";

} else {

  $query = "SELECT user.nama_pengguna, kategori.kategori, artikel.judul_artikel, artikel.waktu_artikel, artikel.id_artikel, artikel.isi_artikel,artikel.gambar_artikel FROM artikel INNER JOIN kategori ON kategori.id_kategori=artikel.id_kategori INNER JOIN user ON user.id_user=artikel.id_user ORDER BY id_artikel DESC LIMIT $awalData,$jumlahDataPerHalaman";
}
$artikel = query($query);


$isi_artikel = limit($artikel);
// var_dump($isi_artikel);

$query = "SELECT * FROM artikel ORDER BY hits DESC LIMIT 4";
$populer = query($query);


$query = "SELECT * FROM info";
$info = query($query);


$tahun = date('Y');
// $tanggal = date('j');
$bulanStr = date('M');
$bulan = date('n');
$hari = date('N');
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
    
</head>
<body>



    
  <!-- NAVBAR -->
<section>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                        <img src="assets/img/info/logo/<?=$info[0]['logo'];?>" width="30" height="30" class="d-inline-block align-top" alt="">
                        &nbsp; <?=$info[0]['nama'];?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                          <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="gallery.php">Gallery</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary nav-link" onclick="document.location.href='login.php'">Login</button>
                        </li>
                    </ul>

                  </ul>
                </div>
                </div>
              </nav>
</section>















<!-- Jumbotron -->
<section>
<?php $index = 'background'; ?>
  <div class="jumbotron jumbotron-fluid" style="background-image:url('assets/img/info/background/<?=$info[0][$index];?>');">
    <div class="container">
      <div class="container text-center">
        <img class="foto" src="assets/img/info/logo/<?=$info[0]['logo'];?>" alt="">
        <h1 class="display-4 text-light"><?=$info[0]['nama'];?></h1>
        <p class="lead text-light">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
      </div>
  </div>
</div>



</section>


<section >
  <div class="container">
    <h1 class="text-center artikel">Artikel Terbaru</h1>
    <div class="row">
      <div class="col-sm-8">      
        <article>
  
<div class="container">

<?php 

if(!$artikel){
  echo "<h3 class='text-muted'> Not Found </h3>";
}
$i = 0; 

?>
<div id="container">
  <div class="row"> 
  <?php foreach($artikel as $r) : ?>

    <div class="col-md-6 sm-12">
        <div class="card mb-3">
            <img class="card-img-top img-thumbnail" src="assets/img/artikel/<?=$r['gambar_artikel'];?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?= $r['judul_artikel'];?></h5>
              <p class="card-text"><?=$isi_artikel[$i];?></p>
            
                <p class="card-text">
                    <small class="text-muted">
                      <img src="assets/ico/time.png" alt="" class="icon">
                        <?="Last update ". $r['waktu_artikel'];?>
                    </small>
                  </p>
                    <p class="card-text">
                      <small class="text-muted">
                        <img src="assets/ico/folder.png" class="icon">
                         <?=$r['kategori'];?>
                      </small>
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                          <img src="assets/ico/user.png" class="icon">
                           <?='Posted by '.$r['nama_pengguna'];?>
                        </small>
                    </p>
              
              <a href="details.php?id_artikel=<?=$r['id_artikel'];?>" class="btn btn-primary">Read more</a>
              
            </div>
          </div>
    </div>
  <?php $i++; ?>
    <?php endforeach; ?>
  </div>
</div>




<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
  <?php if($halamanAktif > 1) :?>
    <li class="page-item">
  <?php else : ?>
    <li class="page-item disabled">
  <?php endif; ?>
      <a class="page-link" href="?page=<?=$halamanAktif-1;?>">Previous</a>
    </li>
      <?php for($i = 1; $i <= $jumlahHalaman; $i++) :?>
        <?php if($i == $halamanAktif) :?>
          <li class="page-item"><a class="page-link" href="?page=<?=$i;?>" style="font-weight: bold"><?=$i;?></a></li>
        <?php else : ?>
          <li class="page-item"><a class="page-link" href="?page=<?=$i;?>"><?=$i;?></a></li>
        <?php endif; ?>
      <?php endfor; ?>
    <?php if($halamanAktif == $jumlahHalaman) :?>
    <li class="page-item disabled">
    <?php else : ?>
    <li class="page-item">
    <?php endif; ?>
      <a class="page-link" href="?page=<?=$halamanAktif+1;?>">Next</a>
    </li>
  </ul>
</nav>

</article>
</div>

    <div class="col-sm-4">
      <aside>
        
        <form class="form-inline my-2 my-lg-0" method="post">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword" id="keyword">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="submit">Search</button>
        </form>
        <h3 class="mt-5">Kategori</h3>
    <div class="container">
        <nav class="nav flex-column">
           <?php foreach($kategori as $r) :?>
            <a class="nav-link" href="index.php?kategori=<?=$r['kategori'];?>"><?= $r['kategori'];?></a>
           <?php endforeach; ?>
        </nav>


<div class="card border-dark mb-3 mt-3" style="max-width: 18rem;">
  <div class="card-header"><h5><?php echo "<h2>$bulanStr   $tahun</h2>";?></h5></div>
  <div class="card-body text-dark">
    <?php
    echo draw_calendar($bulan,$tahun); 
    ?>
</div>
</div>

<div class="card border-dark mb-3 mt-3" style="max-width: 18rem;">
  <div class="card-header"><h6>Paling banyak dikunjungi</h6></div>
  <div class="card-body text-dark">
      <ul>
      <?php foreach($populer as $r) :?>
        <li><a href="details.php?id_artikel=<?=$r['id_artikel'];?>"><?=$r['judul_artikel'];?> <span class="badge badge-pill badge-primary float-right">hits <?=$r['hits'];?></span></a></li>
      <?php endforeach;?>
    </ul>
  </div>
</div>

    </div>
      </aside>        
    </div>
  </div>
</div>


</section>
  <!--AddToAny BEGIN -->
  <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
    <a class="a2a_button_facebook"></a>
    <a class="a2a_button_whatsapp"></a>
    <a class="a2a_button_twitter"></a>
    <a class="a2a_button_google_gmail"></a>
  </div>


<!-- <span class="glyphicon glyphicon-envelope"></span>
<span class="glyphicon glyphicon-print"></span>
<span class="glyphicon glyphicon-heart"></span>
<span class="glyphicon glyphicon-search"></span>
<i class="fa fa-diamond" style="font-size:100px"></i>
<i class="fa fa-diamond" style="font-size:100px"></i> -->
<!-- <i class="fa fa-coffe"></i> -->

<!-- The content of your page would go here. -->
<footer class="footer-distributed">
            <div class="footer-left">
                <h3>Majelis<span><?=$info[0]['nama'];?></span></h3>
                <p class="footer-links">
                    <a href="index.php">Home</a>
                    ·
                    <a href="gallery.php">Galery</a>
                    ·
                    <a href="profile.php">Profile</a>
                    ·
                    <a href="login.php">Login</a>
                    
                    
                </p>
                <p class="footer-company-name"><?= 'Majelis_'.$info[0]['nama'];?> &copy; 2019</p>
            </div>
            <div class="footer-center">
                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><?=$info[0]['alamat'];?></p>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p><?=$info[0]['telp'];?></p>
                </div>
                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:support@company.com"><?= $info[0]['email'];?></a></p>
                </div>
            </div>
            <div class="footer-right">
                <p class="footer-company-about">
                    <span>About Us</span>
                    <?= substr($info[0]['deskripsi'],0,100);?> ...
                </p>
                <div class="footer-icons">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>
                </div>
            </div>
        </footer>



<script async src="https://static.addtoany.com/menu/page.js"></script>
<!--AddToAny END -->

<script src="assets/js/jquery-3.3.1.min.js"></script>    
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>