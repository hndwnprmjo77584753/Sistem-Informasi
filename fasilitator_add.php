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
$arrLevel = array (
         0=>"Laki-laki",
         1=>"Perempuan",);

if($_GET) {
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['Kode_F'])=="") {
			$message[] = "Kode fasilitator tidak boleh kosong !";		
		}
		if (trim($_POST['Kode_k'])=="") {
			$message[] = "Kode kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$message[] = "Jenis Kelamin belum dipilih !";		
		}
		if (trim($_POST['Alamat'])=="") {
			$message[] = "Alamat tidak boleh kosong !";		
		}
		if (trim($_POST['Kontak'])=="") {
			$message[] = "kontak tidak boleh kosong !";		
		}
		if (trim($_POST['Pendidikan_Ter'])=="") {
			$message[] = "Pendidikan terakhir tidak boleh kosong !";		
		}
		if (trim($_POST['Kode_lm'])=="") {
			$message[] = "Kode lembaga mitra tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$Kode_F			= $_POST['Kode_F'];
		$Kode_F			= str_replace("'","&acute;",$Kode_F);
		$Kode_k  		= $_POST['Kode_k'];
		$Kode_k  		= str_replace("'","&acute;",$Kode_k);
		$cmbLevel 		= $_POST['cmbLevel'];
		$Alamat 		= $_POST['Alamat'];
		$Alamat  		= str_replace("'","&acute;",$Alamat);
		$Kontak  		= $_POST['Kontak'];
		$Kontak  		= str_replace("'","&acute;",$Kontak);
		$Pendidikan_Ter = $_POST['Pendidikan_Ter'];
		$Pendidikan_Ter = str_replace("'","&acute;",$Pendidikan_Ter);
		$Kode_lm  		= $_POST['Kode_lm'];
		$Kode_lm  		= str_replace("'","&acute;",$Kode_lm);
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM fasilitator WHERE kode_Fasil='$Kode_F'";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, kode_Fasil <b> $Kode_F </b> sudah ada, ganti dengan yang lain";
		}
		
		# Jika jumlah error message tidak ada
		if(count($message)==0){			
			$sqlSave="INSERT INTO fasilitator SET kode_Fasil='$Kode_F', kode_Keg='$Kode_k', JK='$cmbLevel', 
			alamat='$Alamat', kontak='$Kontak', pendT='$Pendidikan_Ter', kode_LM='$Kode_lm'";
			$qrySave=mysql_query($sqlSave, $connection) or die ("Gagal query".mysql_error());
			if($qrySave){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-Fasilitator&Act=Sucsses'>";
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
	$dataKode_F			= isset($_POST['Kode_F']) ? $_POST['Kode_F'] : '';
	$dataKode_K  		= isset($_POST['Kode_k']) ? $_POST['Kode_k'] : '';
	$dataLevel			= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : '';
	$dataAlamat  		= isset($_POST['Alamat']) ? $_POST['Alamat'] : '';
	$dataKontak  		= isset($_POST['Kontak']) ? $_POST['Kontak'] : '';
	$dataPendidikan_Ter = isset($_POST['Pendidikan_Ter']) ? $_POST['Pendidikan_Ter'] : '';
	$dataKodelm  		= isset($_POST['Kode_lm']) ? $_POST['Kode_lm'] : '';
	
} // Penutup GET
?>
<form action="?page=Add-Fasilitator&Act=Save" method="post" name="frmadd">
	<table class="table-common" width="100%" style="margin-top:0px;">
	    <tr>
		<th colspan="3">TAMBAH DATA FASILITATOR</th>
	    </tr>
	    <tr>
		<td><strong>Kode Fasilitator :</strong></td>
		<td><b>:</b></td>
		<td><input name="Kode_F"  value="<?php echo $dataKode_F; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
	    <tr>
		<td width="15%"><strong>Kode Kegiatan :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kode_k"  value="<?php echo $dataKode_K; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
      <tr>
	  <td><strong>Jenis Kelamin</strong></td>
	  <td><b>:</b></td>
	  <td><select name="cmbLevel">
        <option value="BLANK"> </option>
        <?php
          foreach ($arrLevel as $index => $value) {
            if ($value==$dataLevel) {
                $cek="selected";
            } else { $cek = ""; }
            echo "<option value='$value' $cek>$value</option>";
          }
          ?>
      </select></td>
    </tr>
        
        <tr>
		<td width="15%"><strong>Alamat :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><textarea rows="5" cols="72" input name="Alamat" value="<?php echo $dataAlamat; ?>"  size="70" maxlength="65"/></textarea></td>
	    </tr>
        
        <tr>
		<td width="15%"><strong>Kontak :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kontak" value="<?php echo $dataKontak; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
         <tr>
		<td width="15%"><strong>Pendidikan Terakhir :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Pendidikan_Ter" value="<?php echo $dataPendidikan_Ter; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
         
        <tr>
		<td width="15%"><strong>Kode Lembaga Mitra :</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="Kode_lm" value="<?php echo $dataKodeLm; ?>"  size="70" maxlength="65"/></td>
	    </tr>
        
	    <tr><td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
	    </tr>
	</table>
</form>
   
