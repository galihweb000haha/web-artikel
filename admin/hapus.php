<?php
require_once '../functions.php';

$id = $_GET['id'];
$type = $_GET['type'];

if($type == 'artikel'){
    $query = "DELETE FROM artikel WHERE id_artikel = $id ";
    $result = mysqli_query($conn, "SELECT gambar_artikel FROM artikel WHERE id_artikel = $id");
    $row = mysqli_fetch_assoc($result);
    $file =  $row['gambar_artikel'];
    echo "Loading...";
    if(file_exists("../assets/img/artikel/$file")){
    unlink("../assets/img/artikel/$file"); 
    
    }
    if(file_exists("../assets/img/artikel/thumbs/thumb_$file")){      
    unlink("../assets/img/artikel/thumbs/thumb_$file");
    }
    mysqli_query($conn, $query); 
    echo "<script>document.location.href='index.php';</script>";
    
    
} elseif($type == 'kategori'){
    $query = "DELETE FROM kategori WHERE id_kategori = $id ";
    mysqli_query($conn, $query);
    header("Location: kategori.php");
}elseif($type == 'kontak'){
    $query = "DELETE FROM kontak WHERE id_pengirim = $id ";
    mysqli_query($conn, $query);
    header("Location: contact.php");
}elseif($type == 'acara'){
    $query = "DELETE FROM jadwal WHERE id_acara = $id ";
    mysqli_query($conn, $query);
    header("Location: jadwal.php");
}
else{
    echo "undefined";
}

ob_flush;
// 6,7,9,10,12,13,16,21,20,27 sing uis bayar
?>