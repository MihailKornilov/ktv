<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
include_once('../include/class_MysqlDB.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

$domSend="<DIV><DL style=width:60px;><DD><A HREF='javascript:' onclick=DomSet(0); id=dom0><I>не указан</I></A>";
$dom=$ktv->QueryObjectArray("select * from adres_dom where id_ulica=".$_GET['ulica']." order by num");
if(count($dom)>0)
	foreach($dom as $d) $domSend.="<DD><A HREF='javascript:' onclick=DomSet(".$d->id.");  id=dom".$d->id." style=text-align:center;>".preg_replace("/^0{1,}/",'',$d->num)."</A>";
$domSend.="</DL></DIV><TT onclick=AdresOpen(2);><I>выбрать</I></TT>";

echo $domSend;
?>