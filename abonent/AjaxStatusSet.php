<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

$oldStatus=$ktv->QRow("select status from abonent where id=".$_GET['abon']);

$ktv->Query("update abonent set status=".$_GET['status'].",status_edit=current_timestamp where id=".$_GET['abon']);
$statusName=$ktv->QueryPtPArray("select id,name from abonent_status order by id");
$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение статуса','".$statusName[$oldStatus]."','".$statusName[$_GET['status']]."',".$_GET['abon'].",".$_SESSION['ks'].")");
echo "(<A HREF='javascript:' onclick=Calendar('".strftime("%Y-%m-%d",time())."',event,'abSmallStatusSet');>".realday(strftime("%Y-%m-%d",time()))."</A>)";
?>