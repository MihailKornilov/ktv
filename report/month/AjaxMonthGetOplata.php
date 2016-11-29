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

$send="<DIV id=repRow>";
$admins=$ktv->QueryRowArray("select distinct(admin_add) from oplata where status=1 and dtime_add LIKE '".$_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-%'".$rule." order by admin_add");
if(count($admins)>0)
	{
	$send.="<DIV id=repAdmin>";
	$send.="<H1>Администраторы</H1>";
	foreach($admins as $ad) $send.=CheckBox($ad[0],1,$ktv->QRow("select fio from admin where id=".$ad[0]),1);
	$send.="</DIV>";
	}

$opTip=$ktv->QueryRowArray("select distinct(tip) from oplata where status=1 and dtime_add LIKE '".$_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-%'".$rule);
if(count($opTip)>0)
	{
	$send.="<DIV id=repOplata>";
	$send.="<H1>Виды платежей</H1>";
	foreach($opTip as $op) $send.=CheckBox($op[0],1,$ktv->QRow("select name from oplata_tip where id=".$op[0]),1);
	$send.="</DIV>";
	}
$send.="</DIV>";


$send.="<DIV id=repSpisokTable>";
$send.="<TABLE cellspacing=0 cellpadding=0 id=repSpisok>";
$send.="<TR><TH>День<TH>Количество<TH>Сумма";
for($n=1;$n<=date("t", strtotime($_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-01"));$n++)
	{
	$oplata=$ktv->QueryRowOne("select count(id),sum(money) from oplata where status=1 and dtime_add LIKE '".$_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-".($n<10?0:'').$n."%'".$rule);
	$send.="<TR align=right>";
	$send.="<TD>".($oplata[0]>0?"<A HREF='/report/".$_GET['year']."/".$_GET['mon']."/".$n."'>".$n."</A>":$n);
	$send.="<TD align=center><B>".($oplata[0]>0?$oplata[0]:'&nbsp;')."</B>";
	$send.="<TD>".$oplata[1];
	}
$oplata=$ktv->QueryRowOne("select count(id),sum(money) from oplata where status=1 and dtime_add LIKE '".$_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-%' ".$rule);
$send.="<TR align=right bgcolor=#FFFFAA>";
$send.="<TD>Итог:";
$send.="<TD align=center><B>".($oplata[0]>0?$oplata[0]:'&nbsp;')."</B>";
$send.="<TD>".$oplata[1];
$send.="</TABLE>";

$send.="</DIV>";

echo $send;
?>
