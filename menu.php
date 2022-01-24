<?php include("library/koneksi.php"); ?>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_kp");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>
<?php
if(isset($_SESSION['superadmin'])){
	echo "<ul><li><a href='?page=Data-User' title='Data User'>User Account</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Kegiatan' title='Data Kegiatan'>Data Kegiatan</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Peserta' title='Data Peserta'>Data Peserta</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Fasilitator' title='Data Fasilitator'>Data Fasilitator</a></li></ul>";
	echo "<ul><li><a href='?page=Data-LM' title='Data Lembaga Mitra'>Data Lembaga Mitra</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Pelaksana' title='Data Pelaksana'>Pelaksanaan Kegiatan</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Materi' title='Data Materi'>Materi</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Evaluasi' title='Data Evaluasi'>Evaluasi</a></li></ul>";
	echo "<ul><li><a href='logout.php'>Logout</a></li></ul>";

}
else if(isset($_SESSION['admin'])){
	echo "<ul><li><a href='main_admin.php' title='Halaman Utama'>Home</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Kegiatan2' title='Data Kegiatan2'>Data Kegiatan</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Peserta2' title='Data Peserta2'>Data Peserta</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Fasilitator2' title='Data Fasilitator2'>Data Fasilitator</a></li></ul>";
	echo "<ul><li><a href='?page=Data-LM2' title='Data Lembaga Mitra2'>Data Lembaga Mitra</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Pelaksana2' title='Data Pelaksana2'>Pelaksanaan Kegiatan</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Materi2' title='Data Materi2'>Materi</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Evaluasi2' title='Data Evaluasi2'>Evaluasi</a></li></ul>";
	echo "<ul><li><a href='logout.php'>Logout</a></li></ul>";

}
else if(isset($_SESSION['admin2'])){
	echo "<ul><li><a href='main_admin.php' title='Halaman Utama'>Home</a></li></ul>";
	echo "<ul><li><a href='?page=Data-Berita2' title=' Berita'>Input Nilai</a></li></ul>";
	echo "<ul><li><a href='logout.php'>Logout</a></li></ul>";
}
?>
