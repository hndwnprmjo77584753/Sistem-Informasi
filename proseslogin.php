<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_kp");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>
<?php
if(isset($_POST['login']))
{               
    $user   = $_POST['username'];
    $pass   = $_POST['password'];
                    
    $query = mysqli_query($conn, "SELECT * FROM login_user WHERE username='$user' AND password='$pass'");

    if(mysqli_num_rows($query) == 0)
    {
        echo '<script language="javascript">alert("Login Gagal!"); document.location="login.php";</script>';
    }
    else
    {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['username']=$row['username']; 
        $_SESSION['level'] = $row['level'];
        $_SESSION['nama'] = $row['nama'];
       
	if($row['level'] == 1)
        {
           $_SESSION['superadmin']=$user;
	        echo '<script language="javascript">alert("Anda berhasil Login Superadmin!"); document.location="main_admin.php";  </script>';
        }
		
        else if($row['level'] == 2)
        {
	    $_SESSION['admin']=$user;
	    echo '<script language="javascript">alert("Anda berhasil Login Admin!"); document.location="main_admin.php";
	</script>';
	    }
		
		
    }
}
?>	
	