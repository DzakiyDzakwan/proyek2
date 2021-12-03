<?php 

require 'function.php';

session_start();

/* var_dump($_COOKIE);
echo "<br>";
var_dump($_SESSION); */

//check cookie

if(isset($_COOKIE["login"])) {
    if ($_COOKIE["login"] =='true') {
        $_SESSION["login"] = TRUE;
    }
}

if(isset($_COOKIE["userID"])) {
    $_SESSION["userID"] = $_COOKIE["userID"];
    
}

if(isset($_COOKIE["admin"])) {
    if($_COOKIE["admin"] == 'true') {
        $_SESSION["admin"] = TRUE;
    }
}

if(isset($_COOKIE["member"])) {
    if($_COOKIE["member"] == "siswa") {
        $_SESSION["member"] = "siswa";
    } else {
        $_SESSION["member"] = "guru";
    }
}



//Check Session

if (isset($_SESSION["admin"])) {
    header('Location: admin.php');
}

if (isset($_SESSION["member"])) {
    if ($_SESSION["member"] === "siswa" ) {
        if (isset($_SESSION["login"])) {
            header("Location: dashboard.php");
        } else {
            header("Location: welcome.php");
        }
     } else {
        if (isset($_SESSION["login"])) {
            header("Location: dashboard.php");
        } else {
            header("Location: welcome.php");
        }
     }
     
}


//check tombol login
if (isset($_POST['login'])){
    
    $username = $_POST["uname"];
    $password = $_POST["password"];

    //check username
    $data = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($data)) {

        $row = mysqli_fetch_assoc($data);

        //Check Password
        if (password_verify($password, $row["password"])) {

            $id = $row["id"] ;
            $_SESSION["userID"] = $id;
           
            //set session userID
            if(isset($_POST["remember"])) {
                setcookie('userID',$id, time() + 3600 );
            }

           
            //Check Status
            if ($row["status"] === "ADMIN") {
                $_SESSION["login"] = TRUE;
                $_SESSION["admin"] = TRUE;

                //setcookie admin
                if(isset($_POST["remember"])) {
                    setcookie('login','true',time()+ 3600);
                    setcookie('admin','true',time()+ 3600);
                }

                header('Location: admin.php');

            } elseif ($row["status"] === "SISWA") {

                $_SESSION["member"] = "siswa";
                $profileCheckSiswa = mysqli_query($connection, "SELECT * FROM siswa WHERE user_id = $id ") ;

                //setcookie siswa
                if(isset($_POST["remember"])) {
                    setcookie('member','siswa',time()+60);
                }

                if (mysqli_fetch_assoc($profileCheckSiswa)) {
                    $_SESSION["login"] = TRUE;
                    if(isset($_POST["remember"])) {
                        setcookie('login','true', time()+ 3600);
                    }
                    header("Location: dashboard.php");
                } else {
                    header('Location: welcome.php');
                }

                
            } elseif ($row["status"] === "GURU") {

                $_SESSION["member"] = 'guru';
                $profileCheckGuru = mysqli_query($connection, "SELECT * FROM guru WHERE user_id = $id") ;

                //setcookie guru
                if(isset($_POST["remember"])) {
                    setcookie('member','guru',time()+60);
                }

                if (mysqli_fetch_assoc($profileCheckGuru)) {
                    $_SESSION["login"] = TRUE;
                    if(isset($_POST["remember"])) {
                        setcookie('login','true', time()+ 3600);
                    }
                    header("Location: dashboard.php");
                } else {
                    header("Location: welcome.php");
                }
            }

        } else {

            $passwordCheck = TRUE;

        }
  

    } else {

        $userCheck = TRUE;

    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Merriweather:wght@300;400;700;900&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/logreg.css">
</head>
<body>

<div class="container my-5 py-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 py-1">
                <div class="title-section">
                    <h2>School.ID</h2>
                </div>
                <div class="icon-section">
                    <img class="hero-icon" src="school.png" alt="" >
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div> 

                    <h2 class="text-center my-3">Login</h2>
                    
                    
                    <table class="mx-auto">
                        <form method="POST" id="reguser"> 
                             
                             <!-- User Name -->

                                 <tr>
                                    <td colspan="2">
                                        <label for="uname">User name</label>
                                        <input type="text" class="form-control" name="uname" id="uname" autocomplete="off" >
                                    </td>
                                 </tr>
            
                        
                                 <!-- Password -->
                                 <tr>
                                     <td colspan="2">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                        
                                        <div class="d-flex remember px-2">
                                            <div>
                                                <input type="checkbox" name="remember" id="remember">
                                                <label for="remember" style="font-size: 12px;">remember me</label>
                                            </div>
                                            <a href="logout.php" style="font-size: 14px; text-decoration: none; margin-top: 3px;">forgot ?</a>
                                        </div>
                                     </td>
                                 </tr>

                            
                                <!-- Register Button -->
                                <tr>
                                    <td colspan="2">
                                       <button class="btn-outline-success form-control" name="login" >Login</button>
                                    </td>
                                </tr>     
                        </form>
                        <tr>
                            <td>
                                <span>Doesnt have account? <a href="register.php">Register here</a></span>
                            </td>
                        </tr>
                        <tr>
                            <td coslpan="2">
                                 
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

                                <?php if(isset($_POST["login"])) : ?>

                                    <?php if(empty($_POST["uname"]) && empty($_POST["password"])) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Masukkan Username & Password !
                                            </div>
                                        </div>
                                    <?php elseif(isset($userCheck)) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Username Salah !
                                            </div>
                                        </div>
                                    <?php elseif(isset($passwordCheck)) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Password Salah !
                                            </div>
                                        </div>
                                    <?php elseif(empty($_POST["uname"])) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Masukkan Username !
                                            </div>
                                        </div>
                                    <?php elseif(empty($_POST["password"])) : ?>
                                        <div class="alert alert-danger d-flex align-items-center mx-auto" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                                Masukkan Password !
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