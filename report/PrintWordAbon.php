<?php
include_once('../include/conf.php');
session_name($session);
session_start();
if($_SESSION['ks'])
	{
	require_once('../include/clsMsDocGenerator.php');
	require_once('../include/functions_date.php');
	require_once('../include/FUNCTIONS.php');
	include_once('../include/class_MysqlDB.php');
	
	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
	$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);
	
	$abonentka=$ktv->QueryObjectArray("select * from abonentka where tip=0 and dtime_add LIKE '".$kassir->otchet_day."%' ".($kassir->rule_report_view==0?" and admin_add=".$_SESSION['ks']:'')." order by id");
	if(count($abonentka)>0)
		{
		$table="<H1>Отчёт по абонентским начислениям за ".realday($kassir->otchet_day)."<H1>";
		$table.="<TABLE cellspacing=0 cellpadding=0 id=OpSpisok>";
			$table.="<TR>";
			$table.="<TH>№";
			$table.="<TH>Абонент";
			$table.="<TH>Адрес";
			$table.="<TH>Месяц";
			$table.="<TH>Сумма";

		foreach($abonentka as $n=>$ab)
			{
			$abon=$ktv->QueryObjectOne("select * from abonent where id=".$ab->id_abonent);
			$year=explode('-',$ab->month);
			$table.="<TR>";
			$table.="<TD align=right style=border-left-style:solid;".($n<count($abonentka)-1?'':"border-bottom-style:solid;").">".($n+1);
			$table.="<TD".($n<count($abonentka)-1?'':" style=border-bottom-style:solid;").">".$abon->f." ".$abon->i." ".$abon->o;
			$table.="<TD".($n<count($abonentka)-1?'':" style=border-bottom-style:solid;").">".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
			$table.="<TD".($n<count($abonentka)-1?'':" style=border-bottom-style:solid;")." align=right>".fullmonth($year[1])." ".$year[0];
			$table.="<TD style=border-right-style:solid;".($n<count($abonentka)-1?'':"border-bottom-style:solid;")." align=right><B>".$ab->money."&nbsp;</B>";
			}
		$table.="</TABLE>";

		$itog=$ktv->QueryRowOne("select count(id),sum(money) from abonentka where tip=0 and dtime_add LIKE '".$kassir->otchet_day."%' limit 1");

		$table.="<H5><TABLE cellspacing=0 cellpadding=0><TR><TD>Итог: всего начислений <B>".$itog[0]."</B> на сумму <B>".$itog[1]."</B> руб.</TABLE></H5>";
		$table.="<H6><TABLE cellspacing=0 cellpadding=0><TR><TD>Администратор: <B>".$kassir->fio."</B> __________________<TD align=right style=width:200pt;>Дата: ___/___/______г.</TABLE></H6>";

		$doc = new clsMsDocGenerator($pageOrientation='PORTRAIT',    $pageType='A4',    $cssFile='otchet_doc.css',    $topMargin=1.0,    $rightMargin=1.0,    $bottomMargin=1.0,    $leftMargin=1.0);
		$doc->addParagraph($table);
		$doc->output("AbonCalc_".$kassir->otchet_day);
		}
	}
?>
