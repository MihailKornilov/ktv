<?php
header("Content-type: text/html; charset=WINDOWS-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();

if($_SESSION['ks'])
	{
	include_once('../include/class_MysqlDB.php');
	include_once('../include/functions_date.php');
	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

	$value=iconv("UTF-8", "WINDOWS-1251",$_GET['value']);
	$ktv->Query("update abonent set prim='".$value."' where id=".$_GET['id_abonent']);
	if($value) $ktv->Query("insert into abonent_prim (id_abonent,prim,admin_add) values (".$_GET['id_abonent'].",'".$value."',".$_SESSION['ks'].")");
	echo $value;
	}
?>