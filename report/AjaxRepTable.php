<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');

$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);
if($kassir->rule_report_view==0) $rule=" and admin_add=".$_SESSION['ks']; else $rule='';



$today=strftime('%Y-%m-%d',time());
if($_GET['day']) $ktv->Query("update admin set otchet_day='".$_GET['day']."' where id=".$_SESSION['ks']);
else
	if($kassir->otchet_day=='0000-00-00')
		{
		$ktv->Query("update admin set otchet_day='".$today."' where id=".$_SESSION['ks']);
		$_GET['day']=$today;
		}
	else $_GET['day']=$kassir->otchet_day;

if($_GET['day']==$today) $todayText="сегодня"; else $todayText=realday($_GET['day']);




$oplata=$ktv->QueryRowOne("select count(id),sum(money) from oplata where status=1 and dtime_add LIKE '".$_GET['day']."%'".$rule);
$AbZayav=$ktv->QRow("select count(id) from abonent where date_zayav='".$_GET['day']."'".$rule);
$AbPodkl=$ktv->QRow("select count(id) from abonent where date_podkl='".$_GET['day']."'".$rule);
$abon=$ktv->QueryRowOne("select count(id),sum(money) from abonentka where tip=0 and dtime_add LIKE '".$_GET['day']."%'".$rule);
$uslugi=$ktv->QueryRowOne("select count(id),sum(money) from abonentka where tip=1 and dtime_add LIKE '".$_GET['day']."%'".$rule);

$otchet="<TABLE cellspacing=0 cellpadding=0 id=otchet>";
$otchet.="<caption>Отчёт за ".$todayText."</caption>";

$otchet.="<TR><TD>&nbsp;	<TH>количество	<TH>сумма	<TH>печать";		

$print="<A HREF='javascript:' onclick=window.open('/report/PrintOplata.php','','top=30,left=40,height=600,width=700,scrollbars=yes')><IMG SRC='/img/print_browser.gif'></A>&nbsp;";
$print.="<A HREF='/report/PrintWordOplata.php?sid=".time()."'><IMG SRC='/img/print_word.gif'></A>&nbsp;";
//$print.="<A HREF='/report/PrintExcelOplata.php'><IMG SRC='/img/print_excel.gif'></A>";
$otchet.="<TR><TD>Платежи:";
		$otchet.="<TD align=center>".($oplata[0]?"<A HREF='javascript:' onclick=AbonSpisokGet('".$_GET['day']."','Oplata');>".$oplata[0]."</A>":'&nbsp;');
		$otchet.="<TD align=center>".($oplata[1]?$oplata[1]:'&nbsp;');
		$otchet.="<TD>".($oplata[1]?$print:'&nbsp;');

$print="<A HREF='javascript:' onclick=window.open('/report/PrintZayav.php?sid=".time()."','','top=30,left=40,height=600,width=600,scrollbars=yes')><IMG SRC='/img/print_browser.gif'></A>&nbsp;";
$print.="<A HREF='/report/PrintWordZayav.php'><IMG SRC='/img/print_word.gif'></A>&nbsp;";
//$print.="<A HREF=''><IMG SRC='/img/print_excel.gif'></A>";
$otchet.="<TR><TD>Абоненты, подавшие заявку:";
		$otchet.="<TD align=center>".($AbZayav[0]?"<A HREF='javascript:' onclick=AbonSpisokGet('".$_GET['day']."','Zayav');>".$AbZayav[0]."</A>":'&nbsp;');
		$otchet.="<TD>&nbsp;";
		$otchet.="<TD>".($AbZayav[0]?$print:'&nbsp;');

$print="<A HREF='javascript:' onclick=window.open('/report/PrintPodkl.php?sid=".time()."','','top=30,left=40,height=600,width=600,scrollbars=yes')><IMG SRC='/img/print_browser.gif'></A>&nbsp;";
$print.="<A HREF='/report/PrintWordPodkl.php'><IMG SRC='/img/print_word.gif'></A>&nbsp;";
//$print.="<A HREF=''><IMG SRC='/img/print_excel.gif'></A>";
$otchet.="<TR><TD>Подключённые абоненты:";
		$otchet.="<TD align=center>".($AbPodkl[0]?"<A HREF='javascript:' onclick=AbonSpisokGet('".$_GET['day']."','Podkl');>".$AbPodkl[0]."</A>":'&nbsp;');
		$otchet.="<TD>&nbsp;";
		$otchet.="<TD>".($AbPodkl[0]?$print:'&nbsp;');

$print="<A HREF='javascript:' onclick=window.open('/report/PrintAbon.php?sid=".time()."','','top=30,left=40,height=600,width=700,scrollbars=yes')><IMG SRC='/img/print_browser.gif'></A>&nbsp;";
$print.="<A HREF='/report/PrintWordAbon.php'><IMG SRC='/img/print_word.gif'></A>&nbsp;";
//$print.="<A HREF=''><IMG SRC='/img/print_excel.gif'></A>";
$otchet.="<TR><TD>Абонентские начисления:";
		$otchet.="<TD align=center>".($abon[0]?"<A HREF='javascript:' onclick=AbonSpisokGet('".$_GET['day']."','Abon');>".$abon[0]."</A>":'&nbsp;');
		$otchet.="<TD align=center>".($abon[1]?$abon[1]:'&nbsp;');
		$otchet.="<TD>".($abon[0]?$print:'&nbsp;');

$print="<A HREF='javascript:' onclick=window.open('/report/PrintUslugi.php?sid=".time()."','','top=30,left=40,height=600,width=700,scrollbars=yes')><IMG SRC='/img/print_browser.gif'></A>&nbsp;";
$print.="<A HREF='/report/PrintWordUslugi.php'><IMG SRC='/img/print_word.gif'></A>&nbsp;";
//$print.="<A HREF=''><IMG SRC='/img/print_excel.gif'></A>";
$otchet.="<TR><TD>Оказанные услуги:";
		$otchet.="<TD align=center>".($uslugi[0]?"<A HREF='javascript:' onclick=AbonSpisokGet('".$_GET['day']."','Uslugi');>".$uslugi[0]."</A>":'&nbsp;');
		$otchet.="<TD align=center>".($uslugi[1]?$uslugi[1]:'&nbsp;');
		$otchet.="<TD>".($uslugi[0]?$print:'&nbsp;');

$otchet.="</TABLE>";

echo $otchet;
?>
