<?php
session_start();
ob_start();
if(!isset($_SESSION['USERNAME'])){
	header('Location:index.php?login');
	}
 $user = $_SESSION['USERNAME'];
 $sub_id = $_SESSION['SUB_ID'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Finished Successfully</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="font-awesome-4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />


<body>
<?php
include'admin/conn.php';
$select_user = mysqli_query($con, "SELECT * FROM user WHERE admission = '$user'");
$fetch_user = mysqli_fetch_array($select_user);
$surname = $fetch_user['surname'];
$othername = explode(" ",$fetch_user['othername']);
//$admission = $fetch_user['admission'];
//$class = $fetch_user['class'];
$middlename = $othername[0];
$update = mysqli_query($con, "UPDATE user SET done = 'yes', current_exam = '', time_left = 0 WHERE admission = '$user'");
// insert into done table
$update_done_table = mysqli_query($con, "INSERT INTO done_table SET username = '$user', subject_id = '$sub_id'");
//Get exam type from subject
$exam = mysqli_query($con, "SELECT exam_type FROM subject WHERE sub_id='$sub_id'");
$type = mysqli_fetch_array($exam);
$exam_type = $type['exam_type'];

               ////////Get the total score of student exam and save in result////////
			   
$select_answer = mysqli_query($con, "SELECT SUM(score) AS total_score FROM answer WHERE username='$user' AND subject_id='$sub_id' AND exam_type='$exam_type'");
$total = mysqli_fetch_array($select_answer);
$total_score = ($total['total_score']/2);

//Update Result based on the subject done and total score
$sql = "SELECT * FROM result WHERE admission='$user' AND subject_id='$sub_id'";
$query = mysqli_query($con, $sql);

//First CA
if(mysqli_num_rows($query)==0)
	{
		// Second CA
		if($exam_type == "FIRST CA")
		{
		$insert = mysqli_query($con, "INSERT INTO result(admission, subject_id, ca1) VALUES('$user', '$sub_id', '$total_score')");
		}
		elseif($exam_type == "SECOND CA")
		{
		$insert = mysqli_query($con, "INSERT INTO result(admission, subject_id, ca2) VALUES('$user', '$sub_id', '$total_score')");
		}
		elseif($exam_type == "EXAM")
		{
		$insert = mysqli_query($con, "INSERT INTO result(admission, subject_id, exam) VALUES('$user', '$sub_id', '$total_score')");
		}
}

	
//Exam
if(mysqli_num_rows($query)==1)
	if($exam_type == "FIRST CA")
	{
	$update = mysqli_query($con, "UPDATE result SET ca1='$total_score' WHERE admission='$user' AND subject_id='$sub_id'");
	}
	elseif($exam_type == "SECOND CA")
	{
	$update = mysqli_query($con, "UPDATE result SET ca2='$total_score' WHERE admission='$user' AND subject_id='$sub_id'");
	}
	if($exam_type == "EXAM")
	{
	$update = mysqli_query($con, "UPDATE result SET exam='$total_score' WHERE admission='$user' AND subject_id='$sub_id'");
	}


// number of questions answered by the user
$select_answered = mysqli_query($con, "SELECT * FROM answer WHERE username='$user' AND subject_id='$sub_id' AND exam_type='$exam_type'");
$total_anwered = mysqli_num_rows($select_answered);

$select_total_question = mysqli_query($con, "SELECT * FROM displayed_q WHERE sub_id='$sub_id' AND admission = '$user'");
$total_question = mysqli_num_rows($select_total_question);
?>

<div class="container">
<div class="col-md-12">
    <div style="margin-top:200px;">
    <h3 align="center"><div class="alert alert-info"><i class="fa fa-clock-o"></i> TimeUP! Your exam has been submitted.</div></h3>
    <div class="alert alert-success" align="center"><b><?php echo $surname.' '.$middlename; ?>, you attempted <?php echo $total_anwered." of ".$total_question;?> questions</b></div>
	<div class="alert alert-success" align="center"><h2><b>You Scored <?php echo $total_score." out of ".$total_question;?> questions</b></h2></div>
	<div align="center"><a href="index.php" class="btn btn-primary">LogOut</a></div>
    </div>
</div>
</div>
</body>
</html>
<?php
$clearDisplayed_Q = mysqli_query($con, "DELETE FROM displayed_q WHERE admission = '$user' ");

unset($_SESSION['USERNAME']);
unset($_SESSION['SUB_ID']);

?>