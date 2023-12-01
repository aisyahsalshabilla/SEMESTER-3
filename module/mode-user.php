<?php

if(userLogin()['level'] != 1){
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data) {
    global $koneksi;

    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname = mysqli_real_escape_string($koneksi, $data['fullname']);
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
    $level = mysqli_real_escape_string($koneksi, $data['level']);
    $address = mysqli_real_escape_string($koneksi, $data['address']);
    
    // Validasi gambar
    if (!empty($_FILES['image']['name'])) {
        $gambar = uploadimg();
        if (!$gambar) {
            echo "<script>
                    alert('Gagal mengunggah gambar');
                </script>";
            return false;
        }
    } else {
        $gambar = 'profil.png';
    }

    // Validasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai, user baru gagal registrasi');
            </script>";
        return false;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0) {
        echo "<script>
            alert('Username sudah terpakai, user baru gagal registrasi');
        </script>";
        return false;
    }

    if($gambar != null){
        $gambar = uploadimg();
    } else{
        $gambar = 'profil.png';
    }

    //gambar tidak sesuai validasi
    if($gambar == ''){
        return false;
    }

    $sqlUser = "INSERT INTO user VALUES (null, '$username', '$fullname', '$pass', '$address', '$level', '$gambar')";
    mysqli_query($koneksi, $sqlUser);

    if (mysqli_errno($koneksi)) {
        echo "Gagal mengeksekusi query: " . mysqli_error($koneksi);
        return false;
    }

    return mysqli_affected_rows($koneksi);
}

function deleteUser($id, $foto){
    global $koneksi;

    $sqlDel = "DELETE FROM user WHERE userid = $id";
    mysqli_query($koneksi, $sqlDel);
    if($foto != 'profil.png'){
        unlink('../asset/image/'.$foto);
    }

    return mysqli_affected_rows($koneksi);
}

function selectUser1($level){
    $result = null;
    if($level == 1){
        $result = "selected";
    }
    return $result;
}

function selectUser2($level){
    $result = null;
    if($level == 2){
        $result = "selected";
    }
    return $result;
}

function selectUser3($level){
    $result = null;
    if($level == 3){
        $result = "selected";
    }
    return $result;
}

function update($data) {
    global $koneksi;

    $iduser = mysqli_real_escape_string($koneksi, $data['id']);
    $username = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname = mysqli_real_escape_string($koneksi, $data['fullname']);
    $level = mysqli_real_escape_string($koneksi, $data['level']);
    $address = mysqli_real_escape_string($koneksi, $data['address']);
    $gambar = isset($data['image']['name']) ? mysqli_real_escape_string($koneksi, $data['image']['name']) : null;
    $fotoLama = mysqli_real_escape_string($koneksi, $data['oldImg']);
    
    //cek username sekarang
    $queryUsername = mysqli_query($koneksi, "SELECT * FROM user WHERE userid = $iduser");
    $dataUsername = mysqli_fetch_assoc($queryUsername);
    $curUsername = $dataUsername['username'];

    //cek username baru
    $newUsername = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

    if($username !== $curUsername){
        if(mysqli_num_rows($newUsername)){
            echo '<script>
                    alert("Username sudah terpakai, update data user gagal");
                </script>';
                return false;
        }
    }

    //cek gambar
    if($gambar != null){
        $url = "data-user.php";
        $imgUser = uploadimg($url);
        if($fotoLama != 'profil.png') {
            @unlink('../asset/image'.$fotoLama);
        }
    } else {
        $imgUser = $fotoLama;
    }

    mysqli_query($koneksi, "UPDATE user SET
                            username = '$username',
                            fullname = '$fullname',
                            address = '$address',
                            level = '$level',
                            foto = '$imgUser'
                            WHERE userid = $iduser
                            ");

    return mysqli_affected_rows($koneksi);
}


?>
