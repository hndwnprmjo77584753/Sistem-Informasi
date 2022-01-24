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
		if (trim($_POST['Kode_lm'])=="") {
			$message[] = "Kode lembaga mitra tidak boleh kosong !";		
		}
		if (trim($_POST['Kode_k'])=="") {
			$message[] = "Kode kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['Tanggal_Mulai'])=="") {
			$message[] = "tanggal mulai kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['Tanggal_Selesai'])=="") {
			$message[] = "tanggal selesai tidak boleh kosong !";		
		}
		if (trim($_POST['Penyelenggara'])=="") {
			$message[] = "Penyelenggara tidak boleh kosong !";		
		}
		if (trim($_POST['sasaran'])=="") {
			$message[] = "Sasaran tidak boleh kosong !";		
		}
		if (trim($_POST['Tempat_Keg'])=="") {
			$message[] = "Tempat Kegiatan tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$Kode_lm  		= $_POST['Kode_lm'];
		$Kode_lm  		= str_replace("'","&acute;",$Kode_lm);
		$Kode_k  		= $_POST['Kode_k'];
		$Kode_k  		= str_replace("'","&acute;",$Kode_k);
		$Tanggal_Mulai  = $_POST['Tanggal_Mulai'];
		$Tanggal_Mulai	= str_replace("'","&acute;",$Tanggal_Mulai);
		$Tanggal_Selesai= $_POST['Tanggal_Selesai'];
		$Tanggal_Selesai= str_replace("'","&acute;",$Tanggal_Selesai);
		$Penyelenggara  = $_POST['Penyelenggara'];
		$Penyelenggara  = str_replace("'","&acute;",$Penyelenggara);
		$sasaran 		= $_POST['sasaran'];
		$sasaran 		= str_replace("'","&acute;",$sasaran);
		$Tempat_Keg 	= $_POST['Tempat_Keg'];
		$Tempat_Keg 	= str_replace("'","&acute;",$Tempat_Keg);
		
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM pelaksana_kegiatan WHERE kode_LM='$Kode_lm'";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, kode_LM <b> $Kode_lm </b> sudah ada, ganti dengan yang lain";
		}
		
		# Jika jumlah error message tidak ada
		if(count($message)==0){			
		$sqlSave="INSERT INTO pelaksana_kegiatan SET kode_LM='$Kode_lm', kode_K='$Kode_k', tanggal_mulai='$Tanggal_Mulai', 
		tanggal_selesai='$Tanggal_Selesai', penyelenggara='$Penyelenggara', Sasaran='$sasaran', Tempat_Kegiatan='$Tempat_Keg'";
			$qrySave=mysql_query($sqlSave, $connection) or die ("Gagal query".mysql_error());
			if($qrySave){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-Pelaksana&Act=Sucsses'>";
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
	$dataKodelm  		= isset($_POST['Kode_lm']) ? $_POST['Kode_lm'] : '';
	$dataKode_K  		= isset($_POST['Kode_k']) ? $_POST['Kode_k'] : '';
	$dataTanggal_Mulai  = isset($_POST['Tanggal_Mulai']) ? $_POST['Tanggal_Mulai'] : '';
	$dataTanggal_Selesai= isset($_POST['Tanggal_Selesai']) ? $_POST['Tanggal_Selesai'] : '';
	$dataPenyelenggara  = isset($_POST['Penyelenggara']) ? $_POST['Penyelenggara'] : '';
	$datasasaran	 	= isset($_POST['sasaran']) ? $_POST['sasaran'] : '';
	$dataTempat_Keg  	= isset($_POST['Tempat_Keg']) ? $_POST['Tempat_Keg'] : '';
	
} // Penutup GET
?>
<form action="?page=Add-Pelaksana&Act=Save" method="post" name="frmadd">
	<table class="table-common" width="100%" style="margin-top:0px;">
	    <tr>
		<th colspan="3">TAMBAH DATA PELAKSANAAN KEGIATAN</th>
	    </tr>
        <tr>
		<td width="15%"><strong>Kode Lembaga Mitra :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kode_lm" value="<?php echo $dataKodelm; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
	    <tr>
		<td width="15%"><strong>Kode Kegiatan :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kode_k"  value="<?php echo $dataKode_K; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Tanggal Mulai :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input type="date" name="Tanggal_Mulai"  value="<?php echo $dataTanggal_Mulai; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Tanggal Selesai :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input type="date" name="Tanggal_Selesai" value="<?php echo $dataTanggal_Selesai; ?>" size="70" maxlength="65"/></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Penyelenggara :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Penyelenggara" value="<?php echo $dataPenyelenggara ; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
         <tr>
		<td width="15%"><strong>Sasaran :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="sasaran" value="<?php echo $datasasaran; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Tempat Kegiatan :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Tempat_Keg" value="<?php echo $dataTempat_Keg; ?>"  size="70" maxlength="65"/></td>
	    </tr>
             
	    <tr><td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
	    </tr>
	</table>
</form>
   
