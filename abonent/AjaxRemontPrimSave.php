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

if($_SESSION['ks'])
	{
	$ktv->Query("insert into remont_prim (id_remont,prim,admin_add) values (".$_GET['id_remont'].",'".iconv("UTF-8", "WINDOWS-1251", $_GET['value'])."',".$_SESSION['ks'].")");
	$primSpisok=$ktv->QueryObjectArray("select * from remont_prim where id_remont=".$_GET['id_remont']." order by id");
	$spisok="<TABLE cellspacing=0 cellpadding=0>";
	$spisok.="<CAPTION>История<CAPTION>";
	$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");
	foreach($primSpisok as $sp) $spisok.="<TR><TD><STRONG>".$sp->prim."</STRONG><TD>".$admin[$sp->admin_add]."<TD>".Data($sp->dtime_add);
	$spisok.="</TABLE>";
	echo $spisok;
	}
?>