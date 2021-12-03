<?php 

//Function
require 'function.php';

//session
session_start();

if(!isset($_SESSION["login"])) {
  header("Location: login.php");
}

//pagination
$totalData = count(show("SELECT siswa.id as id, siswa.nama_siswa as nama, siswa.NIS as nis, kelas.nama_kelas as kelas, kelas.jurusan as jurusan FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id ")) ;

$dataPerhalaman = 5;

$jumlahHalaman = ceil($totalData/$dataPerhalaman);

if (isset($_GET["page"])) {
    $halamanAktif = $_GET["page"];
} else {
    $halamanAktif = 1;
}

$dataAwal = ($halamanAktif * $dataPerhalaman) - $dataPerhalaman;

//Show Data
$siswa = show("SELECT siswa.id as id, siswa.nama_siswa as nama, siswa.NIS as nis, kelas.nama_kelas as kelas, kelas.jurusan as jurusan FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id LIMIT $dataAwal, $dataPerhalaman ");
$i = $dataAwal + 1;

//searching/filter
if(isset($_POST["find"])) {

  //cariSiswa($_POST);
  $siswa = cariSiswa($_POST);
}




//var_dump($siswa);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/template.css">
</head>
<body>

   <?php include 'navbar.php' ?>
    
     <!--  Ini Konten -->
    <div class="container my-4 px-4 py-3 table-data border">

        <!--Data Table-->

        <div class="table-title">
          <h4>List Siswa</h4>
        </div>
        
       <!--  Searchbar -->
        <form class="d-flex search my-3 mx-auto" method="POST">
          <input class="form-control me-2" type="search" placeholder="Cari Siswa" aria-label="Search" name="keyword" autocomplete="off">
          <button class="btn btn-outline-success" type="submit" name="find">Search</button>
          <select class="btn ms-3 btn-outline-dark" name="filter" id="">
            <option value="">Jurusan</option>
            <option value="IPA">IPA</option>
            <option value="IPS">IPS</option>
          </select>
        </form>

        <div class="container-fluid mt-3">
          <table class="mx-auto table">

            <tr class="thead">
              <td class="table-header">No. </td>
              <td class="table-header">Nama</td>
              <td class="table-header">NIS</td>
              <td class="table-header">Kelas</td>
              <td class="table-header">Jurusan</td>
                <?php if(isset($_SESSION["admin"])) : ?>
                    <td class="table-header">Action</td>
                <?php endif ; ?>
              
            </tr>
  
            
            <?php foreach($siswa as $ssw) : ?>
                <tr class="tbody">
                    <td class="table-body"><?=$i?></td>
                    <td class="table-body"><?=$ssw["nama"] ?></td>
                    <td class="table-body"><?=$ssw["nis"]?></td>
                    <td class="table-body"><?=$ssw["kelas"]?></td>
                    <td class="table-body"><?=$ssw["jurusan"]?></td>

                     <?php if(isset($_SESSION["admin"])) : ?>
                      <td>
                  <!-- <a href="edit.php?id=<?=$ssw["id"]?>" class="btn btn-success">Edit</a> -->
                  <!-- <a href="" class="btn btn-danger">Delete</a> -->

                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$ssw["id"]?>">
                    Delete
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="delete<?=$ssw["id"]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Data dan semua yang bersangkutan akan dihapus dan tidak dapat dikembalikan, Yakin ingin menghapus data ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                          <a href="deletesiswa.php?id=<?=$ssw["id"]?>" class="btn btn-outline-danger">Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>

                </td>

                    <?php endif; ?>

                </tr>
            <?php $i++ ?>   
            <?php endforeach ; ?>
  
          </table>
        </div>
        

        <!-- Pagination -->
        <?php include 'pagination.php' ?>


    </div>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
</body>
</html>