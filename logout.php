<?php 

session_start();

session_unset();

session_destroy();

setcookie('login','',time() - 3600);

if(isset($_COOKIE["member"])) {
    setcookie('member','',time() - 3600);
} else {
    setcookie('admin','',time() - 3600);
}

setcookie('userID','',time() - 3600);

header('Location: login.php');

?>