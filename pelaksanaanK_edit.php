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
		$kode_LM  		= $_POST['kode_LM'];
		$kode_LM 		= str_replace("'","&acute;",$kode_LM);
		$kode_LM_L  	= $_POST['kode_LM_L'];
		
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
		$sqlCek="SELECT * FROM pelaksana_kegiatan WHERE kode_LM='$kode_LM' AND NOT(kode_LM='$kode_LM_L')";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, kode_LM <b> $kode_LM</b> sudah ada, ganti dengan yang lain";
		}
			
		# Jika jumlah error message tidak ada
		if(count($message)==0){
			$sqlSave="UPDATE pelaksana_kegiatan SET kode_LM='$kode_LM', kode_K='$Kode_k', tanggal_mulai='$Tanggal_Mulai', 
			tanggal_selesai='$Tanggal_Selesai', penyelenggara='$Penyelenggara', Sasaran='$sasaran',Tempat_Kegiatan='$Tempat_Keg' 
			WHERE idE='".$_POST['txtKode']."'";
			$qrySave=mysql_query($sqlSave, $connection);
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
	
	# TAMPILKAN DATA LOGIN UNTUK DIEDIT
	$KodeEdit= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
	$sqlShow = "SELECT * FROM pelaksana_kegiatan WHERE idE='$KodeEdit'";
	$qryShow = mysql_query($sqlShow, $connection)  or die ("Query ambil data user salah : ".mysql_error());
	$dataShow = mysql_fetch_array($qryShow);
	
	# MASUKKAN DATA KE VARIABEL
	$dataKode			= $dataShow['idE'];
	$datakode_LM  		= isset($dataShow['kode_LM']) ?  $dataShow['kode_LM'] :  $_POST['kode_LM'];
	$datakode_LM_L		= $dataShow['kode_LM'];
	
	$dataKode_k			= isset($dataShow['kode_K']) ?  $dataShow['kode_K'] : $_POST['Kode_k'];
	$dataTanggal_Mulai  = isset($dataShow['tanggal_mulai']) ?  $dataShow['tanggal_mulai'] :  $_POST['Tanggal_Mulai'];
	$dataTanggal_Selesai= isset($dataShow['tanggal_selesai']) ?  $dataShow['tanggal_selesai'] :  $_POST['Tanggal_Selesai'];
	$dataPenyelenggara  = isset($dataShow['penyelenggara']) ?  $dataShow['penyelenggara'] :  $_POST['Penyelenggara'];
	$datasasaran  		= isset($dataShow['Sasaran']) ?  $dataShow['Sasaran'] :  $_POST['sasaran'];
	$dataTempat_Keg		= isset($dataShow['Tempat_Kegiatan']) ?  $dataShow['Tempat_Kegiatan'] :  $_POST['Tempat_Keg'];
	
	
} // Penutup GET
?>
 <form action="?page=Edit-Pelaksana&Act=Save" method="post" name="frmadd">
     <table class="table-common" width="100%" style="margin-top:0px;">
<tr>
	  <th colspan="3">UBAH DATA PELAKSANAAN KEGIATAN </th>
	</tr>
    
    <tr>
	  <td width="15%"><strong>Kode Lembaga Mitra : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="kode_LM"  value="<?php echo $datakode_LM; ?>"  size="30" maxlength="30"/>
      <input name="kode_LM_L" type="hidden" value="<?php echo $datakode_LM_L; ?>" /></td>
    </tr>
    
     <tr>
	  <td width="15%"><strong>Kode Kegiatan : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kode_k"  value="<?php echo $dataKode_k; ?>"  size="30" maxlength="30"/>
       <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td>
    </tr>
    
    <tr>
      <td><strong>Tanggal Mulai : </strong></td>
	  <td><b>:</b></td>
	  <td><input type="date" name="Tanggal_Mulai" value="<?php echo $dataTanggal_Mulai; ?>"  size="60" maxlength="60"/>
         </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>Tanggal Selesai : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input type="date" name="Tanggal_Selesai"  value="<?php echo $dataTanggal_Selesai; ?>"  size="30" maxlength="30"/>
      </td>
    </tr>
    
	<tr>
	  <td width="15%"><strong>Penyelenggara : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Penyelenggara"  value="<?php echo $dataPenyelenggara; ?>"  size="30" maxlength="30"/>
     </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>Sasaran : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="sasaran"  value="<?php echo $datasasaran; ?>"  size="30" maxlength="30"/>
     </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>Tempat Kegiatan : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Tempat_Keg"  value="<?php echo $dataTempat_Keg; ?>"  size="30" maxlength="30"/>
      </td>
    </tr>
       
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>
