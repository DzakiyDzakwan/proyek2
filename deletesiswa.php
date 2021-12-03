<?php 

require 'function.php';

$id = $_GET["id"];

$hapus = mysqli_query($connection, "DELETE FROM siswa WHERE id = $id ");

if (mysqli_affected_rows($connection) > 0) {
    echo "<script>
            alert(`data berhasil dihapus`)
            document.location.href = 'siswa.php'
            </script>";
} else {
    echo "<script>
            alert('data gagal dihapus')
            document.location.href = 'siswa.php'
            </script>";
}

?>