<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
include_once('../include/class_MysqlDB.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

$ulicaSend="<DIV><DL style=width:150px;><DD><A HREF='javascript:' onclick=UlicaSet(0); id=ulica0><I>не указана</I></A>";
$ulica=$ktv->QueryObjectArray("select * from adres_ulica where id_gorod=".$_GET['gorod']." order by name");
if(count($ulica)>0)
	foreach($ulica as $u) $ulicaSend.="<DD><A HREF='javascript:' onclick=UlicaSet(".$u->id."); id=ulica".$u->id.">".$u->name."</A>";
$ulicaSend.="</DL></DIV><TT onclick=AdresOpen(1);><I>выбрать</I></TT>";

echo $ulicaSend;
?>