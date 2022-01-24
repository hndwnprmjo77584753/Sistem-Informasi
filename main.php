
<?php
if(isset($_SESSION['SES_ADMIN'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b> Anda login sebagai Admin";
	exit;
}
else if(isset($_SESSION['SES_PKKRT'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b> Anda login sebagai Dosen";
	include "login_info.php";
	exit;
}
else if(isset($_SESSION['SES_Mhs'])) {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b> Anda login sebagai Mahasiswa";
	include "login_info.php";
	exit;
}


else {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b>Anda belum login, silahkan <a href='login.php' alt='Login'>login </a>untuk mengakses sitem ini ";	
}
?>