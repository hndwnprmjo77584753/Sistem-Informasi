<?php
$host = "localhost";
$user = "root";
$pwd = "";
$db = "db_input";
$conn = @mysql_connect($host,$user,$pwd) or die("Koneksi gagal : " . mysql_error());
mysql_select_db($db);
?>