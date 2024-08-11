<?php
session_start();
ob_start();
if(!isset($_SESSION['USERNAME'])){
	header('Location:index.php?login');
	}
 $user = $_SESSION['USERNAME'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>

<?php
require_once('conn.php');
echo $time_left = $_POST['time_left'];
date_default_timezone_set("Africa/Lagos");
$now = date("Y-m-d H:i:s");
$update_time_left = mysqli_query($con, "UPDATE user SET time_left = '$time_left', active = '$now' WHERE admission = '$user'");
?>

</body>
</html>