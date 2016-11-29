<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
include_once('../../include/class_MysqlDB.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

if($_GET['gorod']) $_GET['ulica']=$ktv->QRow("select id from adres_ulica where id_gorod=".$_GET['gorod']." order by name limit 1");

if($_GET['ulica'])
	{
	$domArr=$ktv->QueryObjectArray("select num from adres_dom where id_ulica=".$_GET['ulica']." order by num");
	if(count($domArr)>0)
		{
		$dom="<DL>";
		foreach($domArr as $d) $dom.="<DD>".preg_replace("/^0{1,}/",'',$d->num);
		$dom.="</DL>";
		echo $dom;
		}
	}

if(!$dom) echo "<SPAN>домов нет</SPAN>";

?>