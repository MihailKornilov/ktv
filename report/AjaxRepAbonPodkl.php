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

if($_GET['day']==$today) $todayText="�������"; else $todayText=realday($_GET['day']);

$podkl=$ktv->QueryObjectArray("select * from abonent abonent where date_podkl='".$_GET['day']."' ".$rule." order by id");
if(count($podkl)>0)
	{
	$abonSend.="<TABLE cellspacing=0 cellpadding=0 id=spisok width=400>";
	$abonSend.="<caption>������ ���������, ������������ ".$todayText."</caption>";
		$abonSend.="<TH>&nbsp;";
		$abonSend.="<TH>�������";
		$abonSend.="<TH>�����";

	$statusBg=$ktv->QueryPtPArray("select id,bg from abonent_status order by id");

	foreach($podkl as $n=>$p)
		{
		$abonSend.="<TR bgcolor=#".$statusBg[$p->status].">";
		$abonSend.="<TD align=right>".($n+1);
		$abonSend.="<TD><A HREF='/ab".$p->id."'>".$p->f." ".$p->i." ".$p->o."</A>";
		$abonSend.="<TD>".AdresSmall(0,$p->adres_gorod_name,$p->adres_ulica_name,$p->adres_dom_num,$p->adres_kv);
		}
	$abonSend.="</TABLE>";
	}

echo $abonSend;
?>
