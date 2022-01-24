<?php include("library/koneksi.php"); ?>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_input");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>
<?php
$arrLevel	= array(123,127,222);

if($_GET) {
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['NIM'])=="") {
			$message[] = "Nim lengkap boleh kosong !";		
		}
		if (trim($_POST['txtNama'])=="") {
			$message[] = "User tidak boleh kosong !";		
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$message[] = "Level sistem belum dipilih !";		
		}
		if (trim($_POST['tgs'])=="") {
			$message[] = "Nilai Tugas tidak boleh kosong !";		
		}
		if (trim($_POST['TTS'])=="") {
			$message[] = "Nilai TTS tidak boleh kosong !";		
		}
		if (trim($_POST['TAS'])=="") {
			$message[] = "Nilai Tas tidak boleh kosong !";		
		}
		
		# Baca Variabel Form
		$NIM	  = $_POST['NIM'];
		$NIM 	  = str_replace("'","&acute;",$NIM);
		$txtNama  = $_POST['txtNama'];
		$txtNama  = str_replace("'","&acute;",$txtNama);
		$cmbLevel = $_POST['cmbLevel'];
		$tgs	  = $_POST['tgs'];
		$tgs 	  = str_replace("'","&acute;",$tgs);
		$TTS     = $_POST['TTS'];
		$TTS     = str_replace("'","&acute;",$TTS);
		$TAS     = $_POST['TAS'];
		$TAS     = str_replace("'","&acute;",$TAS);
		

		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM tb_nilai_mhs WHERE NIM='$NIM'";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, User <b> $user </b> sudah ada, ganti dengan yang lain";
		}
		
		# Jika jumlah error message tidak ada
		if(count($message)==0){			
			$sqlSave="INSERT INTO tb_nilai_mhs SET NIM='$NIM', NAMA='$txtNama', KODE_MATKUL='$cmbLevel', NILAI_TUGAS='$tgs', 
			NILAI_TTS ='$TTS', NILAI_TAS ='$TAS'";
			$qrySave=mysql_query($sqlSave, $connection) or die ("Gagal query".mysql_error());
			if($qrySave){
				echo "<meta http-equiv='refresh' content='0; url=?page=Data-Berita&Act=Sucsses'>";
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
	$dataNIM	= isset($_POST['NIM']) ? $_POST['NIM'] : '';
	$dataNama   = isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
	$dataLevel	= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : '';
	$datatgs	= isset($_POST['tgs']) ? $_POST['tgs'] : '';
	$dataTTS	= isset($_POST['TTS']) ? $_POST['TTS'] : '';
	$dataTAS	= isset($_POST['TAS']) ? $_POST['TAS'] : '';
} // Penutup GET
?>

<form action="" method="post" name="frmadd">
	<table class="table-common" width="100%" style="margin-top:0px;">
	   <tr>
		<th colspan="3">INPUT NILAI MAHASISWA</th>
	   </tr>
       
	   <tr>
		   <td><strong>NIM</strong></td>
		   <td><b>:</b></td>
		   <td><input name="NIM" value="<?php echo $dataNIM; ?>"  size="30" maxlength="45"/></td>
	  </tr>
       
	   <tr>
		   <td width="15%"><strong>NAMA</strong></td>
		   <td width="1%"><b>:</b></td>
		   <td width="84%"><input name="txtNama" value="<?php echo $dataNama; ?>"  size="30" maxlength="45"/></td>
	   </tr>
       
       <tr>
		   <td><strong>KODE MATKUL</strong></td>
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
 </select>
     
	   <tr>
		   <td width="15%"><strong>NILAI TUGAS</strong></td>
		   <td width="1%"><b>:</b></td>
		   <td width="84%"><input name="tgs" value="<?php echo $datatgs; ?>" size="30" maxlength="45"/></td>
	   </tr>
       
       <tr>
		   <td width="15%"><strong>NILAI TTS</strong></td>
		   <td width="1%"><b>:</b></td>
		   <td width="84%"><input name="TTS"  value="<?php echo $dataTTS; ?>"  size="30" maxlength="45"/></td>
	  </tr>
      
      <tr>
		<td width="15%"><strong>NILAI TAS</strong></td>
		<td width="1%"><b>:</b></td>
		<td width="84%"><input name="TAS"  value="<?php echo $dataTAS; ?>"  size="30" maxlength="45"/></td>
	  </tr>
	    
	    <tr><td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
	    </tr>
	</table>
</form>
   
