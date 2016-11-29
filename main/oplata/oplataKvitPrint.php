<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE></TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="../../include/style_print.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
<?php
include_once('../../include/conf.php');
session_name($session);
session_start();
if($_SESSION['ks'])
	{
	include('../../include/functions_date.php');
	include('../../include/FUNCTIONS.php');
	include_once('../../include/class_MysqlDB.php');
	
	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

	$oplata=$ktv->QueryObjectOne("select * from oplata where status=1 and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
	if($oplata->id)
		{
		$abon=$ktv->QueryObjectOne("select * from abonent where id=".$oplata->id_abonent);
		$kassir=$ktv->QRow("select fio from admin where id=".$oplata->admin_add);
		echo "<DIV id=KvitOplata>";
		echo "<TABLE cellpadding=0 cellspacing=0>";
		echo "<TR><TD><H3>Кабельное телевидение</H3><TD align=right><H3>OOO \"НТК\"</H3>";
		echo "<TR><TD colspan=2><H1>Квитанция об оплате №<B>".$oplata->id."</B></H1>";
		echo "<TR><TD colspan=2>Абонент: ".$abon->f." ".$abon->i." ".$abon->o;
		echo "<TR><TD colspan=2>Адрес: ".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
		echo "<TR><TD><H4>Сумма: <B>".$oplata->money."</B> руб.</H4><TD align=right>Дата: ".Data($oplata->dtime_add)."";
		echo "<TR><TD colspan=2><HR>";
		echo "<TR><TD colspan=2><H5>Принял кассир: <B>".$kassir."</B></H5>";
		echo "<TR><TD colspan=2 align=right><H5>Подпись ___________________</H5>";
		echo "<TR><TD colspan=2><H5>Телефон для справок: <B>654-321</B></H5>";
		echo "</TABLE>";
		echo "</DIV>";
			
		echo "<DIV id=KvitOplataLine>&nbsp;</DIV>";

		echo "<DIV id=KvitOplata>";
		echo "<TABLE cellpadding=0 cellspacing=0>";
		echo "<TR><TD><H3>Кабельное телевидение</H3><TD align=right><H3>OOO \"НТК\"</H3>";
		echo "<TR><TD colspan=2><H1>Квитанция об оплате №<B>".$oplata->id."</B></H1>";
		echo "<TR><TD colspan=2>Абонент: ".$abon->f." ".$abon->i." ".$abon->o;
		echo "<TR><TD colspan=2>Адрес: ".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
		echo "<TR><TD><H4>Сумма: <B>".$oplata->money."</B> руб.</H4><TD align=right>Дата: ".Data($oplata->dtime_add)."";
		echo "<TR><TD colspan=2><HR>";
		echo "<TR><TD colspan=2><H5>Принял кассир: <B>".$kassir."</B></H5>";
		echo "</TABLE>";
		echo "</DIV>";
			
		echo "<BR><A HREF='javascript:' onclick=this.style.display='none';window.print();><IMG SRC='/img/printer.gif'></A>";
		}
	}
?>
</BODY>
</HTML>
