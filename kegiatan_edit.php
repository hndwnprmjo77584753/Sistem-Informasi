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
		if (trim($_POST['Kode_Kegiatan'])=="") {
			$message[] = "Kode kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['Nama_Keg'])=="") {
			$message[] = "Nama kegiatan tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$Kode_Kegiatan		= $_POST['Kode_Kegiatan'];
		$Kode_Kegiatan		= str_replace("'","&acute;",$Kode_Kegiatan);
		$Kode_KegiatanLm	= $_POST['Kode_KegiatanLm'];
		
		$Nama_Keg  			= $_POST['Nama_Keg'];
		$Nama_Keg  			= str_replace("'","&acute;",$Nama_Keg);
		
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM kegiatan WHERE Kode_Kegiatan='$Kode_Kegiatan'AND NOT(Kode_Kegiatan='$Kode_KegiatanLm')";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, Kode_Kegiatan <b> $Kode_Kegiatan</b> sudah ada, ganti dengan yang lain";
		}
			
		# Jika jumlah error message tidak ada
		if(count($message)==0){
			$sqlSave="UPDATE kegiatan SET Kode_Kegiatan='$Kode_Kegiatan', Nama_Kegiatan='$Nama_Keg' 
			WHERE IdA='".$_POST['txtKode']."'";
			$qrySave=mysql_query($sqlSave, $connection);
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
	
	# TAMPILKAN DATA LOGIN UNTUK DIEDIT
	$KodeEdit= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
	$sqlShow = "SELECT * FROM kegiatan WHERE IdA='$KodeEdit'";
	$qryShow = mysql_query($sqlShow, $connection)  or die ("Query ambil data user salah : ".mysql_error());
	$dataShow = mysql_fetch_array($qryShow);
	
	# MASUKKAN DATA KE VARIABEL
	$dataKode				= $dataShow['IdA'];
	$dataKode_Kegiatan		= isset($dataShow['Kode_Kegiatan']) ?  $dataShow['Kode_Kegiatan'] : $_POST['Kode_Kegiatan'];
	$dataKode_KegiatanLm	= $dataShow['Kode_Kegiatan'];
	
	$dataNama_Keg	= isset($dataShow['Nama_Kegiatan']) ?  $dataShow['Nama_Kegiatan'] : $_POST['Nama_Keg'];
	
} // End if($_GET) {
?>	
 <form action="?page=Edit-Kegiatan&Act=Save" method="post" name="frmadd">
     <table class="table-common" width="100%" style="margin-top:0px;">
<tr>
	  <th colspan="3">UBAH DATA KEGIATAN </th>
	</tr>
    
	<tr>
      <td><strong>Kode Kegiatan : </strong></td>
	  <td><b>:</b></td>
	  <td><input name="Kode_Kegiatan" value="<?php echo $dataKode_Kegiatan; ?>"  size="60" maxlength="60"/>
          <input name="Kode_KegiatanLm" type="hidden" value="<?php echo $dataKode_KegiatanLm; ?>" /></td>
    </tr>
    
	<tr>
	  <td width="15%"><strong>Nama Kegiatan : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Nama_Keg"  value="<?php echo $dataNama_Keg; ?>"  size="30" maxlength="30"/>
     <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /> </td>
    </tr>
    
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>
