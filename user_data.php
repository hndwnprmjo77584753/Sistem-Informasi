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
    <td colspan="2" align="right"><h4><b>DATA USER ACCOUNT </b></h4></td>
  </tr>
  <tr>
    <td colspan="2"><a href="?page=Add-User" target="_self"><img src="images/add.png" height="25" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="1" cellspacing="1" cellpadding="2">
      <tr>
        <th width="27" align="center"><b>No</b></th>
        <th width="229"><b>Nama Lengkap</b></th>
        <th width="162"><b>User ID </b></th>
        <th width="145"><b>Level</b></th>
        <td width="50" align="center" bgcolor="#CCCCCC"><b>Edit</b></td>
        <td width="50" align="center" bgcolor="#CCCCCC"><b>Delete</b></td>
      </tr>
<?php 
 # UNTUK PAGING (PEMBAGIAN HALAMAN)
  $halaman 	= 5;
  $page 	= isset($_GET["halaman"]) ? $_GET["halaman"] : 1;
  $mulai 	= ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result 	= mysql_query("SELECT * FROM login_user");
  $total 	= mysql_num_rows($result);
  $pages 	= ceil($total/$halaman);            
  $query 	= mysql_query("SELECT * FROM login_user LIMIT $mulai, $halaman")or die(mysql_error);
  $jml	 	= mysql_num_rows($query);
  $nomor 	= $mulai+1;
  $Kode = $userRow['IdF'];
 
  while ($userRow = mysql_fetch_array($query)) {
    ?>
      <tr>
        <td align="center"><b><?php echo $nomor++; ?></b></td>
        <td><?php echo $userRow['nama']; ?></td>
        <td><?php echo $userRow['username']; ?></td>
        <td><?php echo $userRow['level']; ?></td>
        <td align="center"><a href="?page=Edit-User&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"><img src="images/edit.png" width="20" height="20" border="0" /></a></td>
        <td align="center"><a href="?page=Delete-User&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA PENTING INI ... ?')"><img src="images/delete.png" width="20" height="20"  border="0"  alt="Delete Data" /></a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
    <td align="right"><b>Halaman ke :</b>      
	<?php for ($i=1; $i<=$pages ; $i++){ ?>
  <a href="?page=Data-User&halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
  <?php } ?>
	</td>
  </tr>
</table>


