<?php
$conn = mysqli_connect('localhost', 'root', '', 'uas_web');

// Periksa koneksi
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
