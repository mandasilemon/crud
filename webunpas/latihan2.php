<?php
session_start();

if(!isset ($_SESSION["login"])){
    header("Location: login.php"); 
    exit;
}
require 'function.php';//function untuk koneksi ke database
$peserta = query( "SELECT * FROM peserta");
//ASC
//DESC
//query = ambil data 
//4cara ambil data
//mysqli_fetch_row()//mengembalikan array numerik
//mysqli_fetch_assoc()//mengembalikan array associative
//mysqli_fetch_array()//mengembalikan keduanya
//mysqli_fetch_object()//

if (isset($_POST["cari"])){
    $peserta=cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman admin</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>
<body>
    
    <h1 class="h1"> Daftar Peserta<h1>

    <div class="header">
        <a class="adddata" href="adddata.php">tambahkan data peserta</a>
        <!-- <br><br>
        <ul>
        <li><a href="login.php">login</a></li>
        <li><a href="logout.php">logout</a></li>
        <li><a href="adddata.php">addata</a></li>
        </ul> -->
    <form class="cari"action=""method="post">
        <div class="search-container">
        <input type="text"name="keyword"size="30"autofocus
            placeholder="masukkan keyword pencarian.." autocomplete="off"
            class="search-input">
        <button type="submit" name="cari" class="search-button">cari</button>
        </div>
    </form>
    </div>
        <!-- <table border="1" cellpadding="10" cellspacing="0"> -->
            <div class="table-midle">
            <table class="container">
            <tr>
                <th> No </th>
                <th> Nama </th>
                <th> Password </th>
                <th> Foto </th>
                <th> aksi </th>
            </tr>

        <?php $i=1;?>
        <?php foreach ($peserta as $row): ?>
         <tr>
            <td><?=$i;?></td>
            <td><?=$row["nama"]?></td>
            <td><?=$row["password"]?></td>
            <td><img src="img/<?=$row["foto"];?>"width="50"></td>
            <td> 
                <a class="ubah" href="ubah.php?id=<?=$row["id"];?>">ubah</a>
                <a class="hapus" href="hapus.php?id=<?=$row["id"];?>" onclick="return
                 confirm('yakin?');">hapus</a>
            </td>
         </tr>
        <?php $i++;?>
        <?php endforeach;?>

        </table>
        <div class ="footer">
        <a class="logout" href="logout.php">logout</a>
        </div>
</body>
</html>