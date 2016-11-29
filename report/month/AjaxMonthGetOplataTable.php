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

$send="<TABLE cellspacing=0 cellpadding=0 id=repSpisok>";
$send.="<TR><TH>День<TH>Количество<TH>Сумма";
for($n=1;$n<=date("t", strtotime($_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-01"));$n++)
	{
	$oplata=$ktv->QueryRowOne("select count(id),sum(money) from oplata where status=1 and dtime_add LIKE '".$_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-".($n<10?0:'').$n."%' and admin_add in (".$_GET['admin'].") and tip in (".$_GET['oplata'].") ".$rule);
	$send.="<TR align=right>";
	$send.="<TD>".($oplata[0]>0?"<A HREF='/report/".$_GET['year']."/".$_GET['mon']."/".$n."'>".$n."</A>":$n);
	$send.="<TD align=center><B>".($oplata[0]>0?$oplata[0]:'&nbsp;')."</B>";
	$send.="<TD>".$oplata[1];
	}

$oplata=$ktv->QueryRowOne("select count(id),sum(money) from oplata where status=1 and dtime_add LIKE '".$_GET['year']."-".($_GET['mon']<10?0:'').$_GET['mon']."-%' and admin_add in (".$_GET['admin'].") and tip in (".$_GET['oplata'].") ".$rule);
$send.="<TR align=right bgcolor=#FFFFAA>";
$send.="<TD>Итог:";
$send.="<TD align=center><B>".($oplata[0]>0?$oplata[0]:'&nbsp;')."</B>";
$send.="<TD>".$oplata[1];
$send.="</TABLE>";

echo $send;
?>
