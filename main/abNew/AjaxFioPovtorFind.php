<?php
header("Content-type: text/html; charset=WINDOWS-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
session_name($session);
session_start();

if($_SESSION['ks'])
	{
	include_once('../../include/class_MysqlDB.php');
	include_once('../../include/functions_date.php');
	include_once('../../include/FUNCTIONS.php');
	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

	if($_GET['f']) $f=iconv("UTF-8", "WINDOWS-1251",$_GET['f']);
	if($_GET['i']) $i=iconv("UTF-8", "WINDOWS-1251",$_GET['i']);
	if($_GET['o']) $o=iconv("UTF-8", "WINDOWS-1251",$_GET['o']);

	if($_GET['id']) $id=" and id!=".$_GET['id'];

	$fio=$ktv->QueryObjectArray("select * from abonent where f='".$f."' and i='".$i."' and o='".$o."'".$id);
	if(count($fio)>0)
		{
		$send="<SPAN style=color:#D33>совпадений по ФИО: <B>".count($fio)."</B></SPAN>";
		$send.="<DIV id=povtor>";
		foreach($fio as $ab) $send.="<A HREF='/ab".$ab->id."/edit' target='blank'>".$ab->f." ".$ab->i." ".$ab->o.", ".AdresSmall(0,$ab->adres_gorod_name,$ab->adres_ulica_name,$ab->adres_dom_num,$ab->adres_kv)."</A>";
		$send.="</DIV>";
		echo $send;
		}
	else echo "<SPAN style=color:#090>совпадений по <B>ФИО</B> не найдено.</SPAN>";
	}
?>