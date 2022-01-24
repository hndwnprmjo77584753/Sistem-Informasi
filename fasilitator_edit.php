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
$arrLevel = array (
         0=>"Laki-laki",
         1=>"Perempuan",);

if($_GET) {
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['kode_Fasil'])=="") {
			$message[] = "Kode fasilitator tidak boleh kosong !";		
		}
		if (trim($_POST['Kode_k'])=="") {
			$message[] = "Kode kegiatan tidak boleh kosong !";		
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$message[] = "Level sistem belum dipilih !";		
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
		$kode_Fasil		= $_POST['kode_Fasil'];
		$kode_Fasil		= str_replace("'","&acute;",$kode_Fasil);
		$kode_FasilLm	= $_POST['kode_FasilLm'];
		
		$Kode_k  		= $_POST['Kode_k'];
		$Kode_k  		= str_replace("'","&acute;",$Kode_k);
		
		$cmbLevel 		= $_POST['cmbLevel'];
		
		$Alamat			= $_POST['Alamat'];
		$Alamat		  	= str_replace("'","&acute;",$Alamat);
		
		$Kontak  		= $_POST['Kontak'];
		$Kontak  		= str_replace("'","&acute;",$Kontak);
		
		$Pendidikan_Ter = $_POST['Pendidikan_Ter'];
		$Pendidikan_Ter = str_replace("'","&acute;",$Pendidikan_Ter);
		
		$Kode_lm  		= $_POST['Kode_lm'];
		$Kode_lm  		= str_replace("'","&acute;",$Kode_lm);
		
		# Validasi Nama Kategori, jika sudah ada akan ditolak
		$sqlCek="SELECT * FROM fasilitator WHERE kode_Fasil='$kode_Fasil'AND NOT(kode_Fasil='$kode_FasilLm')";
		$qryCek=mysql_query($sqlCek, $connection) or die ("Eror Query".mysql_error()); 
		if(mysql_num_rows($qryCek)>=1){
			$message[] = "Maaf, kode_Fasil <b> $kode_Fasil</b> sudah ada, ganti dengan yang lain";
		}
			
		# Jika jumlah error message tidak ada
		if(count($message)==0){
			$sqlSave="UPDATE fasilitator SET kode_Fasil='$kode_Fasil', kode_Keg='$Kode_k', JK='$cmbLevel', 
			alamat='$Alamat', kontak='$Kontak', pendT='$Pendidikan_Ter', kode_LM='$Kode_lm' WHERE IdC='".$_POST['txtKode']."'";
			$qrySave=mysql_query($sqlSave, $connection);
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
	
	# TAMPILKAN DATA LOGIN UNTUK DIEDIT
	$KodeEdit	= isset($_GET['Kode']) ?  $_GET['Kode'] : $_POST['txtKode']; 
	$sqlShow	= "SELECT * FROM fasilitator WHERE IdC='$KodeEdit'";
	$qryShow	= mysql_query($sqlShow, $connection)  or die ("Query ambil data user salah : ".mysql_error());
	$dataShow	= mysql_fetch_array($qryShow);
	
	# MASUKKAN DATA KE VARIABEL
	$dataKode			= $dataShow['IdC'];
	$datakode_Fasil		= isset($dataShow['kode_Fasil']) ?  $dataShow['kode_Fasil'] : $_POST['kode_Fasil'];
	$datakode_FasilLm	= $dataShow['kode_Fasil'];
	
	$dataKode_K  		= isset($dataShow['kode_Keg']) ?  $dataShow['kode_Keg'] :  $_POST['Kode_k'];
	
	$dataLevel			= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : '';
	$dataLevel  		= isset($dataShow['JK']) ?  $dataShow['JK'] : $_POST['cmbLevel'];
	
	$dataAlamat  		= isset($dataShow['alamat']) ?  $dataShow['alamat'] :  $_POST['Alamat'];
	$dataKontak  		= isset($dataShow['kontak']) ?  $dataShow['kontak'] :  $_POST['Kontak'];
	$dataPendidikan_Ter = isset($dataShow['pendT']) ?  $dataShow['pendT'] :  $_POST['Pendidikan_Ter'];
	$dataKodeLm  		= isset($dataShow['kode_LM']) ?  $dataShow['kode_LM'] :  $_POST['Kode_lm'];
	
} // Penutup GET
?>
 <form action="?page=Edit-Fasilitator&Act=Save" method="post" name="frmadd">
     <table class="table-common" width="100%" style="margin-top:0px;">
<tr>
	  <th colspan="3">UBAH DATA FASILITATOR </th>
	</tr>
    
	<tr>
      <td><strong>Kode Fasilitator : </strong></td>
	  <td><b>:</b></td>
	  <td><input name="kode_Fasil" value="<?php echo $datakode_Fasil; ?>"  size="60" maxlength="60"/>
          <input name="kode_FasilLm" type="hidden" value="<?php echo $datakode_FasilLm; ?>" /></td>
    </tr>
    
     <tr>
	  <td width="15%"><strong>Kode Kegiatan : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kode_k"  value="<?php echo $dataKode_K; ?>"  size="30" maxlength="30"/>
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
	  <td width="15%"><strong>Alamat : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><textarea rows="5" cols="72" name="Alamat"  value=""  size="30" maxlength="30"/><?php echo $dataAlamat; ?></textarea>
     </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>kontak : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kontak"  value="<?php echo $dataKontak; ?>"  size="30" maxlength="30"/>
      </td>
    </tr>
    
    <tr>
	  <td width="15%"><strong>Pendidikan Terakhir : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Pendidikan_Ter"  value="<?php echo $dataPendidikan_Ter; ?>"  size="30" maxlength="30"/>
      </td>
    </tr>
       
    <tr>
	  <td width="15%"><strong>Kode Lembaga Mitra : </strong></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="Kode_lm"  value="<?php echo $dataKodeLm; ?>"  size="30" maxlength="30"/>
       </td>
    </tr>
      
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSave" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>
