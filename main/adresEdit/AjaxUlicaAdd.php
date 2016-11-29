<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
include_once('../../include/class_MysqlDB.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

if(!$_GET['gorod']) $_GET['gorod']=$ktv->QRow("select id from adres_gorod order by id desc limit 1");
$ktv->Query("insert into adres_ulica (name,id_gorod) values ('".iconv("UTF-8", "WINDOWS-1251",$_GET['name'])."',".$_GET['gorod'].")");

$idLast=$ktv->QRow("select id from adres_ulica where id_gorod=".$_GET['gorod']." order by id desc limit 1");

$ulicaArr=$ktv->QueryObjectArray("select * from adres_ulica where id_gorod=".$_GET['gorod']." order by name");
if(count($ulicaArr)>0)
	foreach($ulicaArr as $u) $ulica.="<A HREF='javascript:' onclick=adresDomGet(".$u->id.",this); class=aNaim".($idLast==$u->id?"Sel":'').">".$u->name."</A>";

echo $ulica;

?>