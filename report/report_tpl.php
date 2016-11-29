<?php include('report.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Отчёты</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/report/report.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{
	$("#path").append("<IMG SRC=/img/ajax-loader.gif>");
	$("#repCalSet").load("/report/AjaxRepCalendar.php?id=0",repInit);
	$("#repTable").load("/report/AjaxRepTable.php?id=0");

	$("BODY").click(function(){
		if($("#CalendMon").is(":visible")) $("#CalendMon").hide();
		if($("#CalendYear").is(":visible")) $("#CalendYear").hide();
		});
	});

function repInit()
	{
	$("#path IMG:first").remove();
	$("#repCalendar A:eq(1)").click(function(){
		$("#repCalendar DL:first").css("top",13-$("#repCalendar INPUT:first").val()*16);
		$("#CalendMon").show(100);
		});
	$("#repCalendar TD:eq(2) A:last").click(function(){ $("#CalendYear").show(100); });
	
	}

function repMonNext(mon)
	{
	$("#path").append("<IMG SRC=/img/ajax-loader.gif>");
	$("#repCalSet").load("/report/AjaxRepCalendar.php?mon="+mon,repInit);
	}

function ReportGet(day,e)
	{
	$("#path").append("<IMG SRC=/img/ajax-loader.gif>");
	$("#repTable").load("/report/AjaxRepTable.php?day="+day,function(){
		$("#path IMG:first").remove();
		$("#repCalendar U A").attr("class","dayB");
		$(e).attr("class","dayBsel");
		var repDay=day.split(/-/);
		var PATH="<A HREF='/'>Главная</A> / Отчёты / ";
		PATH+="<A HREF='/report/"+repDay[0]+"'>"+repDay[0]+"</A> / ";
		PATH+="<A HREF='/report/"+repDay[0]+"/"+repDay[1]+"'>"+getMonRus[Math.abs(repDay[1])]+"</A> / ";
		PATH+=Math.abs(repDay[2]);
		$("#path").html(PATH);
		});
	}

function AbonSpisokGet(day,tip)
	{
	$("#repAbon").load("/report/AjaxRepAbon"+tip+".php?day="+day+"&tip="+tip,ktvinit);
	}
//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/otchet_small.gif><P>Вывод и печать отчётов</P></DIV>

<DIV id=path>
	<A HREF="/">Главная</A> / 
	Отчёты / 
	<A HREF="/report/<?php echo $repDay[0]; ?>"><?php echo $repDay[0]; ?></A> / 
	<A HREF="/report/<?php echo $repDay[0]; ?>/<?php echo $repDay[1]; ?>"><?php echo fullmonth($repDay[1]); ?></A> / 
	<?php echo $repDay[2]; ?>
</DIV>

<DIV class=row>
	<DIV id=repTable></DIV>
	<DIV id=repCalSet></DIV>
</DIV>

<DIV class=row id=repAbon></DIV>

</TABLE></BODY></HTML>
