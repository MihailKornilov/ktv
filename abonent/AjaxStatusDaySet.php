<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
$ktv->Query("update abonent set status_edit='".$_GET['day']."' where id=".$_GET['abon']);
echo "(<A HREF='javascript:' onclick=Calendar('".$_GET['day']."',event,'abSmallStatusSet');>".realday($_GET['day'])."</A>)";
?>