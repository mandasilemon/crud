<?php
$pst = mysqli_connect("localhost", "root", "", "crudphp");

function query ($query){
    global $pst;
    $result = mysqli_query ($pst ,$query);
    $rows = [];
    while($row =mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}

function adddata($data){
    global $pst;
    $nama = htmlspecialchars($data["nama"]);
    $password = htmlspecialchars($data ["password"]);

    //upload gambar
    $foto= upload();
    if(!$foto){
        return false;
    }

    $query = "INSERT INTO peserta
               VALUES
            ('','$nama','$password','$foto')
            ";
    mysqli_query($pst,$query);

    return mysqli_affected_rows($pst);
}

function upload(){
    $namaFile       = $_FILES['foto']['name'];
    $ukuranFile     = $_FILES['foto']['size'];
    $error          = $_FILES['foto']['error'];
    $tmpName        = $_FILES['foto']['tmp_name'];

    // if(empty($namaFile)) {
    //     echo"<script>
    //             alert('pilih foto terlebih dahulu');
    //          </script";
    //     return false;
    // }

    // if($error === 4){
    //     echo"<script>
    //             alert('pilih foto terlebih dahulu');
    //          </script";
    //     return false;
    // }

    $ekstensiFotoValid  = ['jpg','jpeg','png'];
    $ekstensiFoto       = explode('.',$namaFile);
    $ekstensiFoto       = strtolower(end($ekstensiFoto));

    // if(!in_array($ekstensiFoto,$ekstensiFotoValid)){
    // echo"<script>
    //             alert('bukan foto!');
    //          </script";
    //          return false;
    // }

    // if ($ukuranFile>1000000){
    //     echo"<script>
    //             alert ('ukuran gambar terlalu besar!');
    //          </script>";
    //          return false;
    // }

    $namaFileBaru       = uniqid();
    $namaFileBaru       = '.';
    $namaFileBaru       = $ekstensiFoto;

    $query = move_uploaded_file($tmpName,'img/'.$namaFile);
    if($query){
        echo 'SUKSES';
    }

    else {
        echo 'GAGAL';
    }
    return $namaFileBaru;
}

function hapus ($id){
    global $pst;
    mysqli_query($pst,"DELETE FROM peserta WHERE id =$id");

    return mysqli_affected_rows($pst);

}

function ubah($data){
    global $pst;

    $id         = $data["id"];
    $nama       = htmlspecialchars($data["nama"]);
    $password   = htmlspecialchars($data["password"]);
    $fotolama   = htmlspecialchars($data["fotolama"]);

    $fileFoto   = @$_FILES['foto']['name'];
    $fileTmp    = @$_FILES['foto']['tmp_name'];
     
    if(empty($fileFoto)) {
        $foto   = $fotolama;
    }
    else {
        $foto   = $fileFoto;
        
        move_uploaded_file($fileTmp, 'img/' . $fileFoto);
    }

    $query  = "UPDATE peserta SET
                nama        = '$nama',
                password    = '$password',
                foto        = '$foto'
                WHERE id    = '$id'
            ";

    mysqli_query($pst,$query); //menjalankan query

    return $fileFoto;

    // return mysqli_affected_rows($pst); //mengembalikan 
}

function cari($keyword){
    $query ="SELECT*FROM peserta
                WHERE 
            nama LIKE '%$keyword%'
            ";
    return query($query);
}

function registrasi($data){
    global $pst;

    $username= strtolower (stripslashes ($data ["username"]));
    $password= mysqli_real_escape_string($pst, $data["password"]);
    $password2=mysqli_real_escape_string($pst, $data["password2"]);

    //cek username sudh ada atau belum
    $result= mysqli_query ($pst,"SELECT username FROM user WHERE username ='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                    alert('username sudah terdaftar');
                </script>";
        return false;
    }


    //konfirmasi password
    if ($password !== $password2){
        echo"<script>
                alert(konfirmasi password tidak sesuai);
            </script>";
        return false;
    }

    //enkripsi password
    $password=password_hash($password, PASSWORD_DEFAULT);

    //tambahkan data baru ke database
    mysqli_query($pst, "INSERT INTO user VALUES('','$username','$password') ");
    return mysqli_affected_rows($pst);
}



?>