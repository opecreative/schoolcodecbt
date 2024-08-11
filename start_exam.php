<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Startting Exam</title>
<style>
body{background:#CCCCCC;}
table, th, td{border-collapse:collapse; font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;}

#table th{background:#0099FF; color:#FFC;}
#table tr:nth-child(even){background:#FFF;}
input{width:300px; height:30px; border-radius:5px; border: 1px solid #F60; background:#FFFFFF;}
#submit{background:#09F; border:1px solid #F60; font-family:Verdana, Geneva, sans-serif; color:#fff; font-size:18px;}
#submit:hover{background:#0CF;}
a{text-decoration:none; color:#F30;}a:hover{color:#CC0000;}
</style>

</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>
<?php
$host = "localhost";
$dbuser = "root";
$pass = "";
$database ="edutech";

$con = mysqli_connect($host, $dbuser, '', 'edutech') or die ("Cannot conect to database:". mysql_error());

?>
<?php
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	
if($username!== "" || $password != "" ){
	$check = mysqli_query($con, "SELECT * FROM student WHERE matric = '$username'");
	
	$num_row = mysqli_num_rows($check);
	if($num_row == 1){
while($row=mysqli_fetch_array($check)){		
	$query = mysqli_query($con, "SELECT * FROM upload");
  $n = 0;
echo "<table border='1' align='center' cellpadding='5' id='table'";
echo "<tr><th>S/N</th><th>COURSE CODE</th><th>COURSE TITLE</th><th>DATE UPLOADED</th><th>DOWNLOAD</th></tr>";
while($row=mysqli_fetch_array($query)){
	$course= $row['course'];
	$title= $row['dsc'];
	$level= $row['level'];
	$date= $row['date'];
	$id=$row['path'];
      $n++;
	$i = $n;
	
echo "<tr><td>$i</td><td>$course</td><td>$title</td><td>$date</td><td><a href='down.php?id=$id'>$course</a></td></tr>";
}
}


	
	
	
	
	
	
		
		}
else{echo "Invalid Parameters";}
}}
?>



</body>
</html>