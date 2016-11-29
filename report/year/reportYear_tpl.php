<?php include('reportYear.php'); ?>
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
	$("#repSpisokGet").load("/report/year/AjaxYearGet<?php echo $_GET['table']; ?>.php?year="+$("#year").val(),yearInit);
	});


function yearInit()
	{
	$("#path IMG:first").remove();
	$("#repSpisok TR").unbind();
	$("#repSpisok TR").bind({
		mouseover:	function(){ $(this).css("background-color","#EFE"); },
		mouseout:	function(){ $(this).css("background-color","#DDF5E2"); }
		});
	ktvinit();
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

		$("#repSpisokTable").load("/report/year/AjaxYearGet<?php echo $_GET['table']; ?>Table.php?year="+$("#year").val()+"&mon="+$("#mon").val()+"&admin="+ADMIN+"&oplata="+OPLATA,function(){ $("#path IMG:first").remove(); });
		return false;
		});

	}
//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/otchet_small.gif><P>Вывод и печать отчётов</P></DIV>

<DIV id=path><A HREF="/">Главная</A> / Отчёты / <?php echo $_GET['year']; ?></DIV>

<INPUT TYPE=hidden id=year value='<?php echo $_GET['year']; ?>'>

<?php echo $calend; ?>

<DIV id=repLink>
	<A HREF="/report/<?php echo $_GET['year']; ?>/Oplata" class=repLink<?php if($_GET['table']=='Oplata') echo 'Sel'; ?>>Платежи</A>
	<A HREF="/report/<?php echo $_GET['year']; ?>/Zayav" class=repLink<?php if($_GET['table']=='Zayav') echo 'Sel'; ?>>Заявки на подключение</A>
	<A HREF="/report/<?php echo $_GET['year']; ?>/Podkl"	 class=repLink<?php if($_GET['table']=='Podkl') echo 'Sel'; ?>>Подключённые абоненты</A>
	<A HREF="/report/<?php echo $_GET['year']; ?>/Abon"	 class=repLink<?php if($_GET['table']=='Abon') echo 'Sel'; ?>>Абонентские начисления</A>
	<A HREF="/report/<?php echo $_GET['year']; ?>/Uslugi" class=repLink<?php if($_GET['table']=='Uslugi') echo 'Sel'; ?>>Оказанные услуги</A>
</DIV>

<DIV id=repSpisokGet></DIV>



</TABLE></BODY></HTML>
