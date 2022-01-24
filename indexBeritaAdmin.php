<?php
include_once "library/koneksi.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 20;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM tb_nilai_mhs";
$pageQry = mysql_query($pageSql, $connection) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_input");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>

<table width="1000" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><h4><b>DATA NILAI PENGUJIAN SISTEM </b></h4></td>
  </tr>
  <tr>
    <td colspan="2"><a href="?page=Add-Berita" target="_self"><img src="images/add.png" height="25" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="1" cellspacing="1" cellpadding="2">
      <tr>
        <th width="27" align="center"><b>No</b></th>
        <th width="90"><b>NIM</b></th>
        <th width="120"><b>NAMA</b></th>
        <th width="90"><b>KODE MATKUL</b></th>
        <th width="80"><b>NILAI TUGAS</b></th>
        <th width="80"><b>NILAI TTS</b></th>
        <th width="80"><b>NILAI TAS</b></th>
        <td width="50" align="center" bgcolor="#CCCCCC"><b>Edit</b></td>
        <td width="50" align="center" bgcolor="#CCCCCC"><b>Delete</b></td>
      </tr>
      
<?php
	$userSql = "SELECT * FROM tb_nilai_mhs ORDER BY idK ASC LIMIT $hal, $row";
	$userQry = mysql_query($userSql, $connection)  or die ("Query user salah : ".mysql_error());
	$nomor  = 0; 
	while ($userRow = mysql_fetch_array($userQry)) {
	$nomor++;
	$Kode = $userRow['idK'];
?>
        <td align="center"><b><?php echo $nomor; ?></b></td>
        <td><?php echo $userRow['NIM']; ?></td>
        <td><?php echo $userRow['NAMA']; ?></td>
        <td><?php echo $userRow['KODE_MATKUL']; ?></td>
        <td><?php echo $userRow['NILAI_TUGAS']; ?></td>
        <td><?php echo $userRow['NILAI_TTS']; ?></td>
        <td><?php echo $userRow['NILAI_TAS']; ?></td>
        <td align="center"><a href="?page=Edit-Berita&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"><img src="images/edit.png" width="20" height="20" border="0" /></a></td>
        <td align="center"><a href="?page=Delete-Berita&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA PENTING INI ... ?')"><img src="images/delete.png" width="20" height="20"  border="0"  alt="Delete Data" /></a></td>
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
		echo " <a href='?page=Data-Berita&hal=$list[$h]'>$h</a> ";
	}
	?>
	</td>
  </tr>
</table>
