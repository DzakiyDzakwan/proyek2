<?php

//function
require 'function.php';

//Session
 session_start();

 //var_dump($_COOKIE);

 //var_dump($_SESSION);

 if (!isset($_SESSION["admin"])) {
   header('Location: login.php');
 }

 $countMapel = show("SELECT COUNT(id) as jumlah FROM mapel")[0];
 $countSiswa = show("SELECT COUNT(id) as jumlah FROM siswa")[0];
 $countGuru = show("SELECT COUNT(id) as jumlah FROM guru")[0];
 $countUser = show("SELECT COUNT(id) as jumlah FROM user")[0];
 $countMapel = show("SELECT COUNT(id) as jumlah FROM mapel")[0];
 $countKelas = show("SELECT COUNT(id) as jumlah FROM kelas")[0];

 //var_dump($countMapel);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/navbar.css">
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>

    <?php include'navbar.php' ?>

      <!-- Konten Admin -->
      <div class="container my-5 card-container">

        <div class="row border py-5">

            <div class="col-lg-4 py-4">
                <div class="card text-center mx-auto" style="width: 80%;">
                    <div class="card-body">
                        <i class="fas fa-user-graduate mb-2"></i>
                        <h5 class="card-title">Jumlah Siswa</h5>
                        <p class="card-text"><?=$countSiswa["jumlah"] ?></p>
                        <a href="siswa.php" class="btn btn-outline-success">Lihat Siswa</a>
                    </div>
                  </div>
            </div>

            <div class="col-lg-4 py-4">
                <div class="card text-center mx-auto" style="width: 80%;">
                    <div class="card-body">
                        <i class="fas fa-chalkboard-teacher mb-2"></i>
                      <h5 class="card-title">Jumlah Guru</h5>
                      <p class="card-text"><?=$countGuru["jumlah"] ?></p>
                      <a href="guru.php" class="btn btn-outline-success">Liihat Guru</a>
                    </div>
                  </div>
            </div>

            <div class="col-lg-4 py-4">
                <div class="card text-center mx-auto" style="width: 80%;">
                    <div class="card-body">
                        <i class="fas fa-user-shield mb-2"></i>
                      <h5 class="card-title">Jumlah User</h5>
                      <p class="card-text"><?=$countUser["jumlah"] ?></p>
                      <a href="user.php" class="btn btn-outline-success">Lihat User</a>
                    </div>
                  </div>
            </div>

            <div class="col-lg-6 py-4">
                <div class="card text-center mx-auto" style="width: 60%;">
                    <div class="card-body">
                        <i class="fas fa-chalkboard mb-2"></i>
                      <h5 class="card-title">Jumlah Kelas</h5>
                      <p class="card-text"><?=$countKelas["jumlah"] ?></p>
                      <a href="class.php" class="btn btn-outline-success">Lihat Kelas</a>
                    </div>
                  </div>
            </div>

            <div class="col-lg-6 py-4">
                <div class="card text-center mx-auto" style="width: 60%;">
                    <div class="card-body">
                        <i class="fas fa-book mb-2"></i>
                      <h5 class="card-title">Jumlah Matapelajaran</h5>
                      <p class="card-text"><?=$countMapel["jumlah"] ?></p>
                      <a href="mapel.php" class="btn btn-outline-success">Lihat Mapel</a>
                    </div>
                  </div>
            </div>

        </div>

      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
    
</body>
</html>