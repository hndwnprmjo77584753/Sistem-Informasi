<?php include("library/koneksi.php"); ?>

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_kp");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SISTEM INPUT NILAI</title>
<link href="css/styleadmin.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script></head>
<div id="wrap">
<body>
<table width="100%" class="table-main">

  <tr>
    <td bgcolor="#CCCCCC"><a href="main_admin.php?page"><div id="header"> <img src="images/siasat.gif" height=100px width=280px></div></a></td>  <td height="103" colspan="2" bgcolor="#AFAFFE"><h2>SISTEM INPUT NILAI AKADEMIK</h2>
    </td>  
   
  </tr>
  <tr valign="top">
    <td width="15%"  style="border-right:5px solid #DDDDDD; background-color:#CCC"><div style="margin:5px; padding:10px; font-size:0px;"><?php include "menu.php"; ?></div></td>
    <td width="1000" height="550"><div style="margin:5px; padding:5px;"><?php include "load_file.php";?></div></td>
  </tr>
</table>
</body>
</div>
</html>
