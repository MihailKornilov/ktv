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

$abonentka=$ktv->QueryObjectArray("select * from abonentka where tip=0 and dtime_add LIKE '".$_GET['day']."%' ".$rule." order by id");
if(count($abonentka)>0)
	{
	$abonSend.="<TABLE cellspacing=0 cellpadding=0 id=spisok>";
	$abonSend.="<caption>Список абонентских начислений за ".$todayText."</caption>";
		$abonSend.="<TH>&nbsp;";
		$abonSend.="<TH>Месяц";
		$abonSend.="<TH>Сумма";
		$abonSend.="<TH>Абонент";
		$abonSend.="<TH>Адрес";
		$abonSend.="<TH>Дата";
		$abonSend.="<TH>Администратор";

	$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");

	foreach($abonentka as $n=>$ab)
		{
		$abon=$ktv->QueryObjectOne("select * from abonent where id=".$ab->id_abonent);
		$year=explode('-',$ab->month);
		$abonSend.="<TR>";
		$abonSend.="<TD align=right>".($n+1);
		$abonSend.="<TD align=right>".fullmonth($year[1])." ".$year[0];
		$abonSend.="<TD align=right><B>".$ab->money."&nbsp;</B>";
		$abonSend.="<TD><A HREF='/ab".$abon->id."/abonentka'>".$abon->f." ".$abon->i." ".$abon->o."</A>";
		$abonSend.="<TD>".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
		$abonSend.="<TD align=right>".Data($ab->dtime_add);
		$abonSend.="<TD align=center>".$admin[$ab->admin_add];
		}
	$abonSend.="</TABLE>";
	}

echo $abonSend;
?>
