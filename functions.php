<?php
session_start();

// error_reporting(0);

$host = "localhost";
$username = "galih";
$password = "galih"; 
$db_name = "majelis";

$conn = mysqli_connect($host,$username,$password,$db_name);

// error_reporting(0);

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script> alert('username sudah ada');</script>";
        return false;
    }

    if($password !== $password2){
        echo "<script>
        alert('konfirmasi password tidak sesuai');</script>";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','admin')");

    return mysqli_affected_rows($conn);

}
function login($data){
    global $conn;

    if(md5($_POST['pin']) !== $_SESSION['image_random_value']){
        echo "<script> alert('Kode yang anda masukan salah');</script>";
        return false;
        
	} 

    $username = $data['username'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $_SESSION['username'] = $username;
           return true;
        }
    }
    echo "<script> alert('Username / Password salah');</script>";
    return false;
}

function query($data){
    global $conn;
    
    $result = mysqli_query($conn, $data);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}
function insertArtikel($data){
    global $conn;

    $judul_artikel = $data['judulArtikel'];
    $isiArtikel = $data['isiArtikel'];
    $kategori = $data['kategori'];
    $username = $_SESSION['username'];
    
    $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);

    $id_user = $row['id_user'];

  
    $namaBaru = upload();
  if(!$namaBaru){
    return false;
  }

    $result = mysqli_query($conn, "INSERT INTO artikel VALUES('','$judul_artikel',NOW(),$kategori,$id_user,'$isiArtikel','$namaBaru',0);");
    if(mysqli_affected_rows($conn)){
        return true;
    }else{
        echo "<script> alert('gagal'); </script>";
    }



}

function upload(){

   $nama = $_FILES['gambar']['name'];
   $size = $_FILES['gambar']['size'];
   $tmp_name = $_FILES['gambar']['tmp_name'];
   $error = $_FILES['gambar']['error'];


   if($error == 4){
       echo "<script> alert('belum memilih gambar'); </script>";
       return false;
   }
   
   if($size > 1000000){
    echo "<script> alert('Ukuran gambar terlalu besar'); </script>";
    return false;
    }

   $format = ['jpg','png','jpeg'];
   $ekstensi = explode('.',$nama);
   $ekstensi = strtolower(end($ekstensi));
   
   if(!in_array($ekstensi,$format)){
       
        echo "<script> alert('Format gambar tidak valid'); </script>";
        return false;
   }
   
   $namaBaru = uniqid();
   $namaBaru .= '.';
   $namaBaru .= $ekstensi;

   
   if(move_uploaded_file($tmp_name, '../assets/img/artikel/'. $namaBaru)){
    echo "<script> alert('File berhasil dipindah'); </script>";
   }else{
    echo "<script> alert('File gagal dipindah'); </script>";
   }
       
   
   
// identitas gambar
    $direktoriThumb = "../assets/img/artikel/thumbs/";
    if($ekstensi == 'png'){
        $realImages = imagecreatefrompng("../assets/img/artikel/". $namaBaru);
        if(!$realImages){
            
            return false;
        }
     }else{
        $realImages = imagecreatefromjpeg("../assets/img/artikel/". $namaBaru);
        if(!$realImages){
            
            return false;
        }
     }
    $width = imageSX($realImages);
    $height = imageSY($realImages);
// mengatur ukuran gambar
    $thumbWidth = 150;
    $thumbHeight = ($thumbWidth / $width) * $height;

    // mengubah ukuran gambar
    $thumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
    imagecopyresampled($thumbImage, $realImages, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);

    // simpan gambar thumbnail
    imagejpeg($thumbImage, $direktoriThumb."thumb_".$namaBaru);

    // hapus objek gambar dalam memori


   return $namaBaru;
}
function limit($data){
    $rows = [];
    $limit = count($data);
    for($i = 0; $i < $limit; $i++){
    $isi = substr($data[$i]['isi_artikel'],0,200);
    $isi .= '....';
    $rows[]=$isi;
    }
    return $rows;
}
function kirimPesan($data){
    global $conn;
    $result = mysqli_query($conn,"SELECT * FROM  kontak");
    if(mysqli_num_rows($result) > 50){
        return false;
        exit;
    }
    $isi_pesan = htmlspecialchars($data['isi_pesan']);
    $email = $data['email'];
    $nama_pengirim = htmlspecialchars($data['nama']);
    $result = mysqli_query($conn, "INSERT INTO kontak VALUES('','$email','$isi_pesan','$nama_pengirim')");
    if(mysqli_affected_rows($conn)){
        return true;
    }
}
function sendMessage($data){
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $to = $data['penerima'];
    $to = 'galihfirmansyah5757@gmail.com';
    $subject = $data['subject'];
    $message = $data['isiPesan'];
    $message = wordwrap($message, 70);
    $form = "galih11120@gmail.com";
    $headers = "From:" .$form;
    if(mail($to, $subject, $message, $headers)){
        return true;
    }else{
        return false;
    }
    
        
}
function insertJadwal($data){
    global $conn;
    $acara = $data['acara'];
    $lokasi = $data['lokasi'];
    $waktu = $data['waktu'];
    $deskripsi = $data['deskripsi'];
    $jam = $data['jam'];
    
    mysqli_query($conn, "INSERT INTO jadwal VALUES('','$acara','$waktu','$jam','$lokasi','$deskripsi')");
    return mysqli_affected_rows($conn);

}
function UpdateInfo($data){
    global $conn;
    $nama = $data['nama'];
    $deskripsi = $data['info'];
    $email = $data['email'];
    $telp = $data['tel'];
    $alamat = $data['alamat'];
    $namebg = 'background';
    $namelogo = 'logo';
    $result = mysqli_query($conn, "SELECT * FROM info");
    $row = mysqli_fetch_assoc($result);
    
    $backgroundAsli = $row['background'];
    // var_dump($backgroundAsli);
    // exit;
    $logoAsli = $row['logo'];
    

    
    if($_FILES['logo']['name']){
    
        if($logo = uploadInfo($namelogo)){
        
            unlink("../assets/img/info/logo/$logoAsli");
            unlink('../assets/img/info/logo/thumbs/thumb_'.$logoAsli);
            mysqli_query($conn,"UPDATE info SET logo = '$logo'");
    
        }
    }
    // else{
    //     mysqli_query($conn,"UPDATE info SET logo = '$logoAsli'");
    // }
    if($_FILES['background']['name']){
        if($bg = uploadInfo($namebg)){
            unlink('../assets/img/info/background/'.$backgroundAsli);
            unlink('../assets/img/info/background/thumbs/thumb_'.$backgroundAsli);
            mysqli_query($conn, "UPDATE info SET background = '$bg'");
        }
    }
    // else{
    //     mysqli_query($conn, "UPDATE info SET background = '$backgroundAsli'");
    // }
    
    // exit;
    
    $result = mysqli_query($conn, "UPDATE info SET deskripsi = '$deskripsi', nama = '$nama', telp = '$telp', alamat = '$alamat', email = '$email'");
    
    return 1;
    
}

function uploadInfo($name){
    // error_reporting(0);
    $nama = $_FILES[$name]['name'];
    $size = $_FILES[$name]['size'];
    $tmp_name = $_FILES[$name]['tmp_name'];
    $error = $_FILES[$name]['error'];
 
 
    if($error == 4){
        echo "<script> alert('belum memilih gambar'); </script>";
        return false;
    }
    $format = ['jpg','png','jpeg'];
    $ekstensi = explode('.',$nama);
    $ekstensi = strtolower(end($ekstensi));
    
    if(!in_array($ekstensi,$format)){
         echo "<script> alert('fromat gambar tidak valid'); </script>";
         return false;
    }
    if($size > 5000000){
         echo "<script> alert('ukuran gambar terlalu besar'); </script>";
         return false;
    }
    
    $namaBaru = uniqid();
    $namaBaru .= '.';
    $namaBaru .= $ekstensi;

    move_uploaded_file($tmp_name, "../assets/img/info/$name/". $namaBaru);
    
    
    
 // identitas gambar
     $direktoriThumb = "../assets/img/info/$name/thumbs/";
     
     if($ekstensi == 'png'){
        $realImages = imagecreatefrompng("../assets/img/info/$name/". $namaBaru);
        if(!$realImages){
            
            return false;
        }
     }else{
        $realImages = imagecreatefromjpeg("../assets/img/info/$name/". $namaBaru);
        if(!$realImages){
            
            return false;
        }
     }
     $width = imageSX($realImages);
     $height = imageSY($realImages);
 // mengatur ukuran gambar
     $thumbWidth = 150;
     $thumbHeight = ($thumbWidth / $width) * $height;
 
     // mengubah ukuran gambar
     $thumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
     imagecopyresampled($thumbImage, $realImages, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
 
     // simpan gambar thumbnail
     imagejpeg($thumbImage, $direktoriThumb."thumb_".$namaBaru);
 
     // hapus objek gambar dalam memori
     
     
 
    return $namaBaru;
 }


function draw_calendar($month,$year){

	// Draw table for Calendar 
	$calendar = '
<table cellpadding="0" cellspacing="10" class="calendar">';

	// Draw Calendar table headings 
	$headings = array('Ahd |',' Sen |',' Sel |',' Rab |',' Kms |',' Jmt |',' Sab');
	$calendar.= '
<tr class="calendar-row">
<td class="calendar-day-head">'.implode('</td>
<td class="calendar-day-head">',$headings).'</td>
</tr>
';

	//days and weeks variable for now ... 
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	// row for week one 
	$calendar.= '
<tr class="calendar-row">';

	// Display "blank" days until the first of the current week 
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '
<td class="calendar-day-np"> </td>
';
		$days_in_this_week++;
	endfor;

	// Show days.... 
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if($list_day==date('d') && $month==date('n'))
		{
			$currentday='currentday';
		}else
		{
			$currentday='';
		}
		$calendar.= '
<td class="calendar-day '.$currentday.'">';
		
			// Add in the day number
			if($list_day<date('d') && $month==date('n'))
			{
				$showtoday='<strong class="overday">'.$list_day.'</strong>';
			}else
			{
				$showtoday=$list_day;
			}
			$calendar.= '
<div class="day-number">'.$showtoday.'</div>
';

		// Draw table end
		$calendar.= '</td>
';
		if($running_day == 6):
			$calendar.= '</tr>
';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '
<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	// Finish the rest of the days in the week
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '
<td class="calendar-day-np"> </td>
';
		endfor;
	endif;

	// Draw table final row
	$calendar.= '</tr>
';

	// Draw table end the table 
	$calendar.= '</table>
';
	
	// Finally all done, return result 
	return $calendar;
}
function UpdateDoc(){
    global $conn;

    $query = "SELECT * FROM gallery";
    $documents = query($query);

    $g1lama = $documents[0]['gambar1'];
    $g2lama = $documents[0]['gambar2'];
    $g3lama = $documents[0]['gambar3'];
    
    $nama = $_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];
   

    $qasidah = mysqli_real_escape_string($conn, $_POST['qasidah']);
    $tausiah = mysqli_real_escape_string($conn, $_POST['tausiah']);

    $jumlah = count($_FILES['gambar']['name']);

    
    mysqli_query($conn, "UPDATE gallery SET qasidah = '$qasidah', tausiah = '$tausiah'");
    

        if($jumlah == 3){
            $gambar = array();
            for($i=0 ; $i < $jumlah; $i++){

                
                
                if($size[$i] > 1000000){
                    echo "<script> alert('Ukuran gambar terlalu besar'); </script>";
                    return false;
                 }
                 $format = ['jpg','png','jpeg'];
                $ekstensi = explode('.',$nama[$i]);
                $ekstensi = strtolower(end($ekstensi));
                
                if(!in_array($ekstensi,$format)){
                    
                        echo "<script> alert('Format gambar tidak valid'); </script>";
                        return false;
                }
                
                
                $file_name = uniqid().'.'.$ekstensi;
                $tmp_name = $_FILES['gambar']['tmp_name'][$i];
                move_uploaded_file($tmp_name, "../assets/img/gallery/".$file_name);
                $gambar[$i] = $file_name;
            }
                
                if(mysqli_query($conn, "UPDATE gallery SET gambar1 = '$gambar[0]', gambar2 = '$gambar[1]', gambar3 = '$gambar[2]', qasidah = '$qasidah', tausiah = '$tausiah'")){
                    
                    unlink('../assets/img/gallery/'.$g1lama);
                    unlink('../assets/img/gallery/'.$g2lama);
                    unlink('../assets/img/gallery/'.$g3lama);
                    echo "<script> alert('File berhasil diupload'); </script>";
                    return true;
                }else{
                     
                    return false;
                }
            
        }elseif ($jumlah == 2) {
            $gambar = array();
            for($i=0 ; $i < $jumlah; $i++){
                
                
                if($size[$i] > 1000000){
                    echo "<script> alert('Ukuran gambar terlalu besar'); </script>";
                    return false;
                 }
                 $format = ['jpg','png','jpeg'];
                $ekstensi = explode('.',$nama[$i]);
                $ekstensi = strtolower(end($ekstensi));
                
                if(!in_array($ekstensi,$format)){
                    
                        echo "<script> alert('Format gambar tidak valid'); </script>";
                        return false;
                }
                
                
                $file_name = uniqid().'.'.$ekstensi;
                $tmp_name = $_FILES['gambar']['tmp_name'][$i];
                move_uploaded_file($tmp_name, "../assets/img/gallery/".$file_name);
                $gambar[$i] = $file_name;
            }
                
                if(mysqli_query($conn, "UPDATE gallery SET gambar1 = '$gambar[0]', gambar2 = '$gambar[1]',  qasidah = '$qasidah', tausiah = '$tausiah'")){
                    
                    unlink('../assets/img/gallery/'.$g1lama);
                    unlink('../assets/img/gallery/'.$g2lama);
                    echo "<script> alert('File berhasil diupload'); </script>";
                    return true;
                }else{
                    
                    return false;
                }
            
        }elseif($jumlah == 1){
             $gambar = array();
            for($i=0 ; $i < $jumlah; $i++){
                if($error[$i] == 4){
                    echo "<script> alert('Tidak ada file yang diupload'); </script>";
                    return false;
                }
                
                if($size[$i] > 1000000){
                    echo "<script> alert('Ukuran gambar terlalu besar'); </script>";
                    return false;
                 }
                 $format = ['jpg','png','jpeg'];
                $ekstensi = explode('.',$nama[$i]);
                $ekstensi = strtolower(end($ekstensi));
                
                if(!in_array($ekstensi,$format)){
                    
                        echo "<script> alert('Format gambar tidak valid'); </script>";
                        return false;
                }
                
                
                $file_name = uniqid().'.'.$ekstensi;
                $tmp_name = $_FILES['gambar']['tmp_name'][$i];
                move_uploaded_file($tmp_name, "../assets/img/gallery/".$file_name);
                $gambar[$i] = $file_name;
            }
                
                if(mysqli_query($conn, "UPDATE gallery SET gambar1 = '$gambar[0]',  qasidah = '$qasidah', tausiah = '$tausiah'")){
                    
                    unlink('../assets/img/gallery/'.$g1lama);
                    echo "<script> alert('File berhasil diupload'); </script>";
                    return true;
                }else{
   
                    return false;
                }
            
            
        }elseif($jumlah > 3){
            echo "<script>alert('Pilih minimal 1 file maksimal 3 file!');</script>";    
        }
        return false;
}
// 1 maret -kosong
// 4 maret -sesi 2 lab 5 b.ing
// 5 maret -sesi 1 lab 5 mat
// 6 maret -UAS
// 7 maret -kosong
// 8 maret -pengayaan
// 11 maret -UAS
// 12 maret -pengayaan PD
// 13 maret -Try Out
// 14 maret -Try Out
// 15 maret -?
