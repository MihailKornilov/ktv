<?php
include_once('../include/conf.php');
session_name($session);
session_start();
include('../include/functions_date.php');
include('../include/FUNCTIONS.php');
include_once('../include/class_MysqlDB.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE></TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="../include/style_print.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<?php
if($_SESSION['ks'])
	{
	$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);

	$abonentka=$ktv->QueryObjectArray("select * from abonentka where tip=0 and dtime_add LIKE '".$kassir->otchet_day."%' ".($kassir->rule_report_view==0?" and admin_add=".$_SESSION['ks']:'')." order by id");
	if(count($abonentka)>0)
		{
		echo "<A HREF='javascript:' id=Print onclick=this.style.display='none';window.print();><IMG SRC='../img/printer.gif'></A>";

		echo "<H2>Отчёт по абонентским начислениям за ".realday($kassir->otchet_day)."</H2>";
		echo "<CENTER><TABLE cellspacing=0 cellpadding=0 id=spisok width=650>";
			echo "<TH>№";
			echo "<TH>Абонент";
			echo "<TH>Адрес";
			echo "<TH>Месяц";
			echo "<TH>Сумма";

		foreach($abonentka as $n=>$ab)
			{
			$abon=$ktv->QueryObjectOne("select * from abonent where id=".$ab->id_abonent);
			$year=explode('-',$ab->month);
			echo "<TR>";
			echo "<TD".(count($abonentka)==$n+1?" style='border-bottom:#000 solid 1px;'":'')." align=right>".($n+1);
			echo "<TD".(count($abonentka)==$n+1?" style='border-bottom:#000 solid 1px;'":'').">".$abon->f." ".$abon->i." ".$abon->o;
			echo "<TD".(count($abonentka)==$n+1?" style='border-bottom:#000 solid 1px;'":'').">".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
			echo "<TD".(count($abonentka)==$n+1?" style='border-bottom:#000 solid 1px;'":'')." align=right>".fullmonth($year[1])." ".$year[0];
			echo "<TD style='".(count($abonentka)==$n+1?"border-bottom:#000 solid 1px;":'')."border-right:#000 solid 1px;' align=right><B>".$ab->money."&nbsp;</B>";
			}
		echo "</TABLE></CENTER>";
		$itog=$ktv->QueryRowOne("select count(id),sum(money) from abonentka where tip=0 and dtime_add LIKE '".$kassir->otchet_day."%' limit 1");
		echo "<CENTER><TABLE width=650><TR><TD><P>Итог: всего начислений <B>".$itog[0]."</B> на сумму <B>".$itog[1]."</B> руб.</P></TABLE></CENTER>";
		
		echo "<CENTER><TABLE width=650><TR><TD><DIV>Администратор: <B>".$kassir->fio."</B> __________________</DIV><TD align=right>Дата: ___/___/______г.</TABLE></CENTER>";
		}
	}
?>
</BODY>
</HTML>
