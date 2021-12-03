<?php 

require 'function.php';

$kelas = $_GET["id"];
$guru = $_GET["guru"];

var_dump($kelas);
var_dump($guru);


$enroll = mysqli_query($connection, "INSERT INTO mapel_kelas(kelas,guru) VALUES($kelas, $guru)");

if (mysqli_affected_rows($connection) > 0) {
    echo "<script>
            alert(`kelas berhasil dienroll`)
            document.location.href = 'class.php'
            </script>";
} else {
    echo "<script>
            alert('kelas gagal dienroll')
            document.location.href = 'class.php'
            </script>";
}

?>