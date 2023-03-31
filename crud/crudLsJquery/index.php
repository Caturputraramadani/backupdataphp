<?php
session_start();
// SESSION adalah mekanisme penyimpanan informasi ke dalam variable agar bisa digunakan di lebih dari satu halaman
// sama seperti session namun COOKIE  informasi disimpan pada browser atau client 

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$students = query("SELECT * FROM mahasiswa ");

// tombol cari di klik
if (isset ($_POST ["cari"]) ){
    $students = cari($_POST ["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>

    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/script.js"></script> 
   

     <style>
        html, h1{
            display:flex;
            justify-content:center;
        }
        img{
            width:100px;
        }
        .loader{
            width:50px;
            position: absolute;
            top:125px;
            /* left:210px; */
            z-index: -1;
            display:none;
            
        }
        /* media print digunakan untuk menghilangkan suatu ketika di print */
        /* @media print{
            .logout, .tambah, .form-cari, .aksi{
                display:none;
            }
        } */
    </style> 
</head>
<body>
    <a href="logout.php" class="logout">Logout</a>
    <h1>Daftar Siswa</h1>
    <a href="tambah.php" class="tambah">Tambah data siswa</a>
    <br></br>

    <form action="" method="post" class="form-cari">

    <input type="text" name="keyword" size="40" autofocus 
    placeholder="sercing data.." autocomplete="off" id="keyword" >
    <button type="submit" name="cari" id="tombol-cari">Cari</button>
    <img src="img/loader.gif" class="loader">

    </form>

    <br>

    <div id="container">
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
            <th>No.</th>
            <th class="aksi">Aksi</th>
            <th>Gambar</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            <?php foreach($students as $student ) {?>
                <tr>
                    <td><?= $i;?></td>
                    <td class="aksi">
                    <a href="ubah.php?id=<?= $student["id"];?>">ubah</a> |
                    <a href="hapus.php?id=<?= $student["id"];?>" onclick="return confirm ('yakin?')">hapus</a>
                    </td>
                    <td> 
                    <img src="img/<?= $student["gambar"]; ?>">
                    </td> 
                    <td><?=$student["nis"];?></td>
                    <td><?=$student["nama"];?></td>
                    <td><?=$student["email"];?></td>
                    <td><?=$student["jurusan"];?></td>
    
                </tr>
                <?php $i++;?>
                <?php  }?>
        </tbody>
    </table>
    </div>

    
    
    
</body>
</html>