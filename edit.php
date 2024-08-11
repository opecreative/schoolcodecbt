<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
textarea{min-height:60px; max-height:60px; min-width:300px; max-width:300px;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editing</title>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>
<div id="change_q" align="center">Carefully Modify the Question</div>
<?php
require_once('conn.php');
$q_id = $_GET['id'];
$fetch_question = mysqli_query($con, "SELECT * FROM question_bank WHERE id = '$q_id'");
while($row = mysqli_fetch_array($fetch_question)){
	
	echo"
<table border='0' align='center'>
	<form action='' method='get'>
	
	<tr>
		<th>Question $q_id. </td><td><textarea name='question'>$row[question]</textarea></td></tr>
	
	<tr>
		<th>A. </th><td><textarea name='opt1'>$row[opt1]</textarea></td><td><input type='radio'         name ='answer' value='opt1'></td></tr>
	<tr>
		<th>B. </th><td><textarea name='opt2'>$row[opt2]</textarea></td><td><input type='radio'         name ='answer' value='opt2'></td></tr>
	<tr>
		<th>C. </th><td><textarea name='opt3'>$row[opt3]</textarea></td><td><input type='radio'         name ='answer' value='opt3'></td></tr>
	<tr>
		<th>D. </th><td><textarea name='opt4'>$row[opt4]</textarea></td><td><input type='radio' 				        name ='answer' value='opt4'></td></tr>
	<tr>
		<th></th><td><input type='submit' name='submit' value='Set Question'</td></tr>
	
	</form>	
</table>
	";
	
	}
?>
</body>
</html>