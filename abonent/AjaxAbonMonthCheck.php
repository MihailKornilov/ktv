<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

if($ktv->QRow("select count(id) from abonentka where tip=0 and month='".$_GET['year']."-".$_GET['mon']."-01' and id_abonent=".$_GET['abonent'])>0)
	echo "<SPAN style=color:#C33;>Начисление за <B>".fullmonth($_GET['mon'])." ".$_GET['year']."</B> уже произведено.</SPAN>";
else echo "<SPAN style=color:#393;>Начисление за <B>".fullmonth($_GET['mon'])." ".$_GET['year']."</B> не производилось.</SPAN>";
?>