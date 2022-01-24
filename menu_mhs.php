<?php include("library/koneksi.php"); ?>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_input");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>
<?php

if(isset($_SESSION['Mhs'])){
	echo "<ul><li><a href='main_mhs.php' title='Halaman Utama'>Home</a></li></ul>";
	echo "<ul><li><a href='?page=Buku-Tamu' title='Hasil Studi'>Hasil Studi</a></li></ul>";
	echo "<ul><li><a href='logout_mhs.php'>Logout</a></li></ul>";
}

else if(isset($_SESSION['Mhs2'])){
	echo "<ul><li><a href='main_mhs.php' title='Halaman Utama'>Home</a></li></ul>";
	echo "<ul><li><a href='?page=Buku-Tamu2' title='Hasil Studi'>Hasil Studi</a></li></ul>";
	echo "<ul><li><a href='logout_mhs.php'>Logout</a></li></ul>";
}
?>
