
<?php
$con = mysqli_connect('localhost', 'root', '', 'schoolco_cbtapp');

?>
<?php
//Selecting from settings
$setting_select = mysqli_query($con, "SELECT * FROM settings");
$setting = mysqli_fetch_array($setting_select);
$sch_name = $setting['sch_name'];
?>