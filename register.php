<?php
session_start();
ob_start();
session_destroy();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/color.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<style>
input{
	/*border:1px solid #333; width:250px; height:35px; display: block;*/
	
}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />


<body style="">
<div class="container">
    <div class="row">
        <div class="col-md-12>"
        <div id="banner" style="font-family:Verdana, Geneva, sans-serif; font-size:16px; text-align:center;">
        <h3>Akad Technologies</h3>
        <h4>Computer Based Test</h4>
        
        </div>
        
       <div class="form">
       <p> <h3 class="color-blue">Registration Form</h3> </p> 
        <form action="" method="post" class="">
        <div class="form-group">  
        <span>Surname</span>      
        <input type="text" name="sname" id="sname" class="form-control"/>
        </div>
        <div class="form-group">
        <span>Othername</span>
        <input type="text" name="other" id="other" class="form-control" />
        </div>
        <div class="form-group">
        <span>Username</span>
        <input type="text" name="user" id="user" class="form-control"/>
        </div>
        <div class="form-group">
         <span>Password</span>
        <input type="password" name="password" id="password" class="form-control"/>
        </div>
        <div class="form-group">
         <span>Confirm Password</span>
        <input type="password" name="confirm-password" id="confirm-password" class="form-control"/>
        </div>
        
        <div class="form-group">
        <span>Passport</span>
        <input type="file" name="file" id="file" class="form-control"/>
        
        </div>
       
        <div class="form-group">
      
        <input type="submit" name="submit" id="submit" value="Register" class="form-control"/>
         <a href="#">Login</a> instead
        </div> 
        <script type="text/javascript">
		 
		</script>
        
         </form>
         </div>	
        <div id="msg"><?php 
        if(isset($_POST['submit'])){
                require('conn.php');
                $sname=$_POST['sname'];
                $other=$_POST['other'];
                $user=$_POST['user'];
                $pass=$_POST['password'];
            
            $reg = mysqli_query($con, "INSERT INTO user (surname, othername, username, password) VALUES('$sname','$other','$user','$pass')");
            echo "You have registered";
        }
         ?></div>
        
      
    	</div>
	</div>
</div>
</body>
</html>