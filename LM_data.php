<?php
include_once "library/koneksi.php";
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
    <td colspan="2"><a href="?page=Add-LM" target="_self"><img src="images/add.png" height="25" border="0" /></a></td>
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
        <td width="50" align="center" bgcolor="#CCCCCC"><b>Edit</b></td>
        <td width="50" align="center" bgcolor="#CCCCCC"><b>Delete</b></td>
      </tr>
 <?php 
 # UNTUK PAGING (PEMBAGIAN HALAMAN)
  $halaman 	= 5;
  $page 	= isset($_GET["halaman"]) ? $_GET["halaman"] : 1;
  $mulai 	= ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result 	= mysql_query("SELECT * FROM lembaga_mitra");
  $total 	= mysql_num_rows($result);
  $pages 	= ceil($total/$halaman);            
  $query 	= mysql_query("SELECT * FROM lembaga_mitra LIMIT $mulai, $halaman")or die(mysql_error);
  $jml	 	= mysql_num_rows($query);
  $nomor 	= $mulai+1;
  $Kode 	= $userRow['idD'];
  while ($userRow = mysql_fetch_array($query)) {
    ?>
      <tr>
        <td align="center"><b><?php echo $nomor++; ?></b></td>
        <td><?php echo $userRow['kode_LM']; ?></td>
        <td><?php echo $userRow['Kode_Kegiatan']; ?></td>
        <td><?php echo $userRow['nama_LM']; ?></td>
        <td><?php echo $userRow['Alamat']; ?></td>
        <td><?php echo $userRow['Email']; ?></td>
        <td><?php echo $userRow['Kontak']; ?></td>
        <td align="center"><a href="?page=Edit-LM&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"><img src="images/edit.png" width="20" height="20" border="0" /></a></td>
        <td align="center"><a href="?page=Delete-LM&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA PENTING INI ... ?')"><img src="images/delete.png" width="20" height="20"  border="0"  alt="Delete Data" /></a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
    <td align="right"><b>Halaman ke :</b>      
	<?php for ($i=1; $i<=$pages ; $i++){ ?>
  <a href="?page=Data-LM&halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
  <?php } ?>
	</td>
  </tr>
</table>


