<?php
session_start();
ob_start();
if(!isset($_SESSION['USERNAME'])){
	header('Location:index.php?login');
	}
$user = $_SESSION['USERNAME'];
require_once('conn.php');
	 if(isset($_SESSION['SUB_ID'])){
	 $sub_id = $_SESSION['SUB_ID'];
	//if subject is not in the question bank
	$select_question = mysqli_query($con, "SELECT * FROM question_bank WHERE sub_id ='$sub_id'");
	$sub_num_row = mysqli_num_rows($select_question);
	if($sub_num_row == 0){	
		header("Location:index.php?q=NO");
	}	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=0, maximum-scale=0">

<title>CBT EXAM</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<Style>
html, body{ position:fixed; top:0; bottom:0; left:0; right:0;}
body{padding:3px;}
.content{width:100%; margin-left:auto; margin-right:auto;}
.timer{font-size:36px; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; background:#000; color: #fff; padding:0px 10px 0px 10px; margin-top: 0px; float:right; height:inherit;
}
.student_details td{padding:5px;}
.passport_wrap{
	width:140px; height:140px;
	padding:5px;
	border:1px solid #CCC;
	text-align:center;
	
	}
.passport{
	width:130px; height:130px;
	border:0px solid #CCC;
  	background-image:url(img/avatar.gif);
	background-repeat:no-repeat;
	background-position:center;
	overflow:hidden;
	text-align:center;
	margin-left:auto; margin-right:auto;	
	}
.question{float:left; width:900px; border:0px solid #CCC; padding:5px; word-wrap:break-word;}
.studPass{width:120px; margin-left:auto; margin-right:auto;}
.side-bar{border-left:1px solid #E0E0E0; padding-bottom:20px; float:left; width:auto; padding:10px;}
#wrap{margin-left:auto; margin-right:auto; border:0px solid #CCC;}
#banner{margin-left:auto; margin-right:auto; font-family:"MS Serif", "New York", serif; font-size:24px;}
.your_time{ height:70px; background:#CCC; color:#fff; margin:auto;}
.your_time div{ height:40px;  margin:auto;}
.gif-loading{
	width:100%;
	height:100%;
	top:0;
	right:0;
	bottom:0;
	left:0;
	z-index:100;
	background-image:url(img/loadingAnimation.gif);
	background-color:#666;
	opacity:0.4;
	background-repeat:no-repeat;
	background-position:center;
	position:fixed;
	}
</style>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />
<body style="width:100%;">
<script type="text/javascript">
	//window.onbeforeunload(function(e){
		//confirm("Are you sure");
		//});
</script>
<div class="content">
<div id="banner" style="background-image:url(img/e-teating_banner.png); height:80px; width:auto; background-repeat:no-repeat; background-position:center; background-size:cover;">
</div>
<!--Script that counts -->
<?php
	//get time_left from duration
	$select_duration = mysqli_query($con, "SELECT duration FROM duration WHERE subjectid = '$sub_id'");

	$fetch_duration = mysqli_fetch_array($select_duration);
	$duration = $fetch_duration['duration'];
	 //select user exam status
	$sel_user = mysqli_query($con,"SELECT * FROM user WHERE admission ='$user'");
	$fetch_user = mysqli_fetch_array($sel_user);
	if($fetch_user['current_exam'] == "" && $fetch_user['done'] == ''){
		$update = mysqli_query($con, "UPDATE user SET time_left = '$duration', current_exam = '$sub_id' WHERE admission = '$user'");
	}
		
	//get time_left from user
	$select_time = mysqli_query($con, "SELECT * FROM user WHERE admission = '$user'");
	$fetch_time = mysqli_fetch_array($select_time);
	 $time_left = $fetch_time['time_left'];
	 //$active = $fetch_time['active'];
?>
    <input type="hidden" id="time_left" value="<?php echo $time_left; ?>" /> 
	<div class="your_time">
   		<div  class="pull-left" style="margin-left:100px; margin-top:20px;"><a href="finish.php" class="btn btn-primary">Click Here to Submit Your Exam</a>

	</div>
	<div class="inform pull-left" style="color:red; margin-left:5px; text-decoration:blink;"></div>
	<span id="countdown" class="timer"></span>
	<script type="text/javascript">
	var seconds = $("#time_left").val();
	function secondPassed(){
		var minutes = Math.round((seconds - 30)/60);
		var remainingSeconds = seconds % 60;
		if(remainingSeconds < 10){
			remainingSeconds = "0" + remainingSeconds;			
			}
		document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
		if(seconds == 0){		
			clearInterval(countdownTimer);
			//document.getElementById('countdown').innerHTML = "Time Up!";
			window.location.href="timeup.php";
				}				
			else{
				var sec = seconds--;				
				//update time_left in user table
				$.ajax({
				type:"post",
				url:"update_time_left.php",
				data:{"time_left":sec},
				success: function(data){
				//$("#tt").html(data)
			}				
		});
				}
		if(minutes < 6)
		{
		$(".timer").css("background","red");
		$(".inform").html("<h3>You have less than "+(minutes+1)+"min. to submit</h3>");
		}		
		}
	var countdownTimer = setInterval('secondPassed()', 1000);	
	</script>
    <div id="tt"></div>
	</div>
<div class="question">
<div id="wrap">

	<div id="gif-loading"></div>
	<div class="frame">
	<iframe title="cbt" name="cbt" src="question.php" id="cbt" scrolling="no" style="border:0px solid #333; word-wrap:break-word;" height="500" width="100%">
	</iframe>
	</div>

</div><!---/wrap--->
</div><!---/lg-10--->
<div class="side-bar">
<h4 align="center" class="alert alert-info">Student's Information</h4>
<?php
$select_user = mysqli_query($con, "SELECT * FROM user WHERE admission = '$user'");
$fetch_user = mysqli_fetch_array($select_user);
$surname = $fetch_user['surname'];
$othername = $fetch_user['othername'];
$admission = $fetch_user['admission'];
$class = $fetch_user['class'];
$passport = 'admin/admin/'.$fetch_user['pix'];
//subject
$select_sub= mysqli_query($con, "SELECT * FROM subject WHERE sub_id = '$sub_id'");
$fetch_sub = mysqli_fetch_array($select_sub);
$subject = $fetch_sub['subject'];
?>
<div class="student_details">
<table border="0"  width="100%" style="font-size:12px;" class="table-striped" >
	<tr><td ></td><td>
    	<div class="passport_wrap">
    	<div class="passport"><img src="<?php echo $passport; ?>" class="studPass" /></div>
        </div>
    </td>
    </tr>
	<tr ><th>Name: </th><td><?php echo $surname." ".$othername; ?></td></tr>
    <tr><th>Admission No: </th><td><?php echo $admission; ?></td></tr>
    <tr><th>Subject: </th><td><?php echo $subject; ?></td></tr>
    <tr><th>Class: </th><td><?php echo $class; ?></td></tr>
</table>
<div align="center"><a href="finish.php" class="btn btn-primary">Submit</a></div>

</div>
</div>
<div class="clearfix" style="height:20px;"> </div>
<div class="navbar-fixed-bottom" style="background:#000; padding:3px; color:#FFF;"><center><span>Powered by mediaCode Studio. <i class="fa fa-phone"></i> +2348064117052</span></center></div>
</div><!---/row--->
</div><!---/container--->
</body>
</html>