<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Start Exam</title>
<!-- styles -->
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="admin/admin/css/styles.css" rel="stylesheet">
<style type="text/css">
form{ 
width:450px; margin-left:auto; margin-right:auto;
border:2px solid #FFF;
padding:15px;
}
</style>
<script type="text/javascript" src="admin/admin/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="admin/admin/js/jquery.js"></script>

<!--Simple MOdal-->
<link href="css/simpleModal.css" type="text/css" rel="stylesheet" />
<link href="font-awesome-4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />

</head>
<body>
<div class="col-md-12">
<table class="table table-hover">
<?php
include"admin/conn.php";

$surname = $_POST['surname'];
$select = mysqli_query($con, "SELECT * FROM user WHERE surname LIKE '%$surname%'");
if($surname == "")
{
	echo "Searching...";
	}
 elseif(mysqli_num_rows($select) == 0)
 {
	 echo "Record not found.";
	 }
else{
while($ro = mysqli_fetch_array($select))
{
	$surname = $ro['surname'];
	$othername = $ro['othername'];
	$admission = $ro['admission'];
	$class = $ro['class_id'];
echo '<tr><td>'.$surname.' '.$othername.'</td><td>'.$admission.'</td><td>'.$class.'</td></tr>';	
	
	}
}
?>
</table>
</div>
</body>
</html>