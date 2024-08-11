<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>settin question</title>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>
<?php
require_once('conn.php');
?>

<?php
 $question = $_POST['question'];
 $option1 = $_POST['opt1'];
 $option2 = $_POST['opt2'];
 $option3 = $_POST['opt3'];
 $option4 = $_POST['opt4'];

 if($question == NULL || $option1 == NULL || $option2 == NULL || $option3 == NULL || $option4 == NULL){
	 
	 echo "All fields are required";
	exit;
	 }
	 
if(!isset($_POST['answer'])){
	
	echo "You have not chosen an answer";
	exit;
}
 
 
  $answer = $_POST['answer'];

?>

<?php

	
$sql = "INSERT INTO question_bank (question, opt1, opt2, opt3, opt4, answer) VALUES('$question', '$option1', '$option2', '$option3', '$option4', '$answer')";

if($query = mysqli_query($con, $sql)){
	echo "Question Set";
		
	}

else{
	echo "Question failed";
	}
?>
</body>
</html>