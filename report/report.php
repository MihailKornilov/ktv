<?php
$today=strftime('%Y-%m-%d',time());
if($_GET['day']) $ktv->Query("update admin set otchet_day='".$_GET['day']."' where id=".$_SESSION['ks']);
else
	if($kassir->otchet_day=='0000-00-00')
		{
		$ktv->Query("update admin set otchet_day='".$today."' where id=".$_SESSION['ks']);
		$_GET['day']=$today;
		}
	else $_GET['day']=$kassir->otchet_day;

$repDay=explode('-',$_GET['day']);
?>


