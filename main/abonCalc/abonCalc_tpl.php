<?php include_once('abonCalc.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Начисление абонентской платы</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/main/abonCalc/abonCalc.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{
	AbonCalcGoPrint();

	$("#AbonCalcMon DL:eq(0)").click(function(e){
		var DD=$(this).find("DD");
		if(DD.is(":hidden"))
			{
			DD.find("A").css("font-weight","normal");
			DD.eq($("#mon").val()-1).find("A").css("font-weight","bold");
			DD.slideDown("fast");
			}
		else
			{
			var month = {"январь":1,"февраль":2,"март":3,"апрель":4,"май":5,"июнь":6,"июль":7,"август":8,"сентябрь":9,"октябрь":10,"ноябрь":11,"декабрь":12};
			var mon=$(e.target).text();
			$("#mon").val(month[mon]);
			$(this).find("DT:eq(0)").text(mon);
			AbonCalcGoPrint();
			}
		});
	
	$("#AbonCalcMon DL:eq(1)").click(function(e){
		var DD=$(this).find("DD");
		if(DD.is(":hidden"))
			{
			DD.find("A").css("font-weight","normal");
			for(var n=0;n<DD.length;n++)
				{
				var A=DD.eq(n).find("A");
				if(A.text()==$("#year").val()) A.css("font-weight","bold");
				}
			DD.slideDown("fast");
			}
		else
			{
			var year=$(e.target).text();
			$("#year").val(year);
			$(this).find("DT:eq(0)").text(year);
			AbonCalcGoPrint();
			}
		});

	$("#AbonCalcMon FONT").click(function(e){
		var month = {1:'январь',2:'февраль',3:'март',4:'апрель',5:'май',6:'июнь',7:'июль',8:'август',9:'сентябрь',10:'октябрь',11:'ноябрь',12:'декабрь'};
		var nMon=$("#mon").val();
		if($(e.target).text()=="»") nMon++; else nMon--;
		var DT=$("#AbonCalcMon DT");
		var year=$("#year").val();
		if(nMon==0) { nMon=12; year--; }
		if(nMon==13) { nMon=1; year++; }
		$("#year").val(year);
		DT.eq(1).text(year);	
		DT.eq(0).text(month[nMon]);
		$("#mon").val(nMon);
		AbonCalcGoPrint();
		});
	
	$("#calcGorod").click(AbonCalcGoPrint);

	$("BODY").click(function(){
		var DD;
		for(var n=0;n<=1;n++)
			{
			DD=$("#AbonCalcMon DL:eq("+n+") DD");
			if(DD.is(":visible")) DD.hide();
			}
		});

	});

function GorodSpGet()
	{
	var DD=$("#calcGorod DD");
	var len=DD.length;
	var SP='0';
	for(var n=0;n<len;n++)
		if(DD.eq(n).find("INPUT:last").val()==1)
			SP+=","+DD.eq(n).find("INPUT:first").val();
	return SP;
	}


function AbonCalcGoPrint()
	{
	var mon=$("#mon").val();
	var year=$("#year").val();
	$("#AbonCalcGo").load("/main/abonCalc/AjaxAbonCalcGo.php?mon="+mon+"&year="+year+"&gorod="+GorodSpGet(),function(){
		var calc=$("#calc").val();
		if(calc) findSpisokGet('',1,calc);

		$("#AbonCalcGo BUTTON:first").click(function(){
			iCalcProcess.location.href='/main/abonCalc/abonCalcProcess.php?month='+$("#AbonGoCalc").val()+"&gorod="+GorodSpGet();
			$("#AbonCalcMon").html('<H5><B>Внимание!</B><BR>Не покидайте эту страницу<BR>до окончания процесса начисления.</H5>');
			$("#AbSpisok").html('');
			$("#AbonCalcGo TR")
				.eq(1).remove().end()
				.eq(2).remove().end()
				.eq(3).remove().end()
				.eq(4).remove().end()
				.eq(5).find("TH:first").html("Ожидайте.<BR>Производится начисление абонентской платы. <IMG SRC=/img/ajax-loader.gif>");
			});
		});
	}


function findSpisokGet(sort,page,calc)
	{
	if(calc) $("#calc").val(calc);
	var URL="&month="+$("#year").val()+"-"+$("#mon").val()+"-01";
	if(sort) URL+="&abcalc_sort="+sort;
	if(page) URL+="&abcalc_page="+page;
	$("#AbSpisok").load("/main/abonCalc/AjaxAbonentSpisok.php?gorod="+GorodSpGet()+"&calc="+$("#calc").val()+URL,ktvinit);
	}
//-->
</SCRIPT>

</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/abon_calc_small.gif><P>Начисление абонентской платы</P></DIV>


<DIV id=AbonCalcMon>
<H1>&nbsp;</H1>
<H2>

	<DIV class=row>
		<P>Месяц, за который будет<BR>начисляться абонентская плата:</P>
		<H4><TABLE cellspacing=0 cellpadding=0><TR>
			<TD><FONT>«</FONT>
			<TD width=83><DIV id=abSelectData><DL style=width:81px;><?php echo $abSelectMon; ?></DL></DIV>
			<TD width=47><DIV id=abSelectData><DL style=width:45px;><?php echo $abSelectYear; ?></DL></DIV>
			<TD><FONT>»</FONT>
		</TABLE></H4>
	</DIV>

	<DIV class=row><P>Населённые пункты:</P><?php echo $punkt; ?></DIV>
	<DIV style=clear:both;></DIV>

</H2>
<H6>&nbsp;</H6>
<INPUT TYPE="hidden" id=mon value="<?php echo $jetzMon; ?>">
<INPUT TYPE="hidden" id=year value="<?php echo $jetzYear; ?>">
<INPUT TYPE="hidden" id=calc>
</DIV>




<DIV id=AbonCalcGo></DIV>

<DIV id=AbSpisok></DIV>














</TABLE></BODY></HTML>
