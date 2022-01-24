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
$arrLevel	= array(3,6,7);

if($_GET) {
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['Kode_Keg'])=="") {
			$message[] = "Kode kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['Nama_Keg'])=="") {
			$message[] = "Nama kegiatan tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$Kode_Keg	= $_POST['Kode_Keg'];
		$Kode_Keg	= str_replace("'","&acute;",$Kode_Keg);
		$Nama_Keg  	= $_POST['Nama_Keg'];
		$Nama_Keg  	= str_replace("'","&acute;",$Nama_Keg);
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM kegiatan WHERE Kode_Kegiatan='$Kode_Keg'";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, User <b> $user </b> sudah ada, ganti dengan yang lain";
		}
		
		# Jika jumlah error message tidak ada
		if(count($message)==0){			
			$sqlSave="INSERT INTO kegiatan SET Kode_Kegiatan='$Kode_Keg', Nama_Kegiatan='$Nama_Keg'";
			$qrySave=mysql_query($sqlSave, $connection) or die ("Gagal query".mysql_error());
			if($qrySave){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-Kegiatan&Act=Sucsses'>";
			}
		}	
		
		# JIKA ADA PESAN ERROR DARI VALIDASI
		// (Form Kosong, atau Duplikat ada), Ditampilkan lewat kode ini
		if (! count($message)==0 ){
		    echo "<div class='mssgBox'>";
			echo "<img src='images/attention.png' class='imgBox'> <hr>";
				$Num=0;
				foreach ($message as $indeks=>$pesan_tampil) { 
				$Num++;
					echo "&nbsp;&nbsp;$Num. $pesan_tampil<br>";	
				} 
			echo "</div> <br>"; 
		}
	} // Penutup POST
	
	# MASUKKAN DATA KE VARIABEL
	$dataKode	= isset($_POST['Kode_Keg']) ? $_POST['Kode_Keg'] : '';
	$dataNama   = isset($_POST['Nama_Keg']) ? $_POST['Nama_Keg'] : '';
} // Penutup GET
?>
<form action="?page=Add-Kegiatan&Act=Save" method="post" name="frmadd">
	<table class="table-common" width="100%" style="margin-top:0px;">
	    <tr>
		<th colspan="3">TAMBAH DATA KEGIATAN</th>
	    </tr>
	    <tr>
		<td><strong>Kode Kegiatan :</strong></td>
		<td><b>:</b></td>
		<td><input name="Kode_Keg" value="<?php echo $dataKode; ?>"  size="70" maxlength="65"/></td>
	    </tr>
	    <tr>
		<td width="15%"><strong>Nama Kegiatan :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Nama_Keg"  value="<?php echo $dataNama; ?>"  size="70" maxlength="65"/></td>
	    </tr>
	
	    <tr><td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
	    </tr>
	</table>
</form>
   
