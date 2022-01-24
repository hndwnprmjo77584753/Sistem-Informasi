<?php include("library/koneksi.php"); ?>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_kp");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: ". $conn->connect_error);
}
?>
<?php
$arrLevel	= array(3,6,7);

if($_GET) {
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['Kode_K'])=="") {
			$message[] = "Kode kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['Kode_f'])=="") {
			$message[] = "Kode fasilitator tidak boleh kosong !";		
		}
		if (trim($_POST['hasil_evaluasi'])=="") {
			$message[] = "Hasil evaluasi tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$Kode_K			= $_POST['Kode_K'];
		$Kode_K			= str_replace("'","&acute;",$Kode_K);
		$Kode_f  		= $_POST['Kode_f'];
		$Kode_f  		= str_replace("'","&acute;",$Kode_f);
		$hasil_evaluasi = $_POST['hasil_evaluasi'];
		$hasil_evaluasi = str_replace("'","&acute;",$hasil_evaluasi);
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM evaluasi WHERE kode_K='$Kode_K'";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, kode_K <b> $Kode_K </b> sudah ada, ganti dengan yang lain";
		}
		
		# Jika jumlah error message tidak ada
		if(count($message)==0){			
			$sqlSave="INSERT INTO evaluasi SET kode_K='$Kode_K', Kode_F='$Kode_f', Hasil_Evaluasi='$hasil_evaluasi'";
			$qrySave=mysql_query($sqlSave, $connection) or die ("Gagal query".mysql_error());
			if($qrySave){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-Evaluasi&Act=Sucsses'>";
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
	$dataKode_K  		= isset($_POST['Kode_K']) ? $_POST['Kode_K'] : '';
	$dataKode_f			= isset($_POST['Kode_f']) ? $_POST['Kode_f'] : '';
	$datahasil_evaluasi = isset($_POST['hasil_evaluasi']) ? $_POST['hasil_evaluasi'] : '';
	
} // Penutup GET
?>
<form action="?page=Add-Evaluasi&Act=Save" method="post" name="frmadd">
	<table class="table-common" width="100%" style="margin-top:0px;">
	    <tr>
		<th colspan="3">TAMBAH DATA EVALUASI</th>
	    </tr>
        
         <tr>
		<td width="15%"><strong>Kode Kegiatan :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kode_K"  value="<?php echo $dataKode_K; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
	    <tr>
		<td><strong>Kode Fasilitator :</strong></td>
		<td><b>:</b></td>
		<td><input name="Kode_f"  value="<?php echo $dataKode_f; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Hasil Evaluasi :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="hasil_evaluasi"  value="<?php echo $datahasil_evaluasi; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
	    <tr><td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
	    </tr>
	</table>
</form>
   
