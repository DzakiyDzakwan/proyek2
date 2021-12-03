<?php

$connection = mysqli_connect("localhost","root","","tubes");

function daftar($data) {

global $connection;

$username = strtolower(stripslashes($data["uname"]));
$email = stripslashes($data["email"]);
$password = mysqli_real_escape_string($connection, $data["password1"]);
$password2 = mysqli_real_escape_string($connection, $data["password2"]);
$status = strtoupper($data["status"]);


//check data kosong
if (empty($username) || empty($password) || empty($email) || empty($password2) ) {
    return false;
}

//Check Ketersediaan email
$emailCheck = mysqli_query($connection, "SELECT email FROM user WHERE email = '$email'");

if(mysqli_fetch_assoc($emailCheck)) {
    return false;
}

//check ketersedian username
$usernameCheck = mysqli_query($connection, "SELECT username FROM user WHERE username = '$username'");

if (mysqli_fetch_assoc($usernameCheck)) {
    return false;
}

 //passwordconfirmation
 if ($password !== $password2) {
    return false;
}

//passwordhash

$password = password_hash($password, PASSWORD_DEFAULT);



$insert = mysqli_query($connection, "INSERT INTO user(username,password,email,status) VALUES ('$username','$password','$email','$status')");

return mysqli_affected_rows($connection) ;

}

function login($data) {

global $connection ;

$username = $data["uname"];
$password = $password;

//check username

$dataCheck = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");

if (mysqli_num_rows($dataCheck) > 0) {

    $row = mysqli_fetch_assoc($dataCheck);


}

}


function addGuru($data) {

    global $connection;

    $nama = $data["nama"];
    $nig = $data["nig"];
    $userid = $data["userid"];
    $mapel = $data["mapel"];

    if(empty($nama) || empty($nig)) {
        return false ;
    }

    $query = mysqli_query($connection, "INSERT INTO guru(nama_guru,NIG,user_id,mapel_id) VALUES('$nama','$nig',$userid,$mapel)");

    return mysqli_affected_rows($connection);

    /* var_dump($nama);
    var_dump($userid);
    var_dump($mapel);
    var_dump($nig);

    return 0; */
}

function addSiswa($data){

    global $connection;

    $nama = $data["nama"];
    $nis = $data["nis"];
    $userid = $data["userid"];
    $kelas = $data["kelas"];

    if(empty($nama) || empty($nis)) {
        return false ;
    }

    $query = mysqli_query($connection, "INSERT INTO siswa(nama_siswa,NIS,user_id,kelas_id) VALUES('$nama','$nis',$userid,$kelas)");

    return mysqli_affected_rows($connection);

}

function addMapel($data) {

    global $connection;

    $name = htmlspecialchars($data["mapelname"]);

    //check data kosong
    if (empty($name)) {
        return false;
    }

    //check nama ssudha tersedia atau belum

    $check = mysqli_query($connection, "SELECT * FROM mapel WHERE nama_mapel = '$name'");

    if (mysqli_num_rows($check) === 1) {
        return false ;
    }

    $query = mysqli_query($connection, "INSERT INTO mapel(nama_mapel) VALUES('$name')");

    return mysqli_affected_rows($connection);


}

function addKelas($data) {

    global $connection;

    $nama = $data["nama"];
    $wali = $data["walikelas"];
    $jurusan = $data["jurusan"];

    //check guru sudah menjadi wali atau belum
    $walicheck = mysqli_query($connection, "SELECT * FROM kelas WHERE wali_kelas = $wali");

    if(mysqli_num_rows($walicheck) > 0 ) {
        return false;
    } else {
       $query = mysqli_query($connection, "INSERT INTO kelas(nama_kelas,wali_kelas,jurusan) VALUES('$nama','$wali','$jurusan')");
    }

    return mysqli_affected_rows($connection) ;

}

function addTugas($data) {

    global $connection;

    $kelasId = $data["kelasID"];
    $guruId = $data["guruID"];
    $judul = $data["nama"];
    $deskripsi = $data["desc"];
    $deadline = $data["date"];

    if(empty($judul) || empty($deskripsi)) {
        return false;
    }

    $query = mysqli_query($connection,"INSERT INTO tugas(nama_tugas,deskripsi,deadline,guru,kelas) VALUES('$judul','$deskripsi','$deadline','$guruId','$kelasId')");

    return mysqli_affected_rows($connection);


}

function show($query) {

    global $connection;

    $box = [];

    $result = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($result)) {

        $box[] = $row;

    }

    return $box;
}

//Cari Siswa
function cariSiswa($data) {
    
    $keyword = $data["keyword"];
    $filter = $data["filter"];
        
    if(empty($keyword)) {
        $search = "SELECT siswa.id as id, siswa.nama_siswa as nama, siswa.NIS as nis, kelas.nama_kelas as kelas, kelas.jurusan as jurusan FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id WHERE kelas.jurusan LIKE '%$filter%' ORDER BY siswa.nama_siswa ASC" ;
    } elseif(empty($filter)) {
        $search = "SELECT siswa.id as id, siswa.nama_siswa as nama, siswa.NIS as nis, kelas.nama_kelas as kelas, kelas.jurusan as jurusan FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id WHERE siswa.nama_siswa LIKE '%$keyword%' ORDER BY siswa.nama_siswa ASC";
    } else {
        $search = "SELECT siswa.id as id, siswa.nama_siswa as nama, siswa.NIS as nis, kelas.nama_kelas as kelas, kelas.jurusan as jurusan FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id WHERE siswa.nama_siswa LIKE '%$keyword%' AND kelas.jurusan LIKE '%$filter%' ORDER BY siswa.nama_siswa ASC";
    }

    //return var_dump($filter);

    return show($search);

}

function cariGuru($data) {

    $keyword = $data["keyword"];
    $filter = $data["filter"];
    
    if(empty($keyword)) {
        $search = "SELECT guru.id as id, guru.nama_guru as nama, guru.NIG as nig, mapel.nama_mapel as mapel FROM guru JOIN mapel ON guru.mapel_id = mapel.id WHERE mapel.id LIKE '%$filter%' ORDER BY guru.nama_guru ASC";
    } elseif (empty($filter)) {
        $search = "SELECT guru.id as id, guru.nama_guru as nama, guru.NIG as nig, mapel.nama_mapel as mapel FROM guru JOIN mapel ON guru.mapel_id = mapel.id WHERE nama_guru LIKE '%$keyword%' ORDER BY guru.nama_guru ASC";
    } else {
        $search = "SELECT guru.id as id, guru.nama_guru as nama, guru.NIG as nig, mapel.nama_mapel as mapel FROM guru JOIN mapel ON guru.mapel_id = mapel.id WHERE nama_guru LIKE '%$keyword%' AND mapel.id LIKE '%$filter%' ORDER BY guru.nama_guru ASC ";
    }

    return show($search);

}

function cariMapel($data) {

    $keyword = $data["keyword"];

    if(empty($keyword)) {
        return false;
    }

    $search = "SELECT * FROM mapel WHERE nama_mapel LIKE '%$keyword%' ORDER BY mapel.nama_mapel ASC";

    return show($search);

}

function cariKelas($data) {
    $keyword = $data["keyword"];
    $filter = $data["filter"];
        
    if(empty($keyword)) {
        $search = "SELECT kelas.id, kelas.nama_kelas, kelas.jurusan, guru.nama_guru FROM kelas JOIN guru ON kelas.wali_kelas = guru.id WHERE jurusan LIKE '%$filter%'" ;
    } elseif(empty($filter)) {
        $search = "SELECT kelas.id, kelas.nama_kelas, kelas.jurusan, guru.nama_guru FROM kelas JOIN guru ON kelas.wali_kelas = guru.id  WHERE nama_kelas LIKE '%$keyword%'";
    } else {
        $search = "SELECT kelas.id, kelas.nama_kelas, kelas.jurusan, guru.nama_guru FROM kelas JOIN guru ON kelas.wali_kelas = guru.id  WHERE jurusan LIKE '%$keyword%' AND status LIKE '%$filter%'";
    }

    //return var_dump($filter);

    return show($search);

}

function cariUSer($data) {
    $keyword = $data["keyword"];
    $filter = $data["filter"];

        
    if(empty($keyword)) {
        $search = "SELECT * from user  WHERE status LIKE '%$filter%'" ;
    } elseif(empty($filter)) {
        $search = "SELECT * from user  WHERE username LIKE '%$keyword%'";
    } else {
        $search = "SELECT * from user WHERE username LIKE '%$keyword%' AND status LIKE '%$filter%'";
    }

    //return var_dump($filter);

    return show($search);
}

/* Edit */
function editUSer($data) {

    global $connection;

    $id = $data["id"];
    $uname = strtolower(stripslashes($data["uname"]));
    $email = stripslashes($data["email"]);
    $oldpass = $data["passwordold"];
    $newpass = mysqli_real_escape_string($connection, $data["passwordnew"]);
    $passwordconfirm = mysqli_real_escape_string($connection, $data["passwordconfirm"]);
    $password = password_hash($newpass, PASSWORD_DEFAULT);

    //Check Kosong atau enggak
    if(empty($id) || empty($uname) || empty($email) || empty($oldpass) || empty($newpass) || empty($passwordconfirm)) {
        return false;
    }

    //check username
    $checkUname = mysqli_query($connection,"SELECT * FROM user WHERE username = '$uname'");

    if (mysqli_num_rows($checkUname) > 0) {

        return false;

    }

    //Check Email
    $checkEmail = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");

    if (mysqli_num_rows($checkEmail) > 0) {

        return false;

    }

    //Check Old Password
    $passwordCheck = mysqli_query($connection, "SELECT * FROM user WHERE id = '$id'");

    $item = mysqli_fetch_assoc($passwordCheck);

    if(!password_verify($oldpass, $item["password"])) {

        return false;
        
    }

    //Check confirmation password

    if ($newpass !== $passwordconfirm) {

        return false;

    }

    mysqli_query($connection, "UPDATE user SET username = '$uname', email = '$email', password = '$password' WHERE id = $id");

    return mysqli_affected_rows($connection);

}

function editProfil($data) {

    global $connection;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $ninduk = htmlspecialchars($data["ninduk"]);

    if (empty($nama) || empty($ninduk)) {
        return false;
    }

    if ($_SESSION["member"] === "siswa") {
        $query = "UPDATE siswa SET nama_siswa = '$nama', NIS = '$ninduk' WHERE user_id = $id";
    } else {
        $query = "UPDATE guru SET nama_guru = '$nama', NIG = '$ninduk' WHERE user_id = $id";
    }

    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}

function editMapel($data) {

    global $connection;

    $name = htmlspecialchars($data["mapelname"]);
    $id = $data["id"];

    if (empty($name)) {
        return false ;
    }

    //check nama sudaa tersedia atau belum

    $check = mysqli_query($connection, "SELECT * FROM mapel WHERE nama_mapel = '$name'");

    if (mysqli_num_rows($check) === 1) {
        return false ;
    }

    mysqli_query($connection, "UPDATE mapel SET nama_mapel = '$name' WHERE id = $id");

    return mysqli_affected_rows($connection);   

}

function editClass($data) {

    global $connection;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $wali = $data["walikelas"];
    $jurusan = $data["jurusan"];

    if (empty($nama)) {
        return false ;
    }

    if (empty($wali)) {
        $query = "UPDATE kelas SET nama_kelas = '$nama', jurusan = '$jurusan' WHERE id = $id" ; 
    } else {

        //check guru sudah menjadi wali atau belum
        $walicheck = mysqli_query($connection, "SELECT * FROM kelas WHERE wali_kelas = $wali");

        if(mysqli_num_rows($walicheck) > 0 ) {
            return false;
        } else {
            $query = "UPDATE kelas SET nama_kelas = '$nama', wali_kelas = '$wali', jurusan = '$jurusan' WHERE id = $id" ; 
        }

    }   

    //check nama sudaa tersedia atau belum

    $check = mysqli_query($connection, "SELECT * FROM mapel WHERE nama_mapel = '$nama'");

    if (mysqli_num_rows($check) === 1) {
        return false ;
    }

    mysqli_query($connection, $query );

    return mysqli_affected_rows($connection);

}



?>