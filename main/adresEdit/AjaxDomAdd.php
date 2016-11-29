<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
include_once('../../include/class_MysqlDB.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

$num=iconv("UTF-8", "WINDOWS-1251",$_GET['num']);
if(preg_match("/\D/",$num.'.',$match,PREG_OFFSET_CAPTURE))
for($n=0;$n<=4-$match[0][1];$n++) $nol.='0';

if(!$_GET['gorod']) $_GET['gorod']=$ktv->QRow("select id from adres_gorod order by id desc limit 1");

if(!$_GET['ulica']) $_GET['ulica']=$ktv->QRow("select id from adres_ulica where id_gorod=".$_GET['gorod']." order by name limit 1");
$ktv->Query("insert into adres_dom (num,id_ulica) values ('".$nol.$num."',".$_GET['ulica'].")");

$idLast=$ktv->QRow("select id from adres_dom where id_ulica=".$_GET['ulica']." order by id desc limit 1");

$domArr=$ktv->QueryObjectArray("select id,num from adres_dom where id_ulica=".$_GET['ulica']." order by num");
$dom="<DL>";
foreach($domArr as $d) $dom.="<DD".($d->id==$idLast?" class=domAdded":'').">".preg_replace("/^0{1,}/",'',$d->num);
$dom.="</DL>";
echo $dom;
?>