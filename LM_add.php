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
			$message[] = "Kode Kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['nama_Lm'])=="") {
			$message[] = "Nama lembaga mitra tidak boleh kosong !";		
		}
		if (trim($_POST['Alamat'])=="") {
			$message[] = "Alamat tidak boleh kosong !";		
		}
		if (trim($_POST['email'])=="") {
			$message[] = "email tidak boleh kosong !";		
		}
		if (trim($_POST['Kontak'])=="") {
			$message[] = "kontak tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$Kode_lm		= $_POST['Kode_lm'];
		$Kode_lm		= str_replace("'","&acute;",$Kode_lm);
		$Kode_k  		= $_POST['Kode_k'];
		$Kode_k  		= str_replace("'","&acute;",$Kode_k);
		$nama_Lm 		= $_POST['nama_Lm'];
		$nama_Lm  		= str_replace("'","&acute;",$nama_Lm);
		$Alamat 		= $_POST['Alamat'];
		$Alamat  		= str_replace("'","&acute;",$Alamat);
		$email  		= $_POST['email'];
		$email  		= str_replace("'","&acute;",$email);
		$Kontak  		= $_POST['Kontak'];
		$Kontak  		= str_replace("'","&acute;",$Kontak);
		
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM lembaga_mitra WHERE kode_LM='$Kode_lm'";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, kode_LM<b> $Kode_lm </b> sudah ada, ganti dengan yang lain";
		}
		
		# Jika jumlah error message tidak ada
		if(count($message)==0){			
			$sqlSave="INSERT INTO lembaga_mitra SET kode_LM='$Kode_lm', Kode_Kegiatan='$Kode_k', nama_LM='$nama_Lm', 
			Alamat='$Alamat', Email='$email', Kontak='$Kontak'";
			$qrySave=mysql_query($sqlSave, $connection) or die ("Gagal query".mysql_error());
			if($qrySave){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-LM&Act=Sucsses'>";
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
	$dataNama_Lm  		= isset($_POST['nama_Lm']) ? $_POST['nama_Lm'] : '';
	$dataAlamat  		= isset($_POST['Alamat']) ? $_POST['Alamat'] : '';
	$dataEmail	 		= isset($_POST['email']) ? $_POST['email'] : '';
	$dataKontak  		= isset($_POST['Kontak']) ? $_POST['Kontak'] : '';
	
	
} // Penutup GET
?>
<form action="?page=Add-LM&Act=Save" method="post" name="frmadd">
	<table class="table-common" width="100%" style="margin-top:0px;">
	    <tr>
		<th colspan="3">TAMBAH DATA LEMBAGA MITRA</th>
	    </tr>
	    <tr>
		<td><strong>Kode Lembaga Mitra :</strong></td>
		<td><b>:</b></td>
		<td><input name="Kode_lm"  value="<?php echo $dataKodelm; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
	    <tr>
		<td width="15%"><strong>Kode Kegiatan :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kode_k"  value="<?php echo $dataKode_K; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Nama Lembaga Mitra :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="nama_Lm"  value="<?php echo $dataNama_Lm; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
        
        <tr>
		<td width="15%"><strong>Alamat :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><textarea rows="5" cols="72" input name="Alamat" value="<?php echo $dataAlamat; ?>"   size="70" maxlength="65"/></textarea></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Email :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="email" value="<?php echo $dataEmail; ?>"  size="70" maxlength="65"/></td>
	    </tr>
           
        <tr>
		<td width="15%"><strong>Kontak :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kontak" value="<?php echo $dataKontak; ?>"  size="70" maxlength="65"/></td>
	    </tr>
          
	    <tr><td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
	    </tr>
	</table>
</form>
   
