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

	$zayav=$ktv->QueryObjectArray("select * from abonent abonent where date_zayav='".$kassir->otchet_day."' ".($kassir->rule_report_view==0?" and admin_add=".$_SESSION['ks']:'')." order by id");
	if(count($zayav)>0)
		{
		echo "<A HREF='javascript:' id=Print onclick=this.style.display='none';window.print();><IMG SRC='../img/printer.gif'></A>";

		echo "<H2>Отчёт по абонентам, подавших заявку ".realday($kassir->otchet_day)."</H2>";
		echo "<CENTER><TABLE cellspacing=0 cellpadding=0 width=500 id=Spisok>";
			echo "<TH>№";
			echo "<TH>Абонент";
			echo "<TH>Адрес";

		foreach($zayav as $n=>$z)
			{
			echo "<TR>";
			echo "<TD align=right".(count($zayav)==$n+1?" style='border-bottom:#000 solid 1px;'":'').">".($n+1);
			echo "<TD".(count($zayav)==$n+1?" style='border-bottom:#000 solid 1px;'":'').">".$z->f." ".$z->i." ".$z->o;
			echo "<TD style='".(count($zayav)==$n+1?"border-bottom:#000 solid 1px;":'')."border-right:#000 solid 1px;'>".AdresSmall(0,$z->adres_gorod_name,$z->adres_ulica_name,$z->adres_dom_num,$z->adres_kv);
			}
		echo "</TABLE></CENTER>";

		echo "<BR><BR>";
		echo "<CENTER><TABLE width=500><TR><TD><DIV>Администратор: <B>".$kassir->fio."</B> __________________</DIV><TD align=right>Дата: ___/___/______г.</TABLE></CENTER>";
		}
	}
?>
</BODY>
</HTML>
