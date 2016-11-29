<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
session_name($session);
session_start();
include_once('../../include/class_MysqlDB.php');
include_once('../../include/FUNCTIONS.php');

$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);
if($kassir->rule_report_view==0) $rule=" and admin_add=".$_SESSION['ks']; else $rule='';

$send.="<TABLE cellspacing=0 cellpadding=0 id=repSpisok>";
$send.="<TR><TH>День<TH>Количество";
for($n=1;$n<=date("t", strtotime($_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-01"));$n++)
	{
	$zayav=$ktv->QRow("select count(id) from abonent abonent where date_zayav='".$_GET['year']."-".$_GET['mon']."-".$n."' ".$rule);
	$send.="<TR align=right>";
	$send.="<TD>".($zayav>0?"<A HREF='/report/".$_GET['year']."/".$_GET['mon']."/".$n."'>".$n."</A>":$n);
	$send.="<TD align=center><B>".($zayav>0?$zayav:'&nbsp;')."</B>";
	}
$zayav=$ktv->QRow("select count(id) from abonent abonent where date_zayav LIKE '".$_GET['year']."-".(abs($_GET['mon'])<10?'0':'').$_GET['mon']."-%' ".$rule);
$send.="<TR align=right bgcolor=#FFFFAA>";
$send.="<TD>Итог:";
$send.="<TD align=center><B>".($zayav>0?$zayav:'&nbsp;')."</B>";
$send.="</TABLE>";

echo $send;
?>
