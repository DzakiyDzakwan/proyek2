<?php 

require 'function.php';

$id = $_GET["id"];
$kelasID = $_GET["kelasID"];

$hapus = mysqli_query($connection, "DELETE FROM tugas WHERE id = $id ");

if (mysqli_affected_rows($connection) > 0) {
    echo "<script>
            alert(`data berhasil dihapus`)
            document.location.href = 'kelaspage.php?kelas=$kelasID'
            </script>";
} else {
    echo "<script>
            alert('data gagal dihapus')
            document.location.href = 'kelaspage.php?kelas=$kelasID'
            </script>";
}

?>