<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';


// ambil data di url
$id = $_GET["id"];
// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0]; 


if( isset( $_POST ["submit"] ) ){
    
    if( ubah($_POST) > 0){
        echo "<script> 
        alert('Data berhasil diubah'); 
        document.location.href ='index.php'
        </script>";
    }else{
        echo  "<script> 
        alert('Data data gagal diubah'); 
        document.location.href ='index.php'
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <h1>Ubah data siswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?= $mhs["id"];?>"> 
     <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"];?>"> 

        <label for="nis">Nis :</label>
        <input type="text" name="nis" id="nis" required 
        value="<?= $mhs["nis"]; ?>">
        <br>
        <label for="nama">Nama :</label>
        <input type="text" name="nama" id="nama" required 
        value="<?= $mhs["nama"]; ?>">
        <br>
        <label for="email">email :</label>
        <input type="text" name="email" id="email"  required 
        value="<?= $mhs["email"]; ?>">
        <br>
        <label for="jurusan">jurusan :</label>
        <input type="text" name="jurusan" id="jurusan" required 
        value="<?= $mhs["jurusan"]; ?>">
        <br>
        <label for="gambar">gambar :</label><br>
        <img src="img/<?= $mhs['gambar']; ?>" width="100px"><br>
        <input type="file" name="gambar" id="gambar">
        <br>
        <button type="submit" name="submit">Updet</button>

    </form>


</body>
</html>
