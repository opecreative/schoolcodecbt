<?php session_start();
ob_start(); 
if(!isset($_SESSION['USERNAME'])){
	header('Location:index.php?auth=NO');
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//Ddiv XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Ddiv/xhtml1-transitional.ddiv">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Set Question</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="css/style.css" type="text/css" rel="stylesheet">
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<style>
</style>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">
<!--NicEdit-->
<script type="text/javascript" src="nicEdit/nicEdit.js"></script>
<script type="text/javascript">
	//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>


<div id="reg_table" >
<h1 align="center">Select your Exam</h1>
<?php
	
	include'conn.php';
	if(isset($_POST['sub_name'])){
	$sub_id = $_POST['sub_id'];
	$admission = $_SESSION['USERNAME'];
	$_SESSION['SUB_ID'] = $sub_id ;
 	//$select = mysqli_query($con, "SELECT * FROM question_bank WHERE sub_id = '$sub_id' ORDER BY RAND()");
	//$total_q = mysqli_num_rows($select);
	
	//if user is not eligible  for this test based on class  or level
	$select_user = mysqli_query($con, "SELECT class FROM user WHERE admission = '$admission'");
	$fetch_user = mysqli_fetch_array($select_user);
	$user_class = $fetch_user['class'];
	
	$select_sub = mysqli_query($con, "SELECT class FROM subject WHERE sub_id = '$sub_id'");
	$fetch_class = mysqli_fetch_array($select_sub);
	$sub_class = $fetch_class['class'];
	
	$select_done = mysqli_query($con, "SELECT done FROM user WHERE  admission = '$admission'");
	//$select_display_q2 = mysqli_query($con, "SELECT * FROM displayed_q WHERE admission = '$admission'");
	$user_done = mysqli_fetch_array($select_done);
	$done = $user_done['done'];

	//if user has not logged out of the current exam
	// $select_current_exam = mysqli_query($con, "SELECT active FROM user WHERE  admission = '$admission'");
	// $user_current_exam = mysqli_fetch_array($select_current_exam);
	// $date_in_db = $user_current_exam['active'];
	// $now = date("Y-m-d H:i:s");

	
	$select_current_exam = mysqli_query($con, "SELECT active FROM user WHERE  admission = '$admission'");
	$user_current_exam = mysqli_fetch_array($select_current_exam);
	$date_in_db = $user_current_exam['active'];
	
	$then = new DateTime($date_in_db);
	date_default_timezone_set("Africa/Lagos");
	$now = new DateTime();
	$diff = $now->diff($then);
	$min = $diff->format('%i');
	$sec = $diff->format('%s');

//date difference
	// $interval = date_diff($now, $date_in_db);

	if($sub_class != $user_class){header('location:option.php?w=YES');}
	 elseif($min < 1){header('location:option.php?double=YES');}
	elseif($done == "yes"){header('Location:index.php?done=YES');}
	else{
		//$q_num = 1;
	//while($sub = mysqli_fetch_array($select)){
		 //$id = $sub['id'];
		 //$q_number = $q_num++;
		 //$insert = mysqli_query($con, "INSERT INTO displayed_q (q_id, sub_id, admission, question_num) VALUES('$id', '$sub_id', '$admission', '$q_number')");
		 header('Location:question_to_display.php');	
 
	?>	
	<?php	
		//}
	}
}//end post subject name
?>
</div>
</body>
</html>