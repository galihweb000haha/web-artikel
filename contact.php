<?php
require_once 'functions.php';
if(isset($_SESSION['login'])){
  header("Location: admin");
  exit;
}

if(isset($_POST['submit'])){
  if(kirimPesan($_POST) > 0){
    echo "<script> alert('pesan telah terkirim ke admin, terima kasih!'); </script>";
  } else{
    echo "<script> alert('maaf, ada kesalahan saat mengirim pesan'); </script>";
  }
}



$query = "SELECT * FROM kategori";
$kategori = query($query);

$query = "SELECT * FROM info";
$info = query($query);
$tahun = date('Y');
// $tanggal = date('j');
$bulanStr = date('M');
$bulan = date('n');
$hari = date('N');


$query = "SELECT * FROM artikel ORDER BY hits DESC LIMIT 4";
$populer = query($query);



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css">    
    
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


<section class="mb-4">
  <div class="container">
    <h1 class="text-center artikel">Contact Me</h1>
    <div class="row">
      <div class="col-sm-8">      
        <article>
            <form class="contact" method="post">
            <div class="form-group">
            <label for="nama">Nama</label>
            <input class="form-control" type="text" placeholder="Your Name" id="nama" name="nama">
          </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" autocomplete="off">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="3" name="isi_pesan"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              </form>


              <p class="card-text">
                  <small class="text-muted">
                    <img src="assets/ico/telephone.png" class="icon">
                      <?=$info[0]['telp'];?>
                  </small>
              </p>

              <p class="card-text">
                  <small class="text-muted">
                    <img src="assets/ico/location.png" class="icon">
                      <?=$info[0]['alamat'];?>
                  </small>
              </p>
            



  <div class="card">
  <div class="card-body">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed/v1/place?q=tegal&key=AIzaSyBA-AfikH9fawXcjKDLCh4fLK4MW2hNmsw" allowfullscreen></iframe>
      </div>
  </div>
</div>


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
<i class="fa fa-coffe"></i>





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




<script async src="https://static.addtoany.com/menu/page.js"></script>
<!--AddToAny END -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="assets/js/jquery-3.3.1.min.js"></script>    
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>

</body>
</html>