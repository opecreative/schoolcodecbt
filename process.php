<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing Login</title>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>
<?php
require_once('conn.php');

$name = $_POST['fname'];
$password = $_POST['password'];

$query=mysqli_query($con, "SELECT username password FROM user WHERE username ='$name' AND password = '$password'");

$num_row = mysqli_num_rows($query);

if($num_row ==1){
 header('Location:set.php');
	}
else {
	echo "Sorry! You are not eligible for this test. Please Try again";
	}
exit;
?>
</body>
</html>