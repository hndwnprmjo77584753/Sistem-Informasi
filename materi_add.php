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
		if (trim($_POST['Kode_Fasil'])=="") {
			$message[] = "Kode Fasil tidak boleh kosong !";		
		}
		if (trim($_POST['materi'])=="") {
			$message[] = "Materi tidak boleh kosong !";		
		}
		if (trim($_POST['waktu'])=="") {
			$message[] = "Waktu tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$Kode_K  		= $_POST['Kode_K'];
		$Kode_K  		= str_replace("'","&acute;",$Kode_K);
		$Kode_Fasil		= $_POST['Kode_Fasil'];
		$Kode_Fasil		= str_replace("'","&acute;",$Kode_Fasil);
		$materi			= $_POST['materi'];
		$materi			= str_replace("'","&acute;",$materi);
		$waktu			= $_POST['waktu'];
		$waktu		  	= str_replace("'","&acute;",$waktu);
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM materi WHERE kode_K='$Kode_K'";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, kode_K <b> $Kode_K </b> sudah ada, ganti dengan yang lain";
		}
		
		# Jika jumlah error message tidak ada
		if(count($message)==0){			
		$sqlSave="INSERT INTO materi SET kode_K='$Kode_K', Kode_F='$Kode_Fasil', Materi='$materi', Waktu='$waktu'";
			$qrySave=mysql_query($sqlSave, $connection) or die ("Gagal query".mysql_error());
			if($qrySave){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-Materi&Act=Sucsses'>";
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
	$dataKode_Fasil  	= isset($_POST['Kode_Fasil']) ? $_POST['Kode_Fasil'] : '';
	$datamateri		  	= isset($_POST['materi']) ? $_POST['materi'] : '';
	$datawaktu			= isset($_POST['waktu']) ? $_POST['waktu'] : '';
	
} // Penutup GET
?>
<form action="?page=Add-Materi&Act=Save" method="post" name="frmadd">
	<table class="table-common" width="100%" style="margin-top:0px;">
	    <tr>
		<th colspan="3">TAMBAH DATA MATERI</th>
	    </tr>
        <tr>
		<td width="15%"><strong>Kode Kegiatan:</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kode_K" value="<?php echo $dataKode_K; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
	    <tr>
		<td width="15%"><strong>Kode Fasilitator :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kode_Fasil"  value="<?php echo $dataKode_Fasil; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Materi :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="materi"  value="<?php echo $datamateri; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Waktu :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input type="time" name="waktu" value="<?php echo $datawaktu; ?>" size="70" maxlength="65"/> - <input type="time" name="waktu" value="<?php echo $datawaktu; ?>" size="70" maxlength="65"/></td>
	    </tr>
             
	    <tr><td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
	    </tr>
	</table>
</form>
   
