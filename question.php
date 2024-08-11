<?php
session_start();
ob_start();
if(!isset($_SESSION['USERNAME'])){
	header('Location:index.php');
	
	}
 	$admission = $_SESSION['USERNAME'];
	$sub_id = $_SESSION['SUB_ID'];
  if(isset($_SESSION['opt'])){echo $_SESSION['opt'];}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document</title>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<Style>


#question_box{border: 0px solid #333; width: 1000px; height:auto; padding:3px;}
#right_box{background:#000; border:1px solid #333; color:#fff; float:right; width: 300px;}
a{text-decoration:none; color:#fff; padding:2px; }
span{
	padding:3px; margin-top:30px; margin-right:2px; 
	border-radius: 5px; text-decoration:none;  
	font-family:Verdana, Geneva, sans-serif; color: #FFF;
	font-size:12px;
	line-height:25px;
		 }
.ref {
	padding: 10px; margin-bottom: 50px; 
	border-radius:5px; text-decoration:none;  
	background:#F63; 
	font-family:Verdana, Geneva, sans-serif; color: #FFF; 
	
	 }
#question{margin-bottom:20px; border:0px solid #000; font-size:14px;}
.page_num{
	
	}
img{width:auto; border:1px solid:#000; height:auto;}
</style>


</head><link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>
<?php
require_once('conn.php');

if(!isset($_GET['id'])){
		$page = 1;
	}

elseif(isset($_GET['id'])){
		$page = $_GET['id'];
	}
	
//select from displayed_q
$displayed = mysqli_query($con, "SELECT * FROM displayed_q WHERE sub_id = '$sub_id' AND admission = '$admission' AND question_num = '$page'");
$display = mysqli_fetch_array($displayed);
$display_q_num = $display['question_num'];
$display_q_id = $display['q_id'];

// select from question where id matches q_id in displayed_q table
$per_page1 = mysqli_query($con, "SELECT * FROM question_bank WHERE sub_id = '$sub_id' AND id = '$display_q_id'");
$q_row = mysqli_fetch_array($per_page1);

//total question from question bank
//$total = mysqli_query($con, "SELECT * FROM question_bank WHERE sub_id = '$sub_id'");
$total = mysqli_query($con, "SELECT * FROM displayed_q WHERE sub_id = '$sub_id' AND admission = '$admission'");
$question_total = mysqli_num_rows($total);
//question number
$total_q = mysqli_num_rows($total);

//$question_number = mysqli_query($con, "SELECT * FROM number LIMIT '$question_total'");



$per_page = mysqli_query($con, "SELECT * FROM number WHERE number = '$page'");
$page_number = mysqli_fetch_array($per_page);
$n = 1;

?>

<div id="question">
<?php
$candidate = mysqli_query($con, "SELECT * FROM user WHERE admission = '$admission' ");
$fetch = mysqli_fetch_array($candidate);
$class_id = $fetch['class_id'];
?>
<!--<div style="text-transform:capitalize; font-size:24px; font-family:calibri;"> <?php  //echo  $fetch['surname']." ".$fetch['othername']; ?></div>
--><?php
//$row= mysqli_fetch_array($per_page1);

$qn = $page;
$q_id = $q_row['id'];


//$q = mysqli_fetch_array($displayed);
//$display_q_num = $display['q_id'];
//$q_select = mysqli_query($con, "SELECT * FROM question_bank WHERE sub_id = '$sub_id' and id = '$display_q_num'");


$question = $q_row['question'];
$correct = strtolower($q_row['answer']);
$diagram = $q_row['diagram'];
 ?>

<div id="question_box">
 <table>
	
	 <tr>
     <td style='color:#036; font-family:arial ;  font-weight:bold;' valign="top"> <?php echo $qn.'.'; ?></td>
     <td style='color:#036; font-family:arial ; width:750px; font-weight:bold; padding:5px;'> <?php echo $question; ?> </td>
     </tr>
	 <form action='' method='post' name="q_form" id="q_form">	
     <input type ='hidden' name='uname' id='uname' value='<?php echo $_SESSION['USERNAME']; ?>' />  
	 <input type ='hidden' name='answer' id='answer' value='<?php echo strtolower($q_row['answer']); ?>' /> 
	 <input type ='hidden' name='sub_id' id='sub_id' value='<?php echo $sub_id; ?>' />
	 <input type ='hidden' name='q_id' id='q_id' value='<?php echo $qn; ?>' />  
	 <input type ='hidden' name='quest' id='quest' value='<?php echo $question; ?>' /> 
     <input type ='hidden' name='class_id' id='class_id' value='<?php echo $class_id; ?>' /> 

		
		<?php
		
		// if there is diagram in the question
		if($diagram != "")
		{
			echo '<tr><td></td><td style=font-family:arial;><img src='.$diagram.' class="diagram"></td></tr>';
			
			}
			
			$user = $_SESSION['USERNAME'];
			$select_q = mysqli_query($con, "SELECT * FROM answer WHERE q_id = '$qn' AND username = '$user' AND subject_id ='$sub_id'");
			$fetch = mysqli_fetch_array($select_q);
			
			//SELECT EXAM TYPE FROM SUBJECT
			$exam = mysqli_query($con, "SELECT exam_type FROM subject WHERE sub_id='$sub_id'");
			$type = mysqli_fetch_array($exam);
			$exam_type = $type['exam_type'];
			echo '<input type="hidden" id="exam_type" value="'.$exam_type.'">';		
			
			  $slected_answer = $fetch['opt'];
			 if($slected_answer == "a"){
				 echo "<tr>
				 <td></td>
				 <td style='font-family:arial;'>A. <input type ='radio' name='opt' id='opt1' value='a'  checked /> <label for ='opt1'>$q_row[opt1]</label></td>
				 </tr>	
     			 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>B. <input type ='radio' name='opt' id='opt2' value='b'  /> <label for ='opt2'>$q_row[opt2]</label></td>
				 </tr> 
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>C. <input type ='radio' name='opt' id='opt3' value='c'  /> <label for ='opt3'>$q_row[opt3]</label></td>
				 </tr>
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>D. <input type ='radio' name='opt' id='opt4' value='d'  /> <label for ='opt4'>$q_row[opt4]</label></td>
				 </tr>";
			 }	
			elseif($slected_answer == "b"){
				 echo "<tr>
				 <td></td>
				 <td style='font-family:arial;'>A. <input type ='radio' name='opt' id='opt1' value='a'/> <label for ='opt1'>$q_row[opt1]</label></td>
				 </tr>	
     			 <tr>
				 <td></td>
				 <td style='font-family:arial;'>B. <input type ='radio' name='opt' id='opt2' value='b' checked /> <label for='opt2'>$q_row[opt2]</label></td>
				 </tr> 
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>C. <input type ='radio' name='opt' id='opt3' value='c' /> <label for ='opt3'>$q_row[opt3]</label></td>
				 </tr>
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>D. <input type ='radio' name='opt' id='opt4' value='d'  /> <label for ='opt4'>$q_row[opt4]</label></td>
				 </tr>";
			 }
			elseif($slected_answer == "c"){
				 echo "<tr>
				 <td></td>
				 <td style='font-family:arial;'>A. <input type ='radio' name='opt' id='opt1' value='a' /> <label for ='opt1'>$q_row[opt1]</label></td>
				 </tr>	
     			 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>B. <input type ='radio' name='opt' id='opt2' value='b'  /> <label for ='opt2'>$q_row[opt2]</label></td>
				 </tr> 
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>C. <input type ='radio' name='opt' id='opt3' value='c' checked /> <label for ='opt3'>$q_row[opt3]</label></td>
				 </tr>
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>D. <input type ='radio' name='opt' id='opt4' value='d'  /> <label for ='opt4'>$q_row[opt4]</label></td>
				 </tr>";
			 }			
			elseif($slected_answer == "d"){
				 echo "<tr>
				 <td></td>
				 <td style='font-family:arial;'>A. <input type ='radio' name='opt' id='opt1' value='a'   /> <label for ='opt1'>$q_row[opt1]</label></td>
				 </tr>	
     			 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>B. <input type ='radio' name='opt' id='opt2' value='b'  /> <label for ='opt2'>$q_row[opt2]</label></td>
				 </tr> 
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>C. <input type ='radio' name='opt' id='opt3' value='c'  /> <label for ='opt3'>$q_row[opt3]</label></td>
				 </tr>
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>D. <input type ='radio' name='opt' id='opt4' value='d' checked /> <label for ='opt4'>$q_row[opt4]</label></td>
				 </tr>";
			 }		
			else{
				 echo "<tr>
				 <td></td>
				 <td style='font-family:arial;'>A. <input type ='radio' name='opt' id='opt1' value='a'   /> <label for ='opt1'>$q_row[opt1]</label></td>
				 </tr>	
     			 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>B. <input type ='radio' name='opt' id='opt2' value='b'  /> <label for ='opt2'>$q_row[opt2]</label></td>
				 </tr> 
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>C. <input type ='radio' name='opt' id='opt3' value='c'  /> <label for ='opt3'>$q_row[opt3]</label></td>
				 </tr>
				 <tr>
				 <td></td>
				 <td style='font-family:arial ;'>D. <input type ='radio' name='opt' id='opt4' value='d'  /> <label for ='opt4'>$q_row[opt4]</label></td>
				 </tr>";
			 }				 
			 
		?>

	 
     
	 </form>
 </table>
 </div>

<script type="text/javascript">

///// using keyboard shortcuts/////

	$(document).keypress(function(event)
	{
	var key = event.which || event.keycode;
	if(key == 97 || key == 65)
	{
		$("#opt1").attr("checked", "checked");	
		}
	
	
})

function saveAnswer(){
	 $("input[name=opt]").blur(function(){
		var option = $(this).val();
		var answer = $("#answer").val();
		var username = $("#uname").val();
		var class_id = $("#class_id").val();
		var exam_type = $("#exam_type").val();
		var q = $("#quest").val();
		var q_id = $("#q_id").val();
			if(answer == option){
				answer = 2;
			}
			else
			{
				answer = 0;
			}
		$.ajax({
		type: "POST",
		url: "insert.php",
		data: {"option": option, "answer": answer, "user": username, "quest": q, "q_id": q_id, "class_id":class_id, "exam_type":exam_type},	
		success: function(data){
			
			$("#result").html(data);
			
		}
		});
		
		
		
		});	
		
	}// function saveAnswer	
 saveAnswer();
	</script>
	<div id="result"></div>
</div>
<div style="word-wrap:break-word; padding:3px;">
<?php
	
	
	    
	$id = $page_number['number'] + 1;
	
if(!isset($_GET['q_id'])){
	$pre = $total_q;
	$prev = $pre - 1;
	}
	
if(isset($_GET['id'])){
	$pre = $_GET['id'];
	$prev = $pre - 1;
if($prev == 0){
	$prev = $total_q;
	
	}
if($id > $total_q){
	
	$id = 1;
	}
  } 

	 
	 
	 
	


echo "<p><a href='?id=$prev' class='ref' id='ref' >Previous</a> <b>Question $page of $total_q </b>";
echo " <a href='?id=$id' class='ref' id='ref' >Next</a></p>";
echo "<hr size='1' style='color:#CCC;'>";
echo "<div class='number'>";
			//echo $sub_id;
			$select_q_id = mysqli_query($con, "SELECT q_id FROM answer WHERE username = '$user' AND subject_id ='$sub_id' ORDER BY q_id ASC");
			//$fetch = mysqli_fetch_array($select_q);
			//$question_number_answered = $fetch['q_id'];
			
			//$select_q_id = mysqli_query($con, "SELECT * FROM answer WHERE username = '$user' ORDER BY q_id ASC");
				
 for($i=1; $i<=$total_q; $i++){
	 		$fetch = mysqli_fetch_array($select_q_id);
			$question_number_answered[] = $fetch['q_id'];
		if(in_array($i, $question_number_answered)){
		
		if($i == $page){echo "<span style='background: #090;' class='page_num'>$i</span>";}
		else{echo "<span style='background:red;' class='page_num'><a href='?id=$i'>$i</a></span>";}
		
	}
			
	elseif($i == $page){
		echo "<span style='background: #090;' class='page_num'>$i</span>";
		
	}
	//elseif($i==16){
		//Applying line break on the pagination
		//echo "<span style='' class='page_num'><a href='?id=$i'>$i</a></span><br /><hr/>";
	//}
	elseif($i != $page){
	echo "<span style='background:#09F;' class='page_num'><a href='?id=$i'>$i</a></span>";
	}
	
	
	}
	
?>
</div>
</div>



</body>
</html>