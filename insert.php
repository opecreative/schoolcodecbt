<?php
session_start();
ob_start();
if(!isset($_SESSION['USERNAME'])){
	header('Location:index.php');
	
	}
 $_SESSION['USERNAME'];
	
?>
<?php

require_once('admin/conn.php');
 $opt = $_POST['option'];
 $user = $_POST['user'];
 $question = $_POST['quest'];
 $answer = $_POST['answer'];
 $q_id = $_POST['q_id'];
 $sub_id = $_SESSION['SUB_ID'];
 $class_id = $_POST['class_id'];
 $exam_type = $_POST['exam_type'];
 $select = mysqli_query($con, "SELECT username, q_id FROM answer WHERE username ='$user' AND q_id ='$q_id' AND subject_id ='$sub_id'");
 $num = mysqli_num_rows($select);
 if($num == 0){
 mysqli_query($con, "INSERT INTO answer (username, opt, question, score, q_id, subject_id, class_id, exam_type) VALUES('$user', '$opt', '$question', '$answer', '$q_id', '$sub_id', '$class_id', '$exam_type')");
	
 echo "";
 
 
 }
 
 else
 {
	$update=mysqli_query($con, "UPDATE answer 
		SET username ='$user', 
		 opt='$opt',
		 question='$question', 
		 score = '$answer', 
		 q_id = '$q_id',
		 class_id = '$class_id',
		 exam_type = '$exam_type'
		 
		WHERE username='$user' AND q_id = '$q_id'
		"); 
	 echo "";
 }
?>  