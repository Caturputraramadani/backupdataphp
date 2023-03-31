<?php
// SESSION adalah mekanisme penyimpanan informasi ke dalam variable agar bisa digunakan di lebih dari satu halaman
// sama seperti session namun COOKIE  informasi disimpan pada browser atau client 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}


require 'functions.php';

// pagination
// konfigurasi
$jumlahDataPerHalaman =1;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$students = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");


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
     <style>
        html, h1{
            display:flex;
            justify-content:center;
        }
        img{
            width:100px;
        }
    </style> 
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>Daftar Siswa</h1>
    <a href="tambah.php">Tambah data siswa</a>
    <br></br>

    <form action="" method="post">
    <input type="text" name="keyword" size="40" autofocus 
    placeholder="sercing data.." autocomplete="off">
    <button type="submit" name="cari">Cari</button>

    </form>
    <br>

    <!-- navigasi -->
    <?php if( $halamanAktif > 1) :?>
    <a href="?halaman= <?= $halamanAktif - 1; ?>"> &laquo;</a>
    <?php endif ; ?>


    <?php for( $i = 1; $i <= $jumlahHalaman; $i++): ?>
        <?php if( $i == $halamanAktif) : ?>
        <a href="?halaman= <?= $i; ?>" style="font-weight: blod; color: #181818;"><?=  $i; ?></a>
        <?php else : ?>
            <a href=" ?halaman= <?= $i; ?> "><?=  $i; ?></a>
        <?php endif ; ?>
    <?php endfor ; ?>


    <?php if( $halamanAktif < $jumlahHalaman) :?>
    <a href="?halaman= <?= $halamanAktif + 1; ?>"> &raquo;</a>
    <?php endif ; ?>

    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
            <th>No.</th>
            <th>Aksi</th>
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
                    <td>
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
</body>
</html>