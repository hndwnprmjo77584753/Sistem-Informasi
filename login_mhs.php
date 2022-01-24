<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SISTEM INFORMASI NILAI AKADEMIK</title>
  <style type="text/css">
    section{
	width: 1200px;
	margin: 50px auto 0px auto;
    }
    .log-in{
	width: 220px;
	height: 300px;
	padding: 10px;
	position: absolute;
	background-color: #FFFFFF;
	z-index: 100;
	list-style: none;
	-webkit-box-shadow: 0 0 5px #4f4f4f;
	-moz-box-shadow: 0 0 5px #4f4f4f;
	box-shadow: 0 0 5px #4f4f4f;
	left: 520px;
	top: 158px;
}
	
    form { margin:0; padding:0; }
    input, select {
	  display:inline-block;
	  vertical-align:middle;
	  width:200px;
	  margin:4px 2px;
	  padding:8px;
	  font: bold 16px 'Maiandra GD',Arial,Sans-Serif;
	  color:#666;
	  line-height:normal;
	  background-color:white;
	  border:1px solid #ccc;
	  border-top-color:#999;
	  -webkit-box-sizing:border-box;
	  -moz-box-sizing:border-box;
	  box-sizing:border-box;
	  outline:none;
	  outline-offset:-2px;
	  -webkit-border-radius:3px;
	  -moz-border-radius:3px;
	  border-radius:3px;
	  -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.1);
	  -moz-box-shadow:inset 0 1px 1px rgba(0,0,0,.1);
	  box-shadow:inset 0 1px 1px rgba(0,0,0,.1);
	  -webkit-transition:all .26s ease-out;
	  -moz-transition:all .26s ease-out;
	  -ms-transition:all .26s ease-out;
	  -o-transition:all .26s ease-out;
	  transition:all .26s ease-out;
	}
    input[type="submit"] {
	  width:auto;
	  background-color:#4f4f4f;
	  background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#4f4f4f),color-stop(100%,#4f4f4f));
	  background-image:-webkit-linear-gradient(top,#4f4f4f 0%,#4f4f4f 100%);
	  background-image:-moz-linear-gradient(top,#4f4f4f 0%,#4f4f4f 100%);
	  background-image:-ms-linear-gradient(top,#4f4f4f 0%,#4f4f4f 100%);
	  background-image:-o-linear-gradient(top,#4f4f4f 0%,#4f4f4f 100%);
	  background-image:linear-gradient(to bottom,#4f4f4f 0%,#4f4f4f 100%);
	  color:#fff;
	  font-weight:bold;
	  text-shadow:0 -1px 0 rgba(0,0,0,.3);
	  padding-right:16px;
	  padding-left:16px;
	  cursor:pointer;
	  border-color:#4f4f4f #4f4f4f #4f4f4f;
	  -webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.1),0 1px 1px rgba(0,0,0,.4);
	  -moz-box-shadow:inset 0 1px 0 rgba(255,255,255,.1),0 1px 1px rgba(0,0,0,.4);
	  box-shadow:inset 0 1px 0 rgba(255,255,255,.1),0 1px 1px rgba(0,0,0,.4);
	  -webkit-transition-duration:0s;
	  -moz-transition-duration:0s;
	  -ms-transition-duration:0s;
	  -o-transition-duration:0s;
	  transition-duration:0s;
	}
    input::-moz-focus-inner, select {
	  margin:0;
	  padding:0;
	  border:none;
	  outline:none;
	}
    input:focus,
    select:focus {
	  border-color:#69676b;
	  -webkit-box-shadow:0 0 1px #69676b,0 0 3px #69676b,0 0 6px #69676b;
	  -moz-box-shadow:0 0 1px #69676b,0 0 3px #69676b,0 0 6px #69676b;
	  box-shadow:0 0 1px #69676b,0 0 3px #69676b,0 0 6px #69676b;
	}
    input[type="submit"]:focus,
    input[type="submit"]:hover {
	  background-color:#69676b;
	  background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#69676b),color-stop(100%,#69676b));
	  background-image:-webkit-linear-gradient(top,#69676b 0%,#69676b 100%);
	  background-image:-moz-linear-gradient(top,#69676b 0%,#69676b 100%);
	  background-image:-ms-linear-gradient(top,#69676b 0%,#69676b 100%);
	  background-image:-o-linear-gradient(top,#69676b 0%,#69676b 100%);
	  background-image:linear-gradient(to bottom,#69676b 0%,#69676b 100%);
	  border-color:#69676b #69676b #69676b;
	  -webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.1),0 1px 1px rgba(0,0,0,.4);
	  -moz-box-shadow:inset 0 1px 0 rgba(255,255,255,.1),0 1px 1px rgba(0,0,0,.4);
	  box-shadow:inset 0 1px 0 rgba(255,255,255,.1),0 1px 1px rgba(0,0,0,.4);
	}
    input[type="submit"]:active {
	  background-image:none;
	  background-color:#4f4f4f;
	  border-color:transparent;
	  -webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,.4);
	  -moz-box-shadow:inset 0 1px 2px rgba(0,0,0,.4);
	  box-shadow:inset 0 1px 2px rgba(0,0,0,.4);
	}
	::-webkit-input-placeholder {color:#888}
	:-ms-input-placeholder {color:#888}
	::-moz-placeholder {color:#888}
	:-moz-placeholder {color:#888}
	:placeholder {color:#888}
	
	:focus::-webkit-input-placeholder {color:#ccc}
	:focus:-ms-input-placeholder {color:#ccc}
	:focus::-moz-placeholder {color:#ccc}
	:focus:-moz-placeholder {color:#ccc}
	:focus:placeholder {color:#ccc}
        
    a:link{ color: #4f4f4f }
    a:hover{ color: #f531de }
    a:visited{ color: #000 } 
  </style>
</head>
<center>
<body style="margin-top: 80px; background: #FFFFFF; font:bold 16px 'Maiandra GD',Arial,Sans-Serif;">
<!-- awal header -->
<?php include("library/koneksi.php"); ?>
<div class="container">
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();

$conn = new mysqli("localhost", "root", "", "db_input");
if ($conn->connect_errno) {
    echo die("Failed to connect to MySQL: " . $conn->connect_error);
}
?>

 <div class="log-in">
        <img src="images/siasat.gif" height=100px width=230px>
        <form method="post" action="prosesloginMhs.php">
            <input name="username" type="text" maxlength="20"  placeholder="Username"/><br/>
            <input name="password" type="password" maxlength="20" placeholder="Password" /><br/>
			<div class="actions">
		    <button type="submit" name="login" value="Login">Login!</button>
	</div>
	    
	</form>
        <hr style="border: 3px solid #4f4f4f">
          
      </div>
      
</body>
<center>
</html>

