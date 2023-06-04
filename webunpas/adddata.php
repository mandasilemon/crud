<?php
require 'function.php';

if (isset($_POST["submit"])){
    

    if (adddata($_POST)>0){
        echo "
            <script>
                alert('data berhasil ditambah');
                document.location.href='latihan2.php';
            </script>
        
        ";
    }else {
        echo "
        <script>
            alert('data gagal ditambah');
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
    <link rel ="stylesheet" href="css/styleadd.css"/>
    <title>menambah data peserta</title>
</head>
<body>
    <h1 class="h1">TAMBAH DATA PESERTA  </h1>
    <div class ="kotak_tambah">
    <form action =""method="post" enctype="multipart/form-data">
            <label for="nama">Nama:</label>
            <input type="text" name= "nama" class = "form_tambah" id="nama">
    
            <label for="password">password:</label>
            <input type="password" name= "password" class="form_tambah" id="password">

            <label for="foto">foto:</label>
            <input type="file" name="foto" class="form_tambah" id="foto">
        <br>

            <a href="latihan2.php" class="kembali">kembali</a>
            <button type ="submit" name="submit"  class="tombol_simpan" >simpan</button>
    </form>
</div>
</body>
</html>