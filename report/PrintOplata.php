<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE></TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="../include/style_print.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<?php
include_once('../include/conf.php');
session_name($session);
session_start();
if($_SESSION['ks'])
	{
	include('../include/functions_date.php');
	include('../include/FUNCTIONS.php');
	include_once('../include/class_MysqlDB.php');

	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

	$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);
	$oplata=$ktv->QueryObjectArray("select * from oplata where status=1 and dtime_add LIKE '".$kassir->otchet_day."%' ".($kassir->rule_report_view==0?" and admin_add=".$_SESSION['ks']:'')." order by id");
	if(count($oplata)>0)
		{
		echo "<A HREF='javascript:' id=Print onclick=this.style.display='none';window.print();><IMG SRC='../img/printer.gif'></A>";

		echo "<H2>Отчёт по платежам за ".realday($kassir->otchet_day)."</H2>";
		echo "<CENTER><TABLE cellspacing=0 cellpadding=0 width=650 id=Spisok>";
			echo "<TH>№";
			echo "<TH>Абонент";
			echo "<TH>Адрес";
			echo "<TH>Сумма";
			echo "<TH>Вид";
			
		$tipName=$ktv->QueryPtPArray("select id,name from oplata_tip order by id");

		foreach($oplata as $n=>$op)
			{
			$abon=$ktv->QueryObjectOne("select * from abonent where id=".$op->id_abonent);
			echo "<TR>";
			echo "<TD align=right".(count($oplata)==$n+1?" style='border-bottom:#000 solid 1px;'":'').">".($n+1);
			echo "<TD".(count($oplata)==$n+1?" style='border-bottom:#000 solid 1px;'":'').">".$abon->f." ".$abon->i." ".$abon->o;
			echo "<TD".(count($oplata)==$n+1?" style='border-bottom:#000 solid 1px;'":'').">".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
			echo "<TD align=right".(count($oplata)==$n+1?" style='border-bottom:#000 solid 1px;'":'')."><B>".$op->money."&nbsp;</B>";
			echo "<TD align=center style='".(count($oplata)==$n+1?"border-bottom:#000 solid 1px;":'')."border-right:#000 solid 1px;'>".$tipName[$op->tip];
			}
		echo "</TABLE></CENTER>";
		$itog=$oplata=$ktv->QueryRowOne("select count(id),sum(money) from oplata where status=1 and dtime_add LIKE '".$kassir->otchet_day."%' limit 1");
		echo "<CENTER><TABLE width=650><TR><TD><P>Итог: всего платежей <B>".$itog[0]."</B> на сумму <B>".$itog[1]."</B> руб.</P></TABLE></CENTER>";

		echo "<CENTER><TABLE width=650><TR><TD><DIV>Администратор: <B>".$kassir->fio."</B> __________________</DIV><TD align=right>Дата: ___/___/______г.</TABLE></CENTER>";
		}
	}
?>
</BODY>
</HTML>
