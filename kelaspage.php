<?php 

//function
require 'function.php';

//Session
session_start();

if(!isset($_SESSION["login"])) {
    header('Location: login.php');
}

if (isset($_SESSION["member"])) {

    if ($_SESSION["member"] !== "guru" ) {
        header('Location: dashboard.php');
    }

}

//idKelas
$kelasID = $_GET["kelas"];

//Create tugas
if(isset($_POST["create"])) {

    if(addTugas($_POST) > 0) {
        header("Location: kelaspage.php?kelas=$kelasID");
    } else {
        echo "gagal bro";
    }
}

//var_dump($kelasID);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewKelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/viewkelas.css">
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViewKelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/viewkelas.css">
</head>
<body>

    <?php include'navbar.php'?>

    <?php 
         /* TUgas */
         $tugas = show("SELECT * FROM tugas WHERE guru = $navbarID AND kelas = $kelasID");
         $siswa = show("SELECT * FROM siswa WHERE kelas_id = $kelasID");

         $countSiswa = count($siswa);
         $countTugas = count($tugas) ;
    ?>

      <!-- Isi Konten -->

      <div class="container main-container my-4 px-4 py-2 border">

            <!-- BREADCRUMB -->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Kelas</li>
                </ol>
            </nav>
            
            <div class="header border my-3 py-3 px-3 shadow-sm">

                <div>
                    <div>
                        <h4 class="my-0">Kelas 12 A IPA</h4>
                        <span>Wali Kelas</span>
                    </div>
                    <div class="create-tugas">

                    </div>
                </div>

                <div class="description my-3">
                    <table class="table table-borderless" style="text-align: center;">
                        <tr>
                            <th>Jumlah Siswa</th>
                            <th>Jumlah Tugas</th>
                        </tr>
                        <tr>
                            <td><a href="viewsiswa.php?kelas=<?=$kelasID?>" class="text-dark"><?=$countSiswa?></a></td>
                            <td><?=$countTugas?></td>
                        </tr>
                    </table>
                </div>

            </div>

            
            <div class="body my-3 px-3 my-3">

                <h4>List Tugas</h4>

                <!-- <div class="list-tugas">

                </div> -->

                <!-- LIST TUGAS PHP -->
                <?php 

                

                ?>
                
                <?php foreach($tugas as $tgs) : ?>
                    <div class="accordion" id="accordionPanelsStayOpenExample">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#list-tugas<?=$tgs["id"]?>" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                <?=$tgs["nama_tugas"]?>
                                </button>
                            </h2>
                            <div id="list-tugas<?=$tgs["id"]?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <h6 class="mt-0 mb-3"><?=$tgs["deadline"]?></h6>
                                    <p><?=$tgs["deskripsi"]?></p>
                                    <div class="d-flex">
                                        <a class="link-tugas mx-2" href="viewtugasguru.php?tugasID=<?=$tgs["id"]?>">See <i class="far fa-eye"></i></a> 
                                        <a class="link-delete mx-2" href="deletetugas.php?id=<?=$tgs["id"]?>&kelasID=<?=$kelasID?>">Delete <i class="fas fa-trash"></i></a>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
        
        
                    </div>
                <?php endforeach ; ?>

            </div>

            <div class="footer my-3 px-3 py-3 d-flex ">

                <div class="create-tugas">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#createTugas">
                        Create Tugas
                    </button>

                <!-- Modal -->
                <div class="modal fade" id="createTugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 700px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">

                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                </symbol>
                                                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                </symbol>
                                                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                                </symbol>
                                        </svg> -->
                                        
                                            
                                        <form  method="POST">
                                            <table class="table table-borderless">

                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="kelasID" value="<?=$kelasID?>">
                                                        <input type="hidden" name="guruID" value="<?=$navbarID?>">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label for="nama">Nama tugas</label>
                                                        <input class="form-control" placeholder="Masukkan nama tugas" type="text" name="nama" id="nama">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label for="description">Deskripsi Tugas</label>
                                                        <textarea class="form-control" placeholder="Masukkan Deskripsi Tugas" id="description" name="desc"></textarea>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <label for="date">Tanggal Deadline</label>
                                                        <input class="form-control" type="date" id="date" name="date">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><button class="btn btn-primary" name="create">Create</button></td>
                                                </tr>

                                        </table>
                                        </form>
                                            

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>


                </div>

            </div>

        </div>

      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        })
    </script>
</body>
</html>