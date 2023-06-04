<?php

require 'function.php';

if (isset($_POST["register"])){
    if(registrasi($_POST)>0){
        echo "<script>
                alert ('user baru berhasil ditambahkan');
                document.location.href ='latihan2.php';

              </script>";
    }
    else {
        echo mysqli_error($pst);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylereg.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

    <title>REGISTRASI</title>
    <!-- <style>
        label{
            display:block;
        }
    </style> -->
</head>
<body>
<h1 class="daftar">Daftar akun</h1>

<div class ="kotak_registrasi">
<p class="tulisan_registrasi">Silahkan daftar</p>
    <form action=""method="post">
                <label for="username">username:</label>
                <input type="text"name="username" class="form_registrasi"id="username">
                <label for="password">password:</label>
                <input type="password"name="password" class="form_registrasi"id ="password">
    
                <label for="password">konfirmasi password</label>
                <input type="password"name="password2" class="form_registrasi"id ="password2">
        
                <button type="submit" name="register"class="tombol_registrasi">register</button>
                    <p>have an account? <a href= 'login.php'>login</a></p>
            
    </form>
    </div>

</body>
</html>