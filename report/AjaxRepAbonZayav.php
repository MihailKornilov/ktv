<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');
include_once('../include/FUNCTIONS.php');

$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);
if($kassir->rule_report_view==0) $rule=" and admin_add=".$_SESSION['ks']; else $rule='';

if($_GET['day']==$today) $todayText="сегодня"; else $todayText=realday($_GET['day']);

$zayav=$ktv->QueryObjectArray("select * from abonent abonent where date_zayav='".$_GET['day']."' ".$rule." order by id");

if(count($zayav)>0)
	{
	$abonSend.="<TABLE cellspacing=0 cellpadding=0 id=spisok>";
	$abonSend.="<caption>Список абонентов, подавших заявку ".$todayText."</caption>";
		$abonSend.="<TH>&nbsp;";
		$abonSend.="<TH>Абонент";
		$abonSend.="<TH>Адрес";
		$abonSend.="<TH>Заявку принял";

	$statusBg=$ktv->QueryPtPArray("select id,bg from abonent_status order by id");
	$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");

	foreach($zayav as $n=>$z)
		{
		$abonSend.="<TR bgcolor=#".$statusBg[$z->status].">";
		$abonSend.="<TD align=right>".($n+1);
		$abonSend.="<TD><A HREF='/ab".$z->id."'>".$z->f." ".$z->i." ".$z->o."</A>";
		$abonSend.="<TD>".AdresSmall(0,$z->adres_gorod_name,$z->adres_ulica_name,$z->adres_dom_num,$z->adres_kv);
		$abonSend.="<TD align=center>".($z->admin_add?$admin[$z->admin_add]:'&nbsp;');
		}
	$abonSend.="</TABLE>";
	}

echo $abonSend;
?>
