<?php 

 session_start();

 require 'function.php';

 if (!isset($_SESSION["admin"])) {
   header('Location: login.php');
 }

 if (isset($_POST["update"])) {

    $name = $_POST["mapelname"];

    $check = mysqli_query($connection, "SELECT * FROM mapel WHERE nama_mapel = '$name'");

    if (mysqli_num_rows($check) === 1) {
        $usedname = TRUE;
    }

 }

 $id = $_GET["id"];

 $mapel = show("SELECT * FROM mapel WHERE id = $id")[0] ;

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Pelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/create.css">
    </head>
<body>
    
    <?php include'navbar.php' ?>

        <!-- Konten -->

        <div class="container create-container my-5 px-4 py-3 border">

            <!-- Create-Form -->
            <div class="create-form mx-auto">
                <h2 class="text-center">Edit Mata Pelajaran</h2>

                <form class="mx-auto py-4 px-3" method ="POST">

                    <table>

                        <!-- ID -->
                        <tr>
                            <td colspan="2">                                       
                                <input type="hidden" name="id" id="id" class="form-control" autocomplete="off" value="<?=$mapel["id"]?>">
                            </td>
                        </tr>

                        <!-- Name -->
                        <tr>
                            <td colspan="2">
                                <label for="mapelname" >Mata Pelajaran</label>                                        
                                <input type="text" name="mapelname" id="mapelname" class="form-control" autocomplete="off" placeholder="<?=$mapel["nama_mapel"]?>">
                            </td>
                        </tr>
                            
                        <!-- Register Button -->
                        <tr>
                            <td colspan="2">
                                <button class="btn-success form-control" name="update">Change <i class="ms-2 fas fa-plus"></i></button>
                            </td>
                        </tr>     

                    </table> 

                </form>

                <!-- SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>

                <!-- ALERT -->
                <?php if(isset($_POST["update"])) : ?>

                    <?php if(editMapel($_POST)) : ?>
                        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show mx-auto" role="alert" style="width:40%;">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <div>
                            Data Berhasil diubah
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif(empty($_POST["mapelname"])) : ?>
                        <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show mx-auto" role="alert" style="width:40%;">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                            Isi Data Terlebih dahulu
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif(isset($usedname)) : ?>
                        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show mx-auto" role="alert" style="width:40%;">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                            Mata Pelajaran sudah tersedia
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php else : ?>
                        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show mx-auto" role="alert" style="width:40%;">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                            Data Gagal di input
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <?php endif ; ?>

                <?php endif ; ?>


            </div>

        
        </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>

</body>
</html>