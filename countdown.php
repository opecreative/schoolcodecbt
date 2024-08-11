<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style>
.timer{font-size:36px; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; background:#000; color: #FFF; padding:10px; margin-top: 20px;}
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>
<span id="countdown" class="timer"></span>
<script>
var seconds = 60;
function secondPassed(){
	var minutes = Math.round((seconds - 30)/60);
	var remainingSeconds = seconds % 60;
	if(remainingSeconds < 10){
		remainingSeconds = "0" + remainingSeconds;
		
		}
	document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
	if(seconds == 0){
		
		clearInterval(countdownTimer);
		document.getElementById('countdown').innerHTML = "Buzz Buzz";
		
		}
		else{
			seconds--;
			}
	
	}

var countdownTimer = setInterval('secondPassed()', 2000);
</script>

</body>
</html>