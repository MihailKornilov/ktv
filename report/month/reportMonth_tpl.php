<?php include('reportMonth.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Отчёт за месяц</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/report/report.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{
	$("#path").append("<IMG SRC=/img/ajax-loader.gif>");
	$("#repSpisokGet").load("/report/month/AjaxMonthGet<?php echo $_GET['table']; ?>.php?year="+$("#year").val()+"&mon="+$("#mon").val(),monthInit);

	$("#repCalendar A:eq(1)").click(function(){
		$("#repCalendar DL:first").css("top",13-$("#repCalendar INPUT:first").val()*16);
		$("#CalendMon").show(100);
		});
	$("#repCalendar TD:eq(2) A:last").click(function(){ $("#CalendYear").show(100); });
	});


function monthInit()
	{
	$("#path IMG:first").remove();
	$("#repSpisok TR").unbind();
	$("#repSpisok TR").bind({
		mouseover:	function(){ $(this).css("background-color","#EFE"); },
		mouseout:	function(){ $(this).css("background-color","#DDF5E2"); }
		});
	ktvinit();

	$("BODY").click(function(){
		if($("#CalendMon").is(":visible")) $("#CalendMon").hide();
		if($("#CalendYear").is(":visible")) $("#CalendYear").hide();
		});


	$("#repRow").click(function(){
		$("#path").append("<IMG SRC=/img/ajax-loader.gif>");

		ADMIN="0";
		INPUT=$("#repAdmin INPUT");
		var len=INPUT.length;
		if(len>0)
			for(var n=0;n<len;n++)
				if(INPUT.eq(n).val()==1)
					ADMIN+=","+INPUT.eq(n).attr("name");

		OPLATA="0";
		INPUT=$("#repOplata INPUT");
		len=INPUT.length;
		if(len>0)
			for(var n=0;n<len;n++)
				if(INPUT.eq(n).val()==1)
					OPLATA+=","+INPUT.eq(n).attr("name");

		$("#repSpisokTable").load("/report/month/AjaxMonthGet<?php echo $_GET['table']; ?>Table.php?year="+$("#year").val()+"&mon="+$("#mon").val()+"&admin="+ADMIN+"&oplata="+OPLATA,function(){ $("#path IMG:first").remove(); });
		return false;
		});

	}
/*
function GetTable(e,table)
	{	
	$("#repLink A").attr("class","repLink");
	$(e.target).attr("class","repLinkSel");
	$("#path").append("<IMG SRC=/img/ajax-loader.gif>");
	$("#repSpisokGet").load("/report/month/AjaxMonthGet"+table+".php?year="+$("#year").val()+"&mon="+$("#mon").val(),monthInit);
	}
*/
//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/otchet_small.gif><P>Вывод и печать отчётов</P></DIV>

<DIV id=path>
	<A HREF="/">Главная</A> / 
	Отчёты / 
	<A HREF="/report/2010"><?php echo $_GET['year']; ?></A> / 
	<?php echo fullmonth($_GET['mon']); ?>
</DIV>

<INPUT TYPE=hidden id=year value='<?php echo $_GET['year']; ?>'>
<INPUT TYPE=hidden id=mon value='<?php echo abs($_GET['mon']); ?>'>

<?php echo $calend; ?>

<DIV id=repLink>
	<A HREF="/report/<?php echo $_GET['year']; ?>/<?php echo abs($_GET['mon']); ?>/Oplata" class=repLink<?php if($_GET['table']=='Oplata') echo 'Sel'; ?>>Платежи</A>
	<A HREF="/report/<?php echo $_GET['year']; ?>/<?php echo abs($_GET['mon']); ?>/Zayav" class=repLink<?php if($_GET['table']=='Zayav') echo 'Sel'; ?>>Заявки на подключение</A>
	<A HREF="/report/<?php echo $_GET['year']; ?>/<?php echo abs($_GET['mon']); ?>/Podkl"	 class=repLink<?php if($_GET['table']=='Podkl') echo 'Sel'; ?>>Подключённые абоненты</A>
	<A HREF="/report/<?php echo $_GET['year']; ?>/<?php echo abs($_GET['mon']); ?>/Abon"	 class=repLink<?php if($_GET['table']=='Abon') echo 'Sel'; ?>>Абонентские начисления</A>
	<A HREF="/report/<?php echo $_GET['year']; ?>/<?php echo abs($_GET['mon']); ?>/Uslugi" class=repLink<?php if($_GET['table']=='Uslugi') echo 'Sel'; ?>>Оказанные услуги</A>
</DIV>

<DIV id=repSpisokGet></DIV>



</TABLE></BODY></HTML>
