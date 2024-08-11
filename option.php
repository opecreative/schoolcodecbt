<?php session_start();
ob_start(); 
if(!isset($_SESSION['USERNAME'])){
	header('Location:index.php?auth=NO');
	}
	$user = $_SESSION['USERNAME'];
?>
<!DOCTYPE html PUBLIC "-//W3C//Ddiv XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Ddiv/xhtml1-transitional.ddiv">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Set Question</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="css/style.css" type="text/css" rel="stylesheet">
<link href="css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<style>
.type1_error{color:red; font-size:13px; text-align:center;}
</style>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">
<!--NicEdit-->
<script type="text/javascript" src="nicEdit/nicEdit.js"></script>
<script type="text/javascript">
	//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<div id="banner" style="background-image:url(img/e-teating_banner.png); height:80px; background-repeat:no-repeat; background-position:center; background-size:cover;">
<img src="img/e-teating_banner.png" />
</div>

<div id="reg_table" >
<h1 align="center"><i class="fa fa-pencil"></i> Select your Exam</h1>
<div  class=" alert alert-info" align="center"><b><i class="fa fa-info-circle"></i> Note: Please click on your exam once and wait for the system to load.</b></div>
<?php
	
	include'conn.php';
 	$select = mysqli_query($con, "SELECT * FROM subject WHERE writing = 'yes' ORDER BY class_id ASC");
	$num_row = mysqli_num_rows($select);
	while($sub = mysqli_fetch_array($select)){
		$sub_name =  $sub['subject']." ".$sub['class'];
		$id = $sub['sub_id'];
		
		//if exam type is empty 
		$select2 = mysqli_query($con, "SELECT exam_type FROM subject WHERE sub_id = '$id'");
		$empty_exam_type = mysqli_fetch_array($select2);
		$exam_type = $empty_exam_type['exam_type'];

		$selectnum = mysqli_query($con, "SELECT * FROM question_number WHERE subid = '$id'");
		$fetch_q_num = mysqli_fetch_array($selectnum);
		$number_of_question = $fetch_q_num['q_num'];
		
		if($number_of_question == 0)
		{
			echo '<div align="center" class="comment">This link is disabled, please contact the administrator. Error: <b>ADMIN_CHECK_QNUMBER</b></div>';
			?>	
		<form action="" method="">
		<div class="form-group">
		<input type="hidden" value="<?php echo $id; ?>" class="form-control btn btn-primary" name="sub_id" /> 
		<input type="submit" class="form-control btn btn-primary" name="sub_name" value="<?php  echo $sub_name; ?>" disabled="disabled" />
		</div>
		</form>
		<?php	
			
			}

		elseif($exam_type == "")
		{
			echo '<div align="center" class="comment">This link is disabled, please contact the administrator. Error: <b>EXAM_TYPE_NOT_SET</b></div>';
			?>	
		<form action="" method="">
		<div class="form-group">
		<input type="hidden" value="<?php echo $id; ?>" class="form-control btn btn-primary" name="sub_id" /> 
		<input type="submit" class="form-control btn btn-primary" name="sub_name" value="<?php  echo $sub_name; ?>" disabled="disabled" />
		</div>
		</form>
		<?php	
			
			}
		else{
		?>	
		<form action="starting_exam.php" method="post">
		<div class="form-group">
		<input type="hidden" value="<?php echo $id; ?>" class="form-control btn btn-primary" name="sub_id" /> 
		<input type="submit" class="form-control btn btn-primary" name="sub_name" value="<?php  echo $sub_name; ?>" onclick="disable();" />
		</div>
		</form>
		<?php
		}
	}
		if(isset($_GET['w'])){echo '<span align="center" class="comment">You selected wrong exam! Please select exam that has your class name</span>';}
		elseif(isset($_GET['double'])){echo '<div align="center" class="alert alert-danger"><span class="comment">This user is already logged in on a different system. Please wait for 1 minute.</span></div>';}
?>
<?php
// $select_current_exam = mysqli_query($con, "SELECT active FROM user WHERE  admission = '$user'");
// $user_current_exam = mysqli_fetch_array($select_current_exam);
// $date_in_db = $user_current_exam['active'];
// $then = new DateTime($date_in_db);
// date_default_timezone_set("Africa/Lagos");
// $now = new DateTime();
// $diff = $now->diff($then);
//  $min = $diff->format('%i').'<br>';
//  $sec = $diff->format('%s');
?>	
</div>
<footer>
<div class="navbar-fixed-bottom" style="background:#000000; color:#FFFFFF; padding:3px;"><span class="pull-right" style="margin-right:10px;">Powered by: Schoolcode EdTech. www.schoolcode.com.ng</span></div>
</footer>
</body>
</html>
<script type="text/javascript">
function disable(){
	//$("input:text[name=sub_name]").click(function(){
		$(this).attr("disabled");
		//})
	}

</script>