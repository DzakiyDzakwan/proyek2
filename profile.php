<?php 

require 'function.php';

session_start();

/* var_dump($_SESSION);
echo "<br>";
var_dump($_COOKIE); */

if(!isset($_SESSION["login"])) {
    header('Location: login.php');
}

$userID = $_SESSION["userID"];

$user = show("SELECT * FROM user WHERE id = $userID")[0];

//var_dump($user["username"]);

if(isset($_SESSION["member"])) {
    //Siswa
    if($_SESSION["member"] === "siswa") {
        $profil = show("SELECT * FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id WHERE user_id = $userID")[0];
    } else {
        $profil = show("SELECT * FROM guru JOIN mapel ON guru.mapel_id = mapel.id WHERE user_id = $userID")[0];
    }
}

if(isset($_POST["report"])) {
    header("Location: mpdf2.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" type="text/css" href="style/profile.css">
</head>
<body>

    <?php include'navbar.php' ?> 
   
        <div class="container form-container my-5 py-3 border">
            <div class="row">

                <!-- Isi Konten -->
                    <?php if(isset($_SESSION["member"])) : ?>

                        <!-- FOR MURID -->
                        <?php if($_SESSION["member"] === "siswa") :?>
                        <!-- Biodata -->
                        <div class="col-lg-12 py-2 px-4 biodata">

                            <div class="title-form my-3 mx-auto">
                                <h4>Biodata</h4>
                            </div>

                            <table class="mx-auto table" width="60%">
                            
                                <tr>
                                    <td class="px-3 py-3 data-title">Username</td>
                                    <td class="px-2">: </td>
                                    <td class="py-3 px-3 px-4 data"> <?=$user["username"]?> </td>
                        
                                    <td class="px-4 py-3 data-title">Nama</td>
                                    <td class="px-2">:</td>
                                    <td class="py-3 px-3 data"> <?=$profil["nama_siswa"]?> </td>
                                </tr>

                                <tr>
                                    <td class="px-3 py-3 data-title">NIS</td>
                                    <td class="px-2">:</td>
                                    <td class="py-3 px-4 data"> <?=$profil["NIS"]?> </td>

                                    <td class="px-4 py-3 data-title">Email</td>
                                    <td class="px-2">:</td>
                                    <td class="py-3 px-3 data"> <?=$user["email"]?> </td>
                                </tr>

                                <tr>
                                    <td class="px-3 py-3 data-title">Kelas</td>
                                    <td class="px-2">:</td>
                                    <td class="py-3 px-4 data"> <?=$profil["nama_kelas"]?> </td>

                                    <td class="px-4 py-3 data-title">Jurusan</td>
                                    <td class="px-2">:</td>
                                    <td class="py-3 px-3 data"> <?=$profil["jurusan"]?> </td>
                                </tr>

                            </table>
                        </div>

                        <!-- Table-Nilai -->
                        <div class="col-lg-12 px-3 py-2 nilai">

                            <div class="title-form-2 mt-3 mx-auto">
                                <h4>Nilai Siswa</h4>
                            </div>

                            <?php foreach($navbar as $mapel) : ?>
                                <div class="table-nilai px-3 my-4">
                                    <h5 class="mt-3 mb-0"><?=$mapel["nama_mapel"]?></h5>
                                    
                                    <?php 
                                        $idmapel = $mapel["id"] ;
                                        $namaGuru = show("SELECT nama_guru FROM guru WHERE mapel_id = $idmapel")[0];

                                        $idSiswa = $data["id"];

                                        $tugas = show("SELECT nilai FROM jawaban WHERE siswa = $idSiswa AND mapel = $idmapel");
                                        $t = 1;
                                        
                                    ?>

                                    <span style="font-family:'Roboto Consended';"><?=$namaGuru["nama_guru"]?></span>

                                    <table width="100%" class="mx-auto table table-bordered">

                                        <tr>
                                            <?php foreach($tugas as $tgs) : ?>
                                                <th class="px-3 text-center">Tugas 1</th>
                                                <?php $t ++ ?>
                                            <?php endforeach ; ?>
                                        <tr>
                                            <?php foreach($tugas as $tgs) : ?>
                                                <td class="p-3"><?=$tgs["nilai"]?></td>
                                            <?php endforeach ; ?>
                                        </tr>
                    
                                    </table>

                                </div>
                            <?php endforeach ; ?>
                            
                        </div>

                    <!--- FOR GURU -->
                    <?php else: ?>

                    <!-- Biodata -->
                    <div class="col-lg-12 py-2 px-4 biodata">

                        <div class="title-form my-3 mx-auto">
                            <h4>Biodata</h4>
                        </div>

                        <table class="mx-auto table" width="60%">                    
            
                            <tr>
                            <td class="px-3 py-3 data-title">Username</td>
                                <td class="px-2">: </td>
                                <td class="py-3 px-3 px-4 data"> <?=$user["username"]?> </td>
                    
                                <td class="px-4 py-3 data-title">Nama</td>
                                <td class="px-2">:</td>
                                <td class="py-3 px-3 data"> <?=$profil["nama_guru"]?> </td>
                            </tr>

                            <tr>
                                <td class="px-3 py-3 data-title">NIG</td>
                                <td class="px-2">:</td>
                                <td class="py-3 px-4 data"> <?=$profil["NIG"]?> </td>

                                <td class="px-4 py-3 data-title">Email</td>
                                <td class="px-2">:</td>
                                <td class="py-3 px-3 data"> <?=$user["email"]?> </td>
                            </tr>

                            <tr>
                                <td class="px-3 py-3 data-title">Mapel</td>
                                <td class="px-2">:</td>
                                <td class="py-3 px-4 data"> <?=$profil["nama_mapel"]?> </td>
                            </tr>


                        <?php endif ; ?>
                    <?php endif ; ?>

                    </table>
                </div>

                <!---Print-->
                <div class="print-button">
                    <form method="POST">
                        <button class="btn btn-success" name="report">Report<i class="fas fa-print mx-2"></i></button>
                    </form>
                </div>

            </div>
        </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
</body>
</html>