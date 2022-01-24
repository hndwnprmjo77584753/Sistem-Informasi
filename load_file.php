<?php
if($_GET) {
	switch ($_GET['page']){				
		case '' :				
			if(!file_exists ("main_admin.php")) die ("Empty Main Page!"); 
			include "main.php";						
		break;
		
		case 'Halaman-Utama' :				
			if(!file_exists ("main_admin.php")) die ("Sorry Empty Page!"); 
			include "main.php";						
		break;	
		
		case '' :				
			if(!file_exists ("main_mhs.php")) die ("Empty Main Page!"); 
			include "main_mhs.php";						
		break;	
			
		case 'Halaman-Utama' :				
			if(!file_exists ("main_mhs.php")) die ("Sorry Empty Page!"); 
			include "main_mhs.php";						
		break;	
		
		case 'Login-Validasi' :				
			if(!file_exists ("login_validasi.php")) die ("Sorry Empty Page!"); 
			include "login_validasi.php";						
		break;
		
		case 'login-validasi_mhs' :				
			if(!file_exists ("login_validasi_mhs.php")) die ("Sorry Empty Page!"); 
			include "login_validasi_mhs.php";						
		break;
		
		case 'Logout' :				
			if(!file_exists ("login.php")) die ("Sorry Empty Page!"); 
			include "login.php";						
		break;
		
		case 'Logout_mhs' :				
			if(!file_exists ("login_mhs.php")) die ("Sorry Empty Page!"); 
			include "login_mhs.php";						
		break;			

		# USER LOGIN
		case 'Data-User' :			
			if(!file_exists ("user_data.php")) die ("Sorry Empty Page!"); 
			include "user_data.php";	 break;		
		case 'Add-User' :				
			if(!file_exists ("user_add.php")) die ("Sorry Empty Page!"); 
			include "user_add.php";	 break;		
		case 'Delete-User' :				
			if(!file_exists ("user_delete.php")) die ("Sorry Empty Page!"); 
			include "user_delete.php"; break;		
		case 'Edit-User' :				
			if(!file_exists ("user_edit.php")) die ("Sorry Empty Page!"); 
			include "user_edit.php"; break;	

	# DATA KEGIATAN
		case 'Data-Kegiatan' :				
			if(!file_exists ("kegiatan_data.php")) die ("Sorry Empty Page!"); 
			include "kegiatan_data.php";	 break;
		case 'Data-Kegiatan2' :				
			if(!file_exists ("kegiatan_data2.php")) die ("Sorry Empty Page!"); 
			include "kegiatan_data2.php";	 break;				
		case 'Add-Kegiatan' :				
			if(!file_exists ("kegiatan_add.php")) die ("Sorry Empty Page!"); 
			include "kegiatan_add.php";	 break;		
		case 'Delete-Kegiatan' :				
			if(!file_exists ("kegiatan_delete.php")) die ("Sorry Empty Page!"); 
			include "kegiatan_delete.php"; break;		
		case 'Edit-Kegiatan' :				
			if(!file_exists ("kegiatan_edit.php")) die ("Sorry Empty Page!"); 
			include "kegiatan_edit.php"; break;

		# DATA PESERTA
		case 'Data-Peserta' :				
			if(!file_exists ("peserta_data.php")) die ("Sorry Empty Page!"); 
			include "peserta_data.php";	 break;
		case 'Data-Peserta2' :				
			if(!file_exists ("peserta_data2.php")) die ("Sorry Empty Page!"); 
			include "peserta_data2.php";	 break;
		case 'Add-Peserta' :				
			if(!file_exists ("peserta_add.php")) die ("Sorry Empty Page!"); 
			include "peserta_add.php";	 break;	
		case 'Edit-Peserta' :				
			if(!file_exists ("peserta_edit.php")) die ("Sorry Empty Page!"); 
			include "peserta_edit.php";	 break;	
		case 'Delete-Peserta' :				
			if(!file_exists ("peserta_delete.php")) die ("Sorry Empty Page!"); 
			include "peserta_delete.php";	 break;
		case 'Search-Peserta' :				
			if(!file_exists ("peserta_search.php")) die ("Sorry Empty Page!"); 
			include "peserta_search.php";	 break;					
				
			# DATA FASILITATOR
		case 'Data-Fasilitator' :
			if(!file_exists ("fasilitator_data.php")) die ("Sorry Empty Page!"); 
			include "fasilitator_data.php";	 break;
		case 'Data-Fasilitator2' :
			if(!file_exists ("fasilitator_data2.php")) die ("Sorry Empty Page!"); 
			include "fasilitator_data2.php";	 break;
		case 'Add-Fasilitator' :
			if(!file_exists ("fasilitator_add.php")) die ("Sorry Empty Page!"); 
			include "fasilitator_add.php";	 break;
		case 'Edit-Fasilitator' :				
			if(!file_exists ("fasilitator_edit.php")) die ("Sorry Empty Page!"); 
			include "fasilitator_edit.php";	 break;	
		case 'Delete-Fasilitator' :
			if(!file_exists ("fasilitator_delete.php")) die ("Sorry Empty Page!"); 
			include "fasilitator_delete.php";	 break;
			
	#DATA LEMBAGA MITRA
		case 'Data-LM' :				
			if(!file_exists ("LM_data.php")) die ("Sorry Empty Page!"); 
			include "LM_data.php"; break;
		
		case 'Data-LM2' :				
			if(!file_exists ("LM_data2.php")) die ("Sorry Empty Page!"); 
			include "LM_data2.php"; break;		
		
		case 'Add-LM' :				
			if(!file_exists ("LM_add.php")) die ("Sorry Empty Page!"); 
			include "LM_add.php"; break;
			
		case 'Delete-LM' :				
			if(!file_exists ("LM_delete.php")) die ("Sorry Empty Page!"); 
			include "LM_delete.php"; break;
			
		case 'Edit-LM' :				
			if(!file_exists ("LM_edit.php")) die ("Sorry Empty Page!"); 
			include "LM_edit.php";	 break;	
			
	#PELAKSANAAN KEGIATAN
		case 'Data-Pelaksana' :				
			if(!file_exists ("pelaksanaanK_data.php")) die ("Sorry Empty Page!"); 
			include "pelaksanaanK_data.php"; break;
			
		case 'Data-Pelaksana2' :				
			if(!file_exists ("pelaksanaanK_data2.php")) die ("Sorry Empty Page!"); 
			include "pelaksanaanK_data2.php"; break;		
		
		case 'Add-Pelaksana' :				
			if(!file_exists ("pelaksanaanK_add.php")) die ("Sorry Empty Page!"); 
			include "pelaksanaanK_add.php"; break;
			
		case 'Delete-Pelaksana' :				
			if(!file_exists ("pelaksanaanK_delete.php")) die ("Sorry Empty Page!"); 
			include "pelaksanaanK_delete.php"; break;
			
		case 'Edit-Pelaksana' :				
			if(!file_exists ("pelaksanaanK_edit.php")) die ("Sorry Empty Page!"); 
			include "pelaksanaanK_edit.php";	 break;	
			
	#MATERI
		case 'Data-Materi' :				
			if(!file_exists ("materi_data.php")) die ("Sorry Empty Page!"); 
			include "materi_data.php"; break;
			
		case 'Data-Materi2' :				
			if(!file_exists ("materi_data2.php")) die ("Sorry Empty Page!"); 
			include "materi_data2.php"; break;		
		
		case 'Add-Materi' :				
			if(!file_exists ("materi_add.php")) die ("Sorry Empty Page!"); 
			include "materi_add.php"; break;
			
		case 'Delete-Materi' :				
			if(!file_exists ("materi_delete.php")) die ("Sorry Empty Page!"); 
			include "materi_delete.php"; break;
			
		case 'Edit-Materi' :				
			if(!file_exists ("materi_edit.php")) die ("Sorry Empty Page!"); 
			include "materi_edit.php";	 break;	
		
		#EVALUASI
		case 'Data-Evaluasi' :				
			if(!file_exists ("evaluasi_data.php")) die ("Sorry Empty Page!"); 
			include "evaluasi_data.php"; break;
			
		case 'Data-Evaluasi2' :				
			if(!file_exists ("evaluasi_data2.php")) die ("Sorry Empty Page!"); 
			include "evaluasi_data2.php"; break;		
		
		case 'Add-Evaluasi' :				
			if(!file_exists ("evaluasi_add.php")) die ("Sorry Empty Page!"); 
			include "evaluasi_add.php"; break;
			
		case 'Delete-Evaluasi' :				
			if(!file_exists ("evaluasi_delete.php")) die ("Sorry Empty Page!"); 
			include "evaluasi_delete.php"; break;
			
		case 'Edit-Materi' :				
			if(!file_exists ("materi_edit.php")) die ("Sorry Empty Page!"); 
			include "materi_edit.php";	 break;	
		
		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";						
		break;
	}
}
?>