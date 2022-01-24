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
if($_GET) {
	if(empty($_GET['Kode'])){
		echo "<b>Data yang dicari tidak ada</b>";
	}
	else {
		$sqlCari = "SELECT * FROM peserta_kegiatan where Kode_Peserta like '%$cari%' or Nama_Peserta like '%$cari%' or 
		Jenis_Kelamin like '%$cari%' or Pendidikan_Terakhir like '%$cari%' or Kontak like '%$cari%' or Kode_LM like '%$cari%' 
		or Kode_Kegiatan like '%$cari%'";;
		$qryCari = mysql_query($sqlCari, $connection) or die ("Eror search data".mysql_error());
		if($qryCari){
			echo "<meta http-equiv='refresh' content='0; url=?page=Data-Peserta'>";
		}
	}
}
?>