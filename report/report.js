$(document).ready(function()
	{	
	$("#repCalSet").load("/report/AjaxRepCalendar.php?id=0",repInit);
	$("#repTable").load("/report/AjaxRepTable.php?id=0");

	$("BODY").click(function(){
		if($("#CalendMon").is(":visible")) $("#CalendMon").hide();
		if($("#CalendYear").is(":visible")) $("#CalendYear").hide();
		});
	});

function repInit()
	{
	$("#repCalendar A:eq(1)").click(function(){
		$("#repCalendar DL:first").css("top",13-$("#repCalendar INPUT:first").val()*16);
		$("#CalendMon").show(100);
		});
	$("#repCalendar TD:eq(2) A:last").click(function(){ $("#CalendYear").show(100); });
	}

function repMonNext(mon)
	{
	$("#repCalSet").load("/report/AjaxRepCalendar.php?mon="+mon,repInit);
	}

function ReportGet(day,e)
	{
	$("#repTable").load("/report/AjaxRepTable.php?day="+day,function(){
		$("#repCalendar U A").attr("class","dayB");
		$(e).attr("class","dayBsel");
		});
	}

function AbonSpisokGet(day,tip)
	{
	$("#repAbon").load("/report/AjaxRepAbon"+tip+".php?day="+day+"&tip="+tip,ktvinit);
	}
