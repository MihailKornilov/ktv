<?php
header("Content-type: text/html; charset=WINDOWS-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
session_name($session);
session_start();

if($_SESSION['ks'])
	{
	include_once('../../include/class_MysqlDB.php');
	include_once('../../include/functions_date.php');
	include_once('../../include/FUNCTIONS.php');
	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

	$ktv->Query("update abonent set abonentka_calc_month=0");
	$ktv->Query("update abonentka,abonent set abonent.abonentka_calc_month=1 where abonentka.id_abonent=abonent.id and abonentka.month='".$_GET['year']."-".$_GET['mon']."-01'");

	$status=$ktv->QueryPtPArray("select id,abon_calc from abonent_status order by id");
	$QueryCalc="abonentka_calc_month=0 and abonentka_sum>0 and abonentka_calc=1 and status in (0";
	if(count($status)>0) foreach($status as $id=>$st) if($st==1) $QueryCalc.=",".$id;
	$QueryCalc.=")";

	$QueryNoCalc="abonentka_calc_month=0 and (abonentka_sum=0 or abonentka_calc=0 or status in (0";
	if(count($status)>0) foreach($status as $id=>$st) if($st==0) $QueryNoCalc.=",".$id;
	$QueryNoCalc.="))";


	$SumCalc=$ktv->QueryRowOne("select count(id),sum(abonentka_sum) from abonent where adres_gorod in (".$_GET['gorod'].") and ".$QueryCalc);
	$CountYesCalc=$ktv->QRow("select count(id) from abonent where adres_gorod in (".$_GET['gorod'].") and abonentka_calc_month=1");
	$CountNoCalc=$ktv->QRow("select count(id) from abonent where adres_gorod in (".$_GET['gorod'].") and ".$QueryNoCalc);
	$AbonLeft.="<TABLE cellpadding=0 cellspacing=0>";
		$AbonLeft.="<TR><TD colspan=2><H1>Абонентская плата за <B>".fullmonth($_GET['mon'])." ".$_GET['year']."</B> г.</H1>";
		$AbonLeft.="<TR><TD width=290><P>Количество абонентов к начислению:<TD width=120>".($SumCalc[0]>0?"<A HREF='javascript:' onclick=findSpisokGet('',1,'calcGo');><B>".$SumCalc[0]."</B></A>":"<B>0</B>");
		if($SumCalc[0]>0)
			{
			$AbonLeft.="<TR><TD><P>Общая сумма:<TD><B>".$SumCalc[1]."</B> руб.";
			$AbonLeft.="<TR><TD colspan=2><H4><BUTTON>произвести начисление</BUTTON></H4>";
			}
		$AbonLeft.="<TR><TH colspan=2>Абоненты, которым начисление уже произведено:&nbsp;&nbsp;".($CountYesCalc?"<A HREF='javascript:' onclick=findSpisokGet('',1,'calcYes');>".$CountYesCalc."</A>":'0');
		$AbonLeft.="<TR><TH colspan=2>Абоненты, которым не производится начисление:&nbsp;&nbsp;&nbsp;".($CountNoCalc?"<A HREF='javascript:' onclick=findSpisokGet('',1,'calcNo');>".$CountNoCalc."</A>":'0');
	$AbonLeft.="</TABLE>";
	$AbonLeft.="<INPUT TYPE=hidden id=AbonGoCalc value='".$_GET['year']."-".$_GET['mon']."-01'>";
	$AbonLeft.="<IFRAME src='' frameborder=0 name=iCalcProcess></IFRAME>";

	echo $AbonLeft;
	}
?>