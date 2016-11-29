<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
include_once('../../include/class_MysqlDB.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

$ulicaArr=$ktv->QueryObjectArray("select * from adres_ulica where id_gorod=".$_GET['gorod']." order by name");
if(count($ulicaArr)>0)
	{
	foreach($ulicaArr as $n=>$u) $ulica.="<A HREF='javascript:' onclick=adresDomGet(".$u->id.",this); class=aNaim".($n==0?"Sel":'').">".$u->name."</A>";
	echo $ulica;
	}
else echo "<SPAN>улиц нет</SPAN>";
?>