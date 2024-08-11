<?php
session_start();
ob_start();
$_SESSION['name'] = $_POST['username'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login in</title>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>
<?php
require_once('conn.php');

if(isset($_POST['submit'])){
	$username= $_POST['username'];
	$password= $_POST['password'];

$query = mysqli_query($con, "SELECT * FROM user WHERE admission = '$username' AND surname = '$password'");
$num = mysqli_num_rows($query);

//Login to start the exam. if user is not elgible go back to login page

if($num == 1){
$row = mysqli_fetch_array($query);
$_SESSION['USERNAME'] = $row['admission'];
header('Location:option.php');
	
}
else{
header('Location:index.php?register');

	}

}
	
?>


</body>
</html>
