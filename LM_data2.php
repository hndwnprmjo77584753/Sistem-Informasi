<?php
include_once "library/koneksi.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM lembaga_mitra";
$pageQry = mysql_query($pageSql, $connection) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_kp");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>

<table width="1000" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><h4><b>DATA LEMBAGA MITRA</b></h4></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="1" cellspacing="1" cellpadding="2">
      <tr>
        <th width="27" align="center"><b>No</b></th>
        <th width="229"><b>Kode Lembaga Mitra</b></th>
	    <th width="145"><b>Kode Kegiatan</b></th>
        <th width="145"><b>Nama Lembaga Mitra</b></th>
        <th width="145"><b>Alamat</b></th>
        <th width="145"><b>Email</b></th>
        <th width="145"><b>Kontak</b></th>
        
      </tr>
      <?php
	$userSql = "SELECT * FROM lembaga_mitra ORDER BY idD ASC LIMIT $hal, $row";
	$userQry = mysql_query($userSql, $connection)  or die ("Query user salah : ".mysql_error());
	$nomor  = 0; 
	while ($userRow = mysql_fetch_array($userQry)) {
	$nomor++;
	$Kode = $userRow['idD'];
	?>
      <tr>
        <td align="center"><b><?php echo $nomor; ?></b></td>
        <td><?php echo $userRow['kode_LM']; ?></td>
        <td><?php echo $userRow['Kode_Kegiatan']; ?></td>
        <td><?php echo $userRow['nama_LM']; ?></td>
        <td><?php echo $userRow['Alamat']; ?></td>
        <td><?php echo $userRow['Email']; ?></td>
        <td><?php echo $userRow['Kontak']; ?></td>
        
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
    <td align="right"><b>Halaman ke :</b>      
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Data-LM2&hal=$list[$h]'>$h</a> ";
	}
	?>
	</td>
  </tr>
</table>


