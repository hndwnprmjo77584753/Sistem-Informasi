<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_input");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>
<?php
if(isset($_POST['login']))
{               
    $user   = $_POST['username'];
    $pass   = $_POST['password'];
                    
    $query = mysqli_query($conn, "SELECT * FROM user_login_mhs WHERE username='$user' AND password='$pass'");
    if(mysqli_num_rows($query) == 0)
    {
        echo '<script language="javascript">alert("Login Gagal!"); document.location="login_mhs.php";</script>';
    }
    else
    {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['username']=$row['username']; 
        $_SESSION['level'] = $row['level'];
        $_SESSION['nama'] = $row['nama'];
       
	
		if($row['level'] == 3)
        {
	    $_SESSION['Mhs']=$user;
	    echo '<script language="javascript">alert("Anda berhasil Login Mahasiswa!"); document.location="main_mhs.php";
  </script>';
		}
		
		else if($row['level'] == 6)
        {
	    $_SESSION['Mhs2']=$user;
	    echo '<script language="javascript">alert("Anda berhasil Login Mahasiswa!"); document.location="main_mhs.php";
  </script>';
		}
    }
}           
?>
