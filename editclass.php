<?php

require 'function.php';
 session_start();

 if (!isset($_SESSION["admin"])) {
   header('Location: login.php');
 }

 $id = $_GET["id"];
 $kelas = show("SELECT * FROM kelas WHERE id = $id")[0];

 $guru = show("SELECT * FROM guru ");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
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
                <h2 class="text-center">Edit Kelas</h2>

                <form class="mx-auto py-4 px-3" method="POST">

                    <table>

                                <tr>
                                    <td>
                                        <input type="hidden" name="id" value=<?=$kelas["id"]?>>
                                    </td>
                                </tr>

                                <!-- Name -->
                                 <tr>
                                    <td colspan="2">
                                        <label class="text-center" for="nama">Kelas</label>
                                        <input type="text" class="form-control text-center" id="nama" name="nama" placeholder="<?=$kelas["nama_kelas"]?>" autocomplete="off">
                                    </td>
                                 </tr>

                                  <!-- Wali Kelas -->

                                <tr>
                                    <td colspan="2">
                                        <label class="text-center" for="status">Wali Kelas</label>
                                        <select class="form-select"aria-label="Default select example" name="walikelas" id="status" >
                                        <option value="" class="text-center" ></option>
                                            <?php foreach($guru as $gr) : ?>
                                                <?php  $id = $gr["id"] ?>
                                                <?php $query = mysqli_query($connection, "SELECT * FROM kelas WHERE wali_kelas = $id") ?>
                                                    <?php if(!mysqli_fetch_assoc($query)) : ?>
                                                        <option value="<?=$gr["id"]?>" class="text-center" ><?=$gr["nama_guru"]?></option>
                                                    <?php endif ; ?>
                                           <?php endforeach ; ?>
                                         </select>
                                    </td>
                                </tr>

                                <!-- Jruusan -->
                                <tr>
                                    <td colspan="2">
                                        <label class="text-center" for="status">Jurusan</label>
                                        <select class="form-select"aria-label="Default select example" name="jurusan" id="status" >
                                            <option value="IPA" class="text-center" >IPA</option>
                                            <option value="IPS" class="text-center" >IPS</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Register Button -->
                                <tr>
                                    <td colspan="2">
                                       <button class="btn-outline-success form-control" name="update">Add <i class="ms-2 fas fa-plus"></i></button>
                                    </td>
                                </tr>     

                        <tr>

                        <?php if(isset($_POST["update"])) : ?>
                            <?php if(editClass($_POST) > 0) : ?>
                                    <td>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Data kelas Berhasil Diubah</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </td>
                            <?php else : ?>
                                <td>
                                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                        <div>Data Gagal Dibuat</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </td>
                            <?php endif ; ?>
                        <?php endif ; ?>

                        </tr>

                    </table> 

                </form>
            </div>

        
        </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>

</body>
</html>