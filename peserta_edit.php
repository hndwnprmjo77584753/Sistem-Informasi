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
$arrLevel = array(
			0=>"Laki-laki",
         	1=>"Perempuan",);

if($_GET) {
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['Kode_Peserta'])=="") {
			$message[] = "Kode Peserta tidak boleh kosong !";		
		}
		if (trim($_POST['Nama_P'])=="") {
			$message[] = "Nama peserta tidak boleh kosong !";		
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$message[] = "Jenis kelamin belum diupdate !";		
		}
		if (trim($_POST['Pendidikan_Ter'])=="") {
			$message[] = "Pendidikan terakhir tidak boleh kosong !";		
		}
		if (trim($_POST['Kontak'])=="") {
			$message[] = "kontak tidak boleh kosong !";		
		}
		if (trim($_POST['Kode_lm'])=="") {
			$message[] = "kode lembaga mitra tidak boleh kosong !";		
		}
		if (trim($_POST['Kode_K'])=="") {
			$message[] = "Kode kegiatan tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$Kode_Peserta	= $_POST['Kode_Peserta'];
		$Kode_Peserta	= str_replace("'","&acute;",$Kode_Peserta);
		$Kode_PesertaLm	= $_POST['Kode_PesertaLm'];
		
		$Nama_P  		= $_POST['Nama_P'];
		$Nama_P  		= str_replace("'","&acute;",$Nama_P);
		
		$cmbLevel 		= $_POST['cmbLevel'];
		
		$Pendidikan_Ter = $_POST['Pendidikan_Ter'];
		$Pendidikan_Ter = str_replace("'","&acute;",$Pendidikan_Ter);
		
		$Kontak  		= $_POST['Kontak'];
		$Kontak  		= str_replace("'","&acute;",$Kontak);
		
		$Kode_lm  		= $_POST['Kode_lm'];
		$Kode_lm  		= str_replace("'","&acute;",$Kode_lm);
		
		$Kode_K  		= $_POST['Kode_K'];
		$Kode_K  		= str_replace("'","&acute;",$Kode_K);
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM peserta_kegiatan WHERE Kode_Peserta='$Kode_Peserta'AND NOT(Kode_Peserta='$Kode_PesertaLm')";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, Kode_Peserta <b> $Kode_Peserta</b> sudah ada, ganti dengan yang lain";
		}
			
		# Jika jumlah error message tidak ada
		if(count($message)==0){
			$sqlSave="UPDATE peserta_kegiatan SET Kode_Peserta='$Kode_Peserta', Nama_Peserta='$Nama_P', Jenis_Kelamin='$cmbLevel', 			Pendidikan_Terakhir='$Pendidikan_Ter', Kontak='$Kontak', Kode_LM='$Kode_lm', Kode_Kegiatan='$Kode_K' WHERE IdB='".			
			$_POST['txtKode']."'";
			$qrySave=mysql_query($sqlSave, $connection);
			if($qrySave){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-Peserta&Act=Sucsses'>";
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
	$sqlShow = "SELECT * FROM peserta_kegiatan WHERE IdB='$KodeEdit'";
	$qryShow = mysql_query($sqlShow, $connection)  or die ("Query ambil data user salah : ".mysql_error());
	$dataShow = mysql_fetch_array($qryShow);
	
	# MASUKKAN DATA KE VARIABEL
	$dataKode			= $dataShow['IdB'];
	$dataKode_Peserta	= isset($dataShow['Kode_Peserta']) ?  $dataShow['Kode_Peserta'] : $_POST['Kode_Peserta'];
	$dataKode_PesertaLm	= $dataShow['Kode_Peserta'];
	
	$dataNama  			= isset($dataShow['Nama_Peserta']) ?  $dataShow['Nama_Peserta'] :  $_POST['Nama_P'];
	
	$dataLevel			= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : '';
	$dataLevel  		= isset($dataShow['Jenis_Kelamin']) ?  $dataShow['Jenis_Kelamin'] : $_POST['cmbLevel'];
	
	$dataPendidikan_Ter = isset($dataShow['Pendidikan_Terakhir']) ?  $dataShow['Pendidikan_Terakhir'] :  $_POST['Pendidikan_Ter'];
	$dataKontak  		= isset($dataShow['Kontak']) ?  $dataShow['Kontak'] :  $_POST['Kontak'];
	$dataKodeLm  		= isset($dataShow['Kode_LM']) ?  $dataShow['Kode_LM'] :  $_POST['Kode_lm'];
	$dataKode_K  		= isset($dataShow['Kode_Kegiatan']) ?  $dataShow['Kode_Kegiatan'] :  $_POST['Kode_K'];
} // Penutup GET
?>
 <form action="?page=Edit-Peserta&Act=Save" method="post" name="frmadd">
     <table class="table-common" width="100%" style="margin-top:0px;">
<tr>
	  <th colspan="3">UBAH DATA PESERTA </th>
	</tr>
    
	<tr>
      <td><strong>Kode Peserta : </strong></td>
	  <td><b>:</b></td>
	  <td><input name="Kode_Peserta" value="<?php echo $dataKode_Peserta; ?>"  size="60" maxlength="60"/>
          <input name="Kode_PesertaLm" type="hidden" value="<?php echo $dataKode_PesertaLm; ?>" /></td>
    </tr>
    
	<tr>
	  <td width="15%"><strong>Nama Peserta : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Nama_P"  value="<?php echo $dataNama; ?>"  size="30" maxlength="30"/>
      <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
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
	  <td width="15%"><strong>Pendidikan Terakhir : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Pendidikan_Ter"  value="<?php echo $dataPendidikan_Ter; ?>"  size="30" maxlength="30"/>
      </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>kontak : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kontak"  value="<?php echo $dataKontak; ?>"  size="30" maxlength="30"/>
      </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>Kode Lembaga Mitra : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kode_lm"  value="<?php echo $dataKodeLm; ?>"  size="30" maxlength="30"/>
     </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>Kode Kegiatan : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kode_K"  value="<?php echo $dataKode_K; ?>"  size="30" maxlength="30"/>
     </td>
    </tr>
    
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>
