<?php 

//function
require 'function.php';

//Session
session_start();

if(!isset($_SESSION["login"])) {
  header('Location: login.php');
}

if(isset($_SESSION["admin"])) {
  header('Location: admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/dashboard.css">

    <title>Dashboard Prototype</title>

</head>
<body>

    <?php include 'navbar.php' ?> 

      <!-- Welcome -->
    <!-- <div class="container my-5">
        <div class="welcome-greet mx-auto">
            <h2>Selamat Datang Budi Budiman</h2>
        </div>
    </div> -->


      <!-- Mading -->
      <div class="container my-3 mading">

          <div class="title-text mb-3">
            <h2 class="text-center">News</h2>
          </div>

          <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-inner">

              <div class="carousel-item active" data-bs-interval="10000">
                <img src="bear1.jpg" class="d-block w-100">
              </div>

              <div class="carousel-item" data-bs-interval="2000">
                <img src="bear2.jpg" class="d-block w-100">
              </div>

              <div class="carousel-item">
                <img src="bear3.jpg" class="d-block w-100">
              </div>

            </div>
          </div>
      </div>

      <!--MataPelajaran/Kelas-->
      <div class="container my-5 py-3 class-list">

        <?php if(isset($_SESSION["member"])) : ?>
          <?php if($_SESSION["member"] === "siswa") : ?>

            <!-- FOR SiSWA -->
          <div class="d-flex px-2 filter-class">
              <h3>Mata Pelajaran</h3>
          </div>

          <div class="list-class mb-3">
              <div class="row">

              <?php foreach($navbar as $mapel) : ?>
                  <div class="col-lg-6 col-md-6 my-3">
                      <div class="card text-center">
                          <img src="bear1.jpg" class="card-img-top">
                          <div class="card-body">
                            <h5 class="card-title"><?=$mapel["nama_mapel"]?></h5>
                            <a href="viewmapel.php" class="btn btn-outline-primary" style="width : 50%;">Masuk</a>
                          </div>
                        </div>
                  </div>
              <?php endforeach ; ?>

              </div>
          </div>

          <?php else : ?>
          
          <!-- FOR GURU -->
          <div class="d-flex px-2 filter-class">
              <h3>Kelas Yang diikuti</h3>
          </div>

          <div class="list-class mb-3">
              <div class="row">

                <?php foreach($navbar as $kelas) : ?>
                  <div class="col-lg-6 col-md-6 my-3">
                      <div class="card">
                          <img src="bear1.jpg" class="card-img-top">
                          <div class="card-body">
                            <h5 class="card-title"><?=$kelas["kelas"]?> <?=$kelas["jurusan"]?></h5>
                            <?php 
                              $kelasid = $kelas["kelasid"];
                              $jumlah = show("SELECT COUNT(id) as jumlahmurid FROM siswa WHERE kelas_id = $kelasid")[0];
                            ?>
                            <p class="card-text"><?=$jumlah["jumlahmurid"]; ?> Siswa</p>
                            <a href="kelaspage.php?kelas=<?=$kelas["kelasid"];?>" class="btn btn-outline-primary" style="width:20%;">Masuk</a>
                          </div>
                        </div>
                  </div>
                <?php endforeach ; ?>
                
              </div>
          </div>

          <?php endif ; ?>
        <?php endif ; ?>

      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>

</body>
</html>