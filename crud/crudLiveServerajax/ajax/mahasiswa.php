<?php
require '../functions.php';

$keyword =$_GET["keyword"];

$query = "SELECT * FROM mahasiswa 
        WHERE 
         nama LIKE '%$keyword%' OR 
         nis LIKE '%$keyword%' OR 
         email LIKE '%$keyword%' OR 
         jurusan LIKE '%$keyword%' 
        ";

$students = query($query);



?>

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