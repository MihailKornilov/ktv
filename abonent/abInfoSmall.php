<?php
if($abonent->tel_dom and $abonent->tel_sot)
	$telefon=$abonent->tel_dom.", ".$abonent->tel_sot;
else
	{
	if($abonent->tel_dom) $telefon=$abonent->tel_dom;
	if($abonent->tel_sot) $telefon=$abonent->tel_sot;
	}

if($telefon) $telefon="<TR><TH>Телефоны:<TD>".$telefon;


if($abonent->status_edit!='0000-00-00') $statusEdit="(<A HREF='javascript:' onclick=Calendar('".$abonent->status_edit."',event,'abSmallStatusSet');>".realday($abonent->status_edit)."</A>)";

if(strlen($abonent->prim)>0)
	{
	$primImg="<FONT><IMG SRC='/img/prim.gif'></FONT>";
	$primTxt="<TR><TD colspan=2 align=right><TEXTAREA>".$abonent->prim."</TEXTAREA>";
	}

if($ktv->QRow("select count(id) from remont where id_abonent=".$abonent->id." and status=2")>0) $primImg.="<FONT><A HREF='/ab".$abonent->id."/remont'><IMG SRC='/img/remont_clock.gif'></A></FONT>";


////// ------ ВЫЧИСЛЕНИЕ БАЛАНСА АБОНЕНТА --------- /////////////
$abMoney=$ktv->QRow("select sum(money) from abonentka where id_abonent=".$abonent->id);
$abOplata=$ktv->QRow("select sum(money) from oplata where status!=0 and id_abonent=".$abonent->id);
$abonent->balans=$abOplata-$abMoney;
$ktv->Query("update abonent set balans=".$abonent->balans." where id=".$abonent->id);
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{	
	$("#abInfoSmall FONT > IMG").click(function(){	$("#abInfoSmall TEXTAREA").slideToggle("fast"); });
	});

function abSmallStatus(id,OBJ)
	{
	H1=$("#abInfoSmall H1");
	if(H1.eq(0).text()!=id)
		{
		I=$("#abInfoSmall I").eq(0);
		I.html("<IMG SRC=/img/ajax-loader.gif>");
		I.load("/abonent/AjaxStatusSet.php?status="+id+"&abon="+H1.eq(1).text());
		H1.eq(0).text(id);
		$("#StatusSelect CODE").css("background",OBJ.style.background).find("A").html(OBJ.innerHTML);
		}
	}

////////////////////////// ---- УСТАНОВКА ТОЛЬКО ДАТЫ ИЗМЕНЕНИЯ СТАТУСА ----------- /////////////////////////////////
function abSmallStatusSet(day)
	{
	CalendarClose();
	I=$("#abInfoSmall I").eq(0);
	I.html("<IMG SRC=/img/ajax-loader.gif>");
	I.load("/abonent/AjaxStatusDaySet.php?day="+day+"&abon="+$("#abInfoSmall H1").eq(1).text());
	}
//-->
</SCRIPT>

<DIV id=abInfoSmall>
	<TABLE cellspacing=0 cellpadding=0>
	<TR><TH>ФИО:		<TD width=350><?php echo $abonent->f." ".$abonent->i." ".$abonent->o; ?>
	<TR><TH>Адрес:		<TD><?php echo AdresSmall(0,$abonent->adres_gorod_name,$abonent->adres_ulica_name,$abonent->adres_dom_num,$abonent->adres_kv); ?>
	<?php echo $telefon; ?>
	<TR><TH>Баланс:		<TD id=<?php echo ($abonent->balans>=0?'bPlus':'bMinus'); ?>><B><?php echo $abonent->balans; ?></B>
	<TR><TH>Статус:		<TD><?php echo $primImg.StatusSelect($abonent->status,'abSmallStatus',1); ?><I><?php echo $statusEdit; ?></I>
												
	<?php echo $primTxt; ?>
	</TABLE>
	<H1><?php echo $abonent->status; ?></H1>
	<H1><?php echo $abonent->id; ?></H1>
</DIV>