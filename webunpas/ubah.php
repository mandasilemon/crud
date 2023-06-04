<?php
require 'function.php';

//ambil data diURL
$id=$_GET["id"];
//query data peserta berdasarkan id
$peserta=query("SELECT * FROM peserta WHERE id=$id")[0];



//cek apkaah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])){
    //cek apakah data berhasil ditambahkan
    if (ubah($_POST)>0){
        echo "
            <script>
                alert('data berhasil diubah');
                document.location.href='latihan2.php';
            </script>
        
        ";
    }else {
        echo "
        <script>
            alert('data gagal diubah');
            document.location.href='latihan2.php';
        </script>
    
    ";
    }
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="css/style.css"/>
    <title>edit data peserta</title>
</head>
<body>
    <h1>EDIT DATA PESERTA  </h1>
    <form action =""method="post" enctype="multipart/form-data">
        <input type="hidden"name="id"value="<?=$peserta["id"];?>">
        <input type="hidden" name="fotolama" value="<?=$peserta["foto"];?>">
    <ul>
        <li>
            <label for="nama">Nama:</label>
            <input type="text" name= "nama" id="nama"
            value="<?=$peserta["nama"];?>">
        </li>
        <li>
            <label for="password">password:</label>
            <input type="text" name= "password" id="password"
            value="<?=$peserta["password"];?>">>
        </li>
        <li>
            <label for="foto">foto:</label>
            <img src="img/<?= $peserta['foto']?>"width="200">
            <input type="file" name="foto" id="foto">
        </li>
        <br>
        <li>
            <button type ="submit" name="submit">kirim</button>
        </li>
    </ul>
    </form>
</body>
</html>