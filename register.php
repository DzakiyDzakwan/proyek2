<?php

require 'function.php';

if (isset($_POST["register"])) {

    $password = $_POST["password1"];
    $password2 = $_POST["password2"];
    $username = $_POST["uname"];
    $email = $_POST["email"];

    $userCheck = mysqli_query($connection, "SELECT username FROM user WHERE username = '$username'");

    $emailCheck = mysqli_query($connection, "SELECT email FROM user WHERE email = '$email'");



    if (daftar($_POST) > 0) {
        header('Location: login.php');
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/logreg.css">
</head>
<body>

<div class="container my-2 py-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 py-5">
                <div class="title-section">
                    <h2>School.ID</h2>
                </div>
                <div class="icon-section">
                    <img class="hero-icon" src="school.png" alt="" >
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div>   

                <h2 class="text-center my-3">Register</h2>
                    <table class="mx-auto">
                        <form method="POST" id="reguser"> 
                             
                             <!-- User Name -->

                                 <tr>
                                    <td colspan="2">
                                        <label for="uname">User name</label>
                                        <?php if(isset($_POST["register"])) : ?>
                                            <?php if(empty($_POST["uname"])) : ?>

                                                <span style="color: red;">Tidak Boleh Kosong !</span>

                                            <?php endif ; ?>
                                        <?php endif ; ?>
                                        <input type="text" class="form-control" name="uname" id="uname" autocomplete="off" >
                                    </td>
                                 </tr>
                             
                             
                             
                             <!-- Email -->

                                <tr>
                                    <td colspan="2">
                                        <label for="email">Email</label>
                                        
                                        <?php if(isset($_POST["register"])) : ?>
                                            <?php if(empty($_POST["email"])) : ?>

                                                <span style="color: red;">Tidak Boleh Kosong !</span>

                                            <?php endif ; ?>
                                        <?php endif ; ?>

                                        <input type="email" class="form-control" name="email" id="email" autocomplete="off" >
                                    </td>
                                </tr>
                        
                                 <!-- Password -->
                                 <tr>
                                     <td colspan="2">
                                        <label for="password">Password</label>
                                        
                                        <?php if(isset($_POST["register"])) : ?>
                                            <?php if(empty($_POST["password1"])) : ?>

                                                <span style="color: red;">Tidak Boleh Kosong !</span>

                                            <?php endif ; ?>
                                        <?php endif ; ?>

                                        <input type="password" name="password1" class="form-control" id="password">
                                     </td>
                                 </tr>
                             
                                 <!-- Password Confirmation -->
                                <tr>
                                    <td colspan="2">
                                       <label for="password2"> Confirm Password</label>
                                       
                                       <?php if(isset($_POST["register"])) : ?>
                                            <?php if(empty($_POST["password2"])) : ?>

                                                <span style="color: red;">Tidak Boleh Kosong !</span>

                                            <?php elseif($password !== $password2) : ?>

                                                <span style="color: red;">Konfirmasi password tidak cocok</span>

                                            <?php endif ; ?>
                                        <?php endif ; ?>

                                       <input type="password" name="password2" class="form-control" id="password2">
                                    </td>
                                </tr>

                                <!-- Status -->

                                 <tr>
                                     <td colspan="2">
                                         <label for="status">Status</label>
                                         <select class="form-select"aria-label="Default select example" name="status" id="status" >
                                            <option value="SISWA">Siswa</option>
                                            <option value="GURU">Guru</option>
                                            <option value="ADMIN">Admin</option>
                                          </select>
                                     </td>
                                 </tr>
                            
                                <!-- Register Button -->
                                <tr>
                                    <td colspan="2">
                                       <button class="btn-outline-primary form-control" name="register" >Register </button>
                                    </td>
                                </tr>     
                        </form>
                        <tr>
                            <td>
                                <span>Have an acoount? <a href="login.php">login here</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td>

                                <!-- ALERT -->
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

                                <?php if(isset($_POST["register"])) : ?>

                                    <?php if(empty($_POST["uname"]) && empty($_POST["password"])) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Masukkan Data
                                            </div>
                                        </div>
                                    <?php elseif(mysqli_fetch_assoc($userCheck)) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Username Sudah terpakai
                                            </div>
                                        </div>
                                    <?php elseif(mysqli_fetch_assoc($emailCheck)) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Email Sudah terpakai
                                            </div>
                                        </div>
                                    <?php elseif($password !== $password2) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Konfirmasi Password gagal
                                            </div>
                                        </div>
                                    <?php endif ; ?>

                                <?php endif ; ?>

                            </td>
                        </tr>
                    </table>
                     
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>
</html>