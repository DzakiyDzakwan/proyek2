<?php 

session_start();

require 'function.php';

var_dump($_SESSION);

//check session
if (!isset($_SESSION["member"])) {
    header('Location: login.php');
}

if (isset($_SESSION["admin"])) {
    header('Location: admin.php');
}

if (isset($_SESSION["member"])) {
    if ($_SESSION["member"] === "siswa" ) {
        if(isset($_SESSION["login"])) {
            header("Location: siswa.php");
        }
        
     }
     
     if ($_SESSION["member"] === "guru" ) {
        if(isset($_SESSION["login"])) {
            header("Location: guru.php");
        }
        
     }
}

//Chechk Session Member

if ($_SESSION["member"]==="siswa") {
    $kelas = show("SELECT * FROM kelas");
    if (isset($_POST["create"])) {
        
        if (addSiswa($_POST) > 0) {
            $_SESSION["login"] = TRUE;
            if($_COOKIE["member"]=='siswa') {
                setcookie('login','true',time() + 3600);
            }
            header("Location: siswa.php");
        } else {
            echo mysqli_error($connection);
        }
    }
} else {
    $mapel = show("SELECT * FROM mapel");
    if (isset($_POST["create"])) {
        
        if (addGuru($_POST) > 0) {
            $_SESSION["login"] = TRUE;
            if($_COOKIE["member"]=='guru') {
                setcookie('login','true',time() + 3600);
            }
            header("Location: guru.php");
        } else {
            echo mysqli_error($connection);
        }
    }
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
    <link rel="stylesheet" href="style/welcome.css">
    <title>Welcome</title>
</head>
<body>
    
    <div class="container my-4 py-5">
        <div class="registerbanner py-5">
            <div class="welcome-sentence mx-auto">
                <p class="text-center">Selamat datang di </p>
                <p class="logo text-center">School.Id</p>
                <p class="text-center">Silahkan isi profil anda terlebih dahulu</p>
            </div>

            <div class="welcome-register">   
                <table class="mx-auto">
                    <form method="POST" id="reguser"> 
                         
                        <!-- user-ID -->

                        <tr>
                            <td colspan="2">
                                <input type="hidden" class="form-control" name="userid" id="userid" value="<?=$_SESSION['userID']?>">
                            </td>
                         </tr>


                         <!-- Nama -->

                             <tr>
                                <td >
                                    <label for="nama">Nama</label>
                                    <?php if(isset($_POST["create"])) : ?>
                                            <?php if(empty($_POST["nama"])) : ?>

                                                <span style="color: red;">Tidak Boleh Kosong !</span>

                                            <?php endif ; ?>
                                        <?php endif ; ?>
                                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off">
                                </td>

                                <!-- FOR SISWA -->
                                <?php if($_SESSION["member"] === "siswa") : ?>

                                    <td >
                                        <label for="nis">NIS</label>
                                        <?php if(isset($_POST["create"])) : ?>
                                            <?php if(empty($_POST["nis"])) : ?>

                                                <span style="color: red;">Tidak Boleh Kosong !</span>

                                            <?php endif ; ?>
                                        <?php endif ; ?>
                                        <input type="text" name="nis" class="form-control" id="nis" autocomplete="off">
                                    </td>

                                <?php endif ; ?>

                                 <!-- FOR GURU -->

                                 <?php if($_SESSION["member"] === "guru") : ?>

                                    <td >
                                        <label for="nig">NIG</label>
                                        <?php if(isset($_POST["create"])) : ?>
                                            <?php if(empty($_POST["nig"])) : ?>

                                                <span style="color: red;">Tidak Boleh Kosong !</span>

                                            <?php endif ; ?>
                                        <?php endif ; ?>
                                        <input type="text" name="nig" class="form-control" id="nig" autocomplete="off">
                                    </td>

                                <?php endif ; ?>
                                 

                             </tr>

                             <!-- Kelas -->
                             <tr>
                                
                             <?php if($_SESSION["member"] === "siswa") : ?>
                            
                                <td colspan="2">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-select"aria-label="Default select example" name="kelas" id="kelas" >
                                        <?php foreach($kelas as $kls) : ?>
                                       <option value="<?=$kls["id"]?>"><?=$kls["nama_kelas"]?> <?=$kls["jurusan"]?></option>
                                       <?php endforeach; ?>
                                     </select>
                                </td>

                            <?php endif ; ?>

                               <!--  For GURU -->

                               <?php if($_SESSION["member"] === "guru") : ?>
                            
                                
                                <td colspan="2">
                                    <label for="mapel">Mapel</label>
                                    <select class="form-select"aria-label="Default select example" name="mapel" id="mapel" >
                                       <?php foreach($mapel as $mpl) : ?>
                                        <option value="<?=$mpl["id"];?>"><?=$mpl["nama_mapel"];?></option>
                                       <?php endforeach ;?>
                                     </select>
                                </td>
                                

                            <?php endif ; ?>

                                

                            </tr>
                        
                            <!-- Continue Button -->
                            <tr>
                                <td colspan="2">
                                   <button class="btn-outline-primary form-control" name="create" >Continue</button>
                                </td>
                            </tr>     
                    </form>
                </table> 
            </div>

        </div>
    </div>

    <a href="logout.php">Logout</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>