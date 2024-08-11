<?php
session_start();
unset($_SESSION['USERNAME']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>SchoolCode | Start Exam</title>
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
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />
<body style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; background:#FFFFFF;">
<div class="header">
	     <div class="container">
		 		<div class="content">
					<div id="banner" style="background-image:url(img/e-teating_banner.png); height:50px; width:100%; background-repeat:no-repeat; background-position:center; background-size:cover;">
				</div>
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
                  <?php
				  include'conn.php';
				  ?>
	              </div>
	           </div>
	        </div>
	     </div>
</div>
<div id="banner" style="font-family:Verdana, Geneva, sans-serif; font-size:16px; text-align:center;">
<h1></h1>
</div>
<div class="container">
<div class="instruction">
<div class="alert alert-info" align="center">
<b>Instruction:</b><br/> Enter your registration number and surname in the boxes below. If you forget your registration number, click on <b>Forgtten Reg. number</b> button below the form, type your surname in the dialog box displayed to find your registration number.
</div>
</div>
<div class="row">
<div class="col-lg-12">
<h4 align="center" ><i class="fa fa-sign-in"></i> Login here and start your exam</h4>
<form action="cbt_login.php" method="post">
<div class="form-group">
<span>Registration Number</span>
<input type="text" name="username" id="username" class="form-control" placeholder="Enter Your registration number Here. e.g SJCCC/12/1298" title="Enter Your Number Here. e.g 1298"/>
</div>
<div class="form-group">
<span>Surname</span>
<input type="text" name="password" id="password" class="form-control" placeholder="Enter Your Surname Here. e.g Babalola" title="Enter Your Surname Here. e.g Babalola"/>
</div>
<div class="form-group">
<input type="submit" class="form-control btn btn-primary" name="submit" id="submit" value="Click Here and Start Exam" />
</div>
</form>
<div id="msg">
<?php 
if(isset($_GET['login'])){
		$msg="You must first login to use this application";
		echo "<p style=' color: red;' align='center'> $msg </p>";
}
elseif(isset($_GET['register'])){
		$msg="Your record was not found. Please contact the administrator";
		echo "<p style=' color: red;' align='center'> $msg </p>";
}
elseif(isset($_GET['q'])){
		$msg="An error occured. Questions are yet to be uploaded!";
		echo "<p style=' color: red;' align='center'> $msg </p>";
}
elseif(isset($_GET['done'])){
		$msg="Access Denied! Contact the admin. <b>ErrorType: EXAM_DONE</b>";
		echo "<p style=' color: red;' align='center'> $msg </p>";
}
?>
</div><!--/msg-->
</div>
</div>
</div>
<!-- Trigger/Open The Modal FOr forgotten Reg Number -->
<center><button id="myBtn" class="btn btn-info">Forgotten Reg. number? Click Here</button></center>
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h4><img src="img/search.png" /> Find your name and registration number here:</h4>
    </div>
    <div class="modal-body">
      <p>
      <form action="" method="post">
      	<div class="col-md-12">
      	<div class="col-md-10">
        <span style="margin-right:auto; margin-left:auto;">Enter your surname in the box</span>
      	<input type="text" name="userSurname" id="userSurname" class="form-control" placeholder="Enter your surname here" />
        </div>
        <div class="col-md-6">
        <!--<button name="find" class="btn btn-primary" onclick="">Search</button>-->
        </div>
       
      </div>
      </form>
      </p>
      <p>
      </p>
      <div class="clearfix"></div>
      <div class="displayName"></div>
       <div class="clearfix"></div>
       <script type="text/javascript">
	   		$("#userSurname").focus(function(){
				$(".displayName").html('Searching...');
				
				})
			$("#userSurname").keyup(function(){
				
				var userSurname = $("#userSurname").val();
				//alert(userSurname);
				$.ajax({
					url: "searching_name.php",
					type:"POST",
					data:{"surname":userSurname},
					success: function(data){
						$(".displayName").html(data);
						
						}
			
					});
				
				});
		</script>
    </div>
    <div class="modal-footer">
      <h4>Schoolcode Educational Technologies</h4>
    </div>
  </div>
</div><!---/Simple Modal Ends Here---->
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#username").focus();
	//alert();
	
	});
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

//Get Surname  of the user
var surname = $("#password").val();
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
	
    modal.style.display = "block";
	document.getElementById("userSurname").focus();
	
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<div class="navbar-fixed-bottom" style="background:#000000; color:#FFFFFF; padding:3px;"><span class="pull-right" style="margin-right:10px;">Powered by: mediaCode Studio. www.schoolcode.com.ng</span></div>
</body>
</html>
