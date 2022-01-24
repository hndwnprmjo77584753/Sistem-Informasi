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
		if (trim($_POST['kode_LM'])=="") {
			$message[] = "Kode lembaga mitra tidak boleh kosong !";		
		}
		if (trim($_POST['Kode_k'])=="") {
			$message[] = "Kode Kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['Nama_Lm'])=="") {
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
		$kode_LM		= $_POST['kode_LM'];
		$kode_LM		= str_replace("'","&acute;",$kode_LM);
		$kode_LM_L		= $_POST['kode_LM_L'];
		
		$Kode_k  		= $_POST['Kode_k'];
		$Kode_k  		= str_replace("'","&acute;",$Kode_k);
		
		$Nama_Lm 		= $_POST['Nama_Lm'];
		$Nama_Lm  		= str_replace("'","&acute;",$Nama_Lm);
		
		$Alamat 		= $_POST['Alamat'];
		$Alamat  		= str_replace("'","&acute;",$Alamat);
		
		$email  		= $_POST['email'];
		$email  		= str_replace("'","&acute;",$email);
		
		$Kontak  		= $_POST['Kontak'];
		$Kontak  		= str_replace("'","&acute;",$Kontak);
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM lembaga_mitra WHERE kode_LM='$kode_LM' AND NOT(kode_LM='$kode_LM_L')";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, kode <b> $kode_LM</b> sudah ada, ganti dengan yang lain";
		}
			
		# Jika jumlah error message tidak ada
		if(count($message)==0){
			$sqlSave="UPDATE lembaga_mitra SET kode_LM='$kode_LM', Kode_Kegiatan='$Kode_k', nama_LM='$Nama_Lm', 
			Alamat='$Alamat', Email='$email', Kontak='$Kontak' WHERE idD='".$_POST['txtKode']."'";
			$qrySave=mysql_query($sqlSave, $connection);
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
	
	# TAMPILKAN DATA LOGIN UNTUK DIEDIT
	$KodeEdit= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
	$sqlShow = "SELECT * FROM lembaga_mitra WHERE idD='$KodeEdit'";
	$qryShow = mysql_query($sqlShow, $connection)  or die ("Query ambil data user salah : ".mysql_error());
	$dataShow = mysql_fetch_array($qryShow);
	
	# MASUKKAN DATA KE VARIABEL
	$dataKode			= $dataShow['idD'];
	$datakode_LM		= isset($dataShow['kode_LM']) ?  $dataShow['kode_LM'] : $_POST['kode_LM'];
	$datakode_LM_L		= $dataShow['kode_LM'];
	
	$dataKode_K  		= isset($dataShow['Kode_Kegiatan']) ?  $dataShow['Kode_Kegiatan'] :  $_POST['Kode_k'];
	$dataNama_Lm	  	= isset($dataShow['nama_LM']) ?  $dataShow['nama_LM'] :  $_POST['Nama_Lm'];
	$dataAlamat  		= isset($dataShow['Alamat']) ?  $dataShow['Alamat'] :  $_POST['Alamat'];
	$dataEmail			= isset($dataShow['Email']) ?  $dataShow['Email'] :  $_POST['email'];
	$dataKontak  		= isset($dataShow['Kontak']) ?  $dataShow['Kontak'] :  $_POST['Kontak'];
	
} // Penutup GET
?>
 <form action="?page=Edit-LM&Act=Save" method="post" name="frmadd">
     <table class="table-common" width="100%" style="margin-top:0px;">
<tr>
	  <th colspan="3">UBAH DATA LEMBAGA MITRA</th>
	</tr>
    
	<tr>
      <td><strong>Kode Lembaga Mitra : </strong></td>
	  <td><b>:</b></td>
	  <td><input name="kode_LM" value="<?php echo $datakode_LM; ?>"  size="60" maxlength="60"/>
          <input name="kode_LM_L" type="hidden" value="<?php echo $datakode_LM_L; ?>" /></td>
    </tr>
    
     <tr>
	  <td width="15%"><strong>Kode Kegiatan : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kode_k"  value="<?php echo $dataKode_K; ?>"  size="30" maxlength="30"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    
    
    <tr>
	  <td width="15%"><strong>Nama Lembaga Mitra : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Nama_Lm"  value="<?php echo $dataNama_Lm; ?>"  size="30" maxlength="30"/>
     </td>
    </tr>
    
	<tr>
	  <td width="15%"><strong>Alamat : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><textarea rows="5" cols="72" input name="Alamat"  value=""  size="30" maxlength="30"/><?php echo $dataAlamat; ?></textarea>
      </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>Email : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="email"  value="<?php echo $dataEmail; ?>"  size="30" maxlength="30"/>
     </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>kontak : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kontak"  value="<?php echo $dataKontak; ?>"  size="30" maxlength="30"/>
      </td>
    </tr>
     
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>
