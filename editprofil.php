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
        $profil = show("SELECT * FROM siswa WHERE user_id = $userID")[0];
    } else {
        $profil = show("SELECT * FROM guru WHERE user_id = $userID")[0];
    }
}

if(isset($_POST["updateuser"])) {

    $id = $_POST["id"];
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $oldpass = $_POST["passwordold"];
    $newpass = $_POST["passwordnew"];
    $passwordconfirm = $_POST["passwordconfirm"];
    
    //check username
    $checkUname = mysqli_query($connection,"SELECT * FROM user WHERE username = '$uname'");

    if (mysqli_num_rows($checkUname) > 0) {

        $usernameUSed = true;

    }

    //Check Email
    $checkEmail = mysqli_query($connection, "SELECT * FROM user WHERE email = '$email'");

    if (mysqli_num_rows($checkEmail) > 0) {

       $emailUsed = true;

    }

    //Check Old Password
    $passwordCheck = mysqli_query($connection, "SELECT * FROM user WHERE id = '$id'");

    $item = mysqli_fetch_assoc($passwordCheck);

    if(!password_verify($oldpass, $item["password"])) {

        $passwordCheck = TRUE;
        
    }

    //Check confirmation password

    if ($newpass !== $passwordconfirm) {

        $passwordMatch = TRUE;

    }

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
    <link rel="stylesheet" type="text/css" href="style/editprofil.css">
</head>
<body>

    <?php include'navbar.php' ?>    

     <!-- Isi Konten -->
     <div class="container form-container my-5 border">
         <div class="row">

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

        <?php if(isset($_POST["updateprofil"])) : ?>
            <?php if(editProfil($_POST) > 0 ) : ?>

                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    Profilberhasil di ubah
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php else : ?>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show  mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    Mata Pelajaran sudah tersedia
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php endif ; ?>

        <?php endif ; ?>


        <?php if(isset($_POST["updateuser"])) : ?>
            <?php if(editUser($_POST) > 0 ) : ?>

                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    Data User berhasil di ubah
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php elseif (empty($_POST["uname"]) || empty($_POST["email"]) || empty($_POST["passwordold"]) || empty($_POST["passwordnew"]) || empty($_POST["passwordconfirm"])) : ?>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show  mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    Data harus diisi terlebih dahulu
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php elseif(isset($usernameUSed)) : ?>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show  mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        Username Sudah terpakai
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php elseif(isset($emailUsed)) : ?>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show  mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        Email Sudah terpakai
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php elseif(isset($passwordCheck)) : ?>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show  mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        Old Password tidak Cocok
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php elseif(isset($passwordMatch)) : ?>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show  mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                        Password Confirmation tidak cocok
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php else : ?>

                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show  mx-auto mt-3" role="alert" style="width:70%;">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    Data gagal diubah
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php endif ; ?>

        <?php endif ; ?>


            <!-- User Setting -->
            <div class="col-lg-12 py-2 px-4 mb-3">
                
                <!--User Form Edit -->
                    <div class="title-form my-3 mx-auto">
                        <h4>User Settings</h4>
                    </div>
                    <form class="mx-auto" method="POST">
                        <table width="100%">

                            <tr>
                                <td>
                                    <input type="hidden" name="id" value="<?=$userID?>">
                                </td>
                            </tr>
                        
                            <tr>
                                <td class="px-3 py-2" width="15%">
                                    <label for="uname">Username</label>
                                </td>
                                <td class="px-3 py-2">
                                    <input class="form-control" type="text" name="uname" id="uname" placeholder="<?=$user["username"]?>">
                                </td>
                            </tr>

                            <tr>
                                <td class="px-3 py-2" width="15%">
                                    <label for="email">Email</label>
                                </td>
                                <td class="px-3 py-2">
                                    <input class="form-control" type="email" name="email" id="email" placeholder="<?=$user["email"]?>">
                                </td>
                            </tr>

                            <tr>
                                <td class="px-3 py-2">
                                    <label for="password">Old Password</label>
                                </td>
                                <td class="px-3 py-2">
                                    <input class="form-control" type="password" name="passwordold" id="password" >
                                </td>
                            </tr>

                            <tr>
                                <td class="px-3 py-2">
                                    <label for="password">New Password</label>
                                </td>
                                <td class="px-3 py-2">
                                    <input class="form-control" type="password" name="passwordnew" id="password">
                                </td>
                            </tr>

                            <tr>
                                <td class="px-3 py-2">
                                    <label for="password">password Confirmation</label>
                                </td>
                                <td class="px-3 py-2">
                                    <input class="form-control" type="password" name="passwordconfirm" id="password">
                                </td>
                            </tr>

                            <tr>
                                <td class="px-3 py-2" colspan="2">
                                    <button class="btn btn-success d-block ms-auto" style="width: 85%;" name="updateuser">Save</button>
                                </td>
                            </tr>

                        </table>
                    </form>
            </div>

            <!-- Profile Setting -->
            <?php if(isset($_SESSION["member"])) : ?>
                <div class="col-lg-12 py-2 px-4 my-3">
                    
                    <!--User Form Edit -->
                        <div class="title-form my-3 mx-auto">
                            <h4>Profile Settings</h4>
                        </div>
                        <form class="mx-auto" method="POST">
                            <table width="100%">

                                <tr>
                                    <td>
                                        <input type="hidden" name="id" value="<?=$userID?>">
                                    </td>
                                </tr>

                                <?php if(isset($_SESSION["member"])) : ?>

                                    <!-- FOR MURID -->
                                    <?php if($_SESSION["member"] === "siswa") :?>

                                        <!-- nama -->
                                        <tr>
                                            <td class="px-3 py-2" width="15%">
                                                <label for="name">Nama</label>
                                            </td>
                                            <td class="px-3 py-2">
                                                <input class="form-control" type="text" name="nama" id="name" placeholder="<?=$profil["nama_siswa"]?>" autocomplete="off">
                                            </td>
                                        </tr>

                                        <!-- nis -->
                                        <tr>
                                            <td class="px-3 py-2" width="15%">
                                                <label for="nis">NIS</label>
                                            </td>
                                            <td class="px-3 py-2">
                                                <input class="form-control" type="text" name="ninduk" id="nis" placeholder="<?=$profil["NIS"]?>" autocomplete="off">
                                            </td>
                                        </tr>

                                    <!-- FOR GURU -->
                                    <?php else: ?>

                                        <!-- nama -->
                                    <tr>
                                        <td class="px-3 py-2" width="15%">
                                            <label for="name">Nama</label>
                                        </td>
                                        <td class="px-3 py-2">
                                            <input class="form-control" type="text" name="nama" id="name" placeholder="<?=$profil["nama_guru"]?>" autocomplete="off">
                                        </td>
                                    </tr>

                                    <!-- nig -->
                                    <tr>
                                        <td class="px-3 py-2" width="15%">
                                            <label for="nig">NIG</label>
                                        </td>
                                        <td class="px-3 py-2">
                                            <input class="form-control" type="text" name="ninduk" id="nig" placeholder="<?=$profil["NIG"]?>" autocomplete="off">
                                        </td>
                                    </tr>

                                    <?php endif ; ?>

                                <?php endif ; ?>

                                <!-- <tr>
                                    <td class="px-3 py-2">
                                        <label for="telephone">Telepon</label>
                                    </td>
                                    <td class="px-3 py-2">
                                        <input class="form-control" type="text" name="telephone" id="telephone">
                                    </td>
                                </tr> -->

                                <tr>
                                    <td class="px-3 py-2" colspan="2">
                                        <button class="btn btn-success d-block ms-auto" style="width: 85%;" name="updateprofil">Save</button>
                                    </td>
                                </tr>

                            </table>
                        </form>
                </div>
            <?php endif ;?>
         </div>
     </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9c0c4e63c7.js" crossorigin="anonymous"></script>
</body>
</html>