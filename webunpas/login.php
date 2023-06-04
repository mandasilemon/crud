<?php

session_start();
require 'function.php';

if (isset($_COOKIE['id'])&&isset($_COOKIE['key'])){
    $id=$_COOKIE['id'];
    $id=$_COOKIE['key'];

    $result =mysqli_query($conn,"SELECT username FROM user WHERE id=$id");
    $row=mysqli_fetch_assoc($result);

    if ($key==='hash'('sha256',$row['username'])){
        $_SESSION['login']=true;
    }


}


if (isset ($_SESSION["login"])){
    header("Location:latihan2.php");
    exit;
} 



if(isset($_POST["login"])){
    $username=$_POST["username"];
    $password=$_POST["password"];

    $result= mysqli_query($pst,"SELECT * FROM user WHERE username= '$username'");
    //cek username
    if(mysqli_num_rows($result)===1){
        //cekpassword
        $row=mysqli_fetch_assoc($result);
        if (password_verify($password,$row["password"])){
            $_SESSION["login"]=true;
            //cek remember me

            if(isset($_POST['remember'])){
                //vuat cookie
                setcookie('id',$row['id'],time ()+60);
                setcookie('key',hash('sha256',$row['username']));
            }
            header ("Location:latihan2.php");
            exit;

        }
    }
    $error =true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylelog.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <title>login</title>
</head>
<body>
    <h1 class="h1">login</h1>
    <?php if(isset ($error)):?>
        <p>username/password salah</p>
    <?php endif;?>

    <div class ="kotak_login">
    <p class="tulisan_login">Silahkan login</p>
    <form action="" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form_login" id="username">
                <label for="password"> Password:</label>
                <input type="password"name="password" class="form_login" id="password">

            <button type=" submit" name="login" class="tombol_login">login</button>
            <p class="pRegis">ga punya akun?<a href="registrasi.php">Daftar</a></p>
    </form>
    </div>
    <!-- <div class="fContainer">
        <nav class="wrapper"> 
            <div class= "brand">
                <div class="firstname">data</div>
                <div class="last name"> siswa</div>
            </div>
            <ul class="navigation">
                <li><a href="">logout</a></li>
                <li><a href="">tambah data</a></li>
            </ul>
        </nav>
    </div> -->
</body>
</html>