<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}


require 'functions.php';

if( isset( $_POST ["submit"] ) ){
    
    if( tambah($_POST) > 0){
        echo "<script> alert('Data berhasil ditambahkan!'); document.location.href ='index.php'</script>";
    }else{
        echo  "<script> alert('Data data gagal ditambahkan!'); document.location.href ='index.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">

        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        <br>
        <label for="nis">Nis</label>
        <input type="text" name="nis" id="nis">
        <br>
        <label for="email">email</label>
        <input type="text" name="email" id="email">
        <br>
        <label for="jurusan">jurusan</label>
        <input type="text" name="jurusan" id="jurusan">
        <br>
        <label for="gambar">gambar</label>
        <input type="file" name="gambar" id="gambar">
        <br>
        <button type="submit" name="submit">Kirim</button>

    </form>


</body>
</html>