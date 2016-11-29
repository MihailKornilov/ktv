<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
include_once('../../include/class_MysqlDB.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

$ktv->Query("insert into adres_gorod (name) values ('".iconv("UTF-8", "WINDOWS-1251",$_GET['name'])."')");

$idLast=$ktv->QRow("select id from adres_gorod order by id desc limit 1");

$gorodArr=$ktv->QueryObjectArray("select * from adres_gorod order by name");
if(count($gorodArr)>0)
	foreach($gorodArr as $g) $gorod.="<A HREF='javascript:' onclick=adresUlicaGet(".$g->id.",this); class=aNaim".($idLast==$g->id?"Sel":'').">".$g->name."</A>";

echo $gorod;

?>