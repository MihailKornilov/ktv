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

$uslugi=$ktv->QueryObjectArray("select * from abonentka where tip=1 and dtime_add LIKE '".$_GET['day']."%' ".$rule." order by id");
if(count($uslugi)>0)
	{
	$abonSend.="<TABLE cellspacing=0 cellpadding=0 id=spisok>";
	$abonSend.="<caption>Список услуг за ".$todayText."</caption>";
		$abonSend.="<TH>&nbsp;";
		$abonSend.="<TH>Наименование";
		$abonSend.="<TH>Стоимость";
		$abonSend.="<TH>Абонент";
		$abonSend.="<TH>Адрес";
		$abonSend.="<TH>Дата";
		$abonSend.="<TH>Внёс";

	$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");

	foreach($uslugi as $n=>$us)
		{
		$abon=$ktv->QueryObjectOne("select * from abonent where id=".$us->id_abonent);
		$abonSend.="<TR>";
		$abonSend.="<TD align=right>".($n+1);
		$abonSend.="<TD>".$us->name;
		$abonSend.="<TD align=center>".$us->money;
		$abonSend.="<TD><A HREF='/ab".$abon->id."/uslugi'>".$abon->f." ".$abon->i." ".$abon->o."</A>";
		$abonSend.="<TD>".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
		$abonSend.="<TD align=right>".Data($us->dtime_add);
		$abonSend.="<TD align=center>".$admin[$us->admin_add];
		}
	$abonSend.="</TABLE>";
	}

echo $abonSend;
?>
