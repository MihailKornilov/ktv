$(document).ready(ktvinit);

function ktvinit()
	{	
	// ----------------------- ��������� background � TR #spisok -----------------------
	var BG;

	$("#spisok TR").unbind();
	$("#spisok TR").bind({
		mouseover:	function(){BG=$(this).css("background-color"); $(this).css("background-color", "#F3FFF3");},
		mouseout:	function(){$(this).css("background-color",BG);}
		});

	$("#abSelectUslugi FONT:first").unbind();
	$("#abSelectUslugi FONT:first").bind('click',function(){
		if($("#abSelectUslugi DL:first").is(":hidden")) $("#abSelectUslugi DL:first").slideDown("fast");
		return false;
		});

	$("#mySel DT").unbind();
	$("#mySel DT").bind('click',function(){
		$("#mySel DD").slideDown("fast");
		return false;
		});

	//----------------------- ��������  ��������  ����  ��  ��������� -------------------------
	$("#StatusSelect CODE").unbind();
	$("#StatusSelect CODE").bind('click',function(){
		$("#StatusSelect DL:first").slideDown("fast");
		return false;
		});

	$("BODY").unbind();
	$("BODY").bind('click',function(){
		if($("#StatusSelect DL:first").is(":visible")) $("#StatusSelect DL:first").hide(); // ������� ���� ��������
		for(var n=0;n<=4;n++) if($("#Adres DL").eq(n).is(":visible")) $("#Adres DL").eq(n).hide(); // ������ � ������
		if($("#mySel DD:first").is(":visible")) $("#mySel DD").hide();
		if($("#abSelectUslugi DL:first").is(":visible")) $("#abSelectUslugi DL").hide();
		});
	
	//----------------------- ���������� ���������� -------------------------
	$("SPAN.check").unbind();
	$("SPAN.check").bind('click',function(e){
		var VAL=($(e.target).attr("class")=='check0')?1:0;
		$(e.target).attr("class","check"+VAL);
		$(e.target).next().val(VAL);
		});
	};

function findPageSet(e)
	{
	var page=$("#findPage").val();
	var max=Math.abs($("#numbers EM:first").text());
	var reg = /^[0-9]+$/;
	
	if(reg.exec(page)==null)
		ErrorView('����� �������� ����� �����������.',e);
	else
		if(page==0 || page>max)
			ErrorView('���������� �������� ��������: <B>1-'+max+'</B>.',e);
		else findSpisokGet('',page);
	return false;
	}

function imgCheckValue(IMG)
	{
	var arr = IMG.split(/check_/);
	var arr1 = arr[1].split(/\./);
	return arr1[0];
	}

function ErrorView(msg,e)
	{
	if(!$("#errorView").text())
		{
		e=e || window.event; 
		$("BODY").append("<DIV></DIV>");
		$("DIV:last").attr("id","errorView");
		ERR=$("#errorView");
		ERR.append("<P></P>")
				.find("P").html("<B>������:</B> "+msg)
				.end()
				.css("top",e.clientY+document.body.scrollTop+3)
				.css("left",e.clientX+document.body.scrollLeft+5)
				.show("fast");
		return false;
		}
	}
function ErrorHide() { $("#errorView").fadeOut(400,function(){$(this).remove();}); }




















// ------============== ��������� =============-----------------///////////////////////////////////////////////////////////////////
var getMon = {'Jan':1,'Feb':2,'Mar':3,'Apr':4,'May':5,'Jun':6,'Jul':7,'Aug':8,'Sep':9,'Oct':10,'Nov':11,'Dec':12};
var getMonRus = {1:'������',2:'�������',3:'����',4:'������',5:'���',6:'����',7:'����',8:'������',9:'��������',10:'�������',11:'������',12:'�������'};
var getMonRus1 = {'Jan':'������','Feb':'�������','Mar':'�����','Apr':'������','May':'���','Jun':'����','Jul':'����','Aug':'�������','Sep':'��������','Oct':'�������','Nov':'������','Dec':'�������'};
var getMonRus2 = {1:'������',2:'�������',3:'�����',4:'������',5:'���',6:'����',7:'����',8:'�������',9:'��������',10:'�������',11:'������',12:'�������'}
var getMonRus3 = {1:'���.',2:'���.',3:'���.',4:'���.',5:'���',6:'���.',7:'���.',8:'���.',9:'���.',10:'���.',11:'���.',12:'���.'}
var getMyWeek = { 'Mon':'��','Tue':'��','Wed':'��','Thu':'��','Fri':'��','Sat':'��','Sun':'��' };
var getMyWeekFull = { 'Mon':'�����������','Tue':'�������','Wed':'�����','Thu':'�������','Fri':'�������','Sat':'�������','Sun':'�����������' };
var cINPUT;
var calFunc='CalendarClose';

function getFullDay(data)
	{
	// �����, 14 ������ 2010
	var arr=data.split(/-/);
	var now = new Date(arr[0],Math.abs(arr[1])-1,arr[2]).toString();
	var arrNow=now.split(/ /);
	return getMyWeekFull[arrNow[0]]+", "+arr[2]+" "+getMonRus2[arr[1]]+" "+arr[0];
	}

function getSokrDay(data)
	{
	// ��. 14 ���. 2010
	var arr=data.split(/-/);
	var now = new Date(arr[0],Math.abs(arr[1])-1,arr[2]).toString();
	var arrNow=now.split(/ /);
	return getMyWeek[arrNow[0]]+". "+arr[2]+" "+getMonRus3[arr[1]]+" "+arr[0];

	}
Date.prototype.getWeek = function()
	{
	var wFirst=0;
	var onejan = new Date(this.getFullYear(),0,1,0,0,0);
	var dayW=onejan.getDay();
	if(dayW==5 || dayW==6) wFirst=1;
	return Math.ceil((((this - onejan) / 86400000) + dayW)/7)-wFirst;
	}

function Calendar(myDay,e,func)
	{
	var now;
	var calYear;
	var calMon;
	var calDay;
	var arr;
	
	if(func) calFunc=func;

// ====== �������� ������� ���� ==========
	now = new Date().toUTCString();
	arr=now.split(/ /);
	var today=arr[3]+"-"+getMon[arr[2]]+"-"+arr[1];
	var todayLink=Math.abs(arr[1])+" "+getMonRus1[arr[2]]+" "+arr[3];

	if(myDay)
		{
		arr=myDay.split(/-/);
		calYear=Math.abs(arr[0]);
		calMon=Math.abs(arr[1]);
		calDay=Math.abs(arr[2]);
		}
	else
		{
		now = new Date().toUTCString();
		calYear=Math.abs(arr[3]);
		calMon=Math.abs(getMon[arr[2]]);
		calDay=Math.abs(arr[1]);
		}

	var Prev=(calMon-1==0?calYear-1:calYear)+"-"+(calMon-1==0?12:calMon-1)+"-01";
	var Next=(calMon+1==13?calYear+1:calYear)+"-"+(calMon+1==13?1:calMon+1)+"-01";

	cINPUT=calYear;

	CAL="<TABLE cellpadding=0 cellspacing=0>";

	CAL+="<TR><TD><H1><A HREF='javascript:' onclick=Calendar('"+Prev+"');>&laquo;</A></H1>";
	CAL+="<TD colspan=3 align=left><H3><DL><DT><A HREF='javascript:' onclick=CalendarMonView("+calMon+");>"+getMonRus[calMon]+"</A>";
	for(n=1;n<=12;n++) CAL+="<DD><A HREF='javascript:' onclick=Calendar('"+calYear+"-"+n+"-01');>"+getMonRus[n]+"</A>";
	CAL+="</DL></H3>";

	CAL+="<TD colspan=3 align=center><FORM METHOD=POST ACTION='' target='calFrame' onsubmit=CalendarFormSubmit("+calMon+");><TABLE cellpadding=0 cellspacing=0>";
		CAL+="<TR><TD><INPUT TYPE=text value='"+calYear+"' maxlength=4 onkeyup=cINPUT=this.value;>";
		CAL+="<TD><IMG SRC=/img/CalYearUp_0.gif onmouseover=this.src='/img/CalYearUp_1.gif'; onmouseout=this.src='/img/CalYearUp_0.gif'; onclick=Calendar('"+(calYear+1)+"-"+calMon+"-01');><BR>";
		CAL+="<IMG SRC=/img/CalYearDown_0.gif onmouseover=this.src='/img/CalYearDown_1.gif'; onmouseout=this.src='/img/CalYearDown_0.gif'; onclick=Calendar('"+(calYear-1)+"-"+calMon+"-01');>";
	CAL+="</TABLE></FORM>";

	CAL+="<TD><H1><A HREF='javascript:' onclick=Calendar('"+Next+"');>&raquo;</A></H1>";

	CAL+="<TR><TD>&nbsp;<TH>��<TH>��<TH>��<TH>��<TH>��<TH>��<TH>��";

// ====== ���������� ����� ������ ==========
	var Week=new Date(calYear,calMon-1,1).getWeek();

	CAL+="<TR><TD><H2>"+Week+"</H2>";

// ====== ���������� ������� ��� ������� ��� ==========
	var dayWeak=new Date(calYear,calMon-1,1).getDay();
	if(dayWeak==0) dayWeak=7;
	if(dayWeak>1) for(n=1;n<dayWeak;n++) CAL+="<TD>&nbsp;";

	var dayCount=new Date(calYear,calMon,0).getDate(); // ====== ���������� ���������� ���� � ������ ==========
	for(day=1;day<=dayCount;day++)
		{
		if(today==calYear+"-"+calMon+"-"+day) CAL+="<TD><H6><A HREF='javascript:' onclick="+calFunc+"('"+calYear+"-"+calMon+"-"+day+"');><B>"+day+"</B></A></H6>";
		else CAL+="<TD><H6><A HREF='javascript:' onclick="+calFunc+"('"+calYear+"-"+calMon+"-"+day+"');>"+day+"</A></H6>";
		dayWeak++;
		if(dayWeak>7) dayWeak=1;
		if(dayWeak==1 && day!=dayCount)
			{
			Week++;
			CAL+="<TR align=center><TD><H2>"+Week+"</H2>";
			}
		}
	CAL+="<TR><TD colspan=8><H4><I onclick=CalendarClose();>x</I><A HREF='javascript:' onclick="+calFunc+"('"+today+"');>�������, "+todayLink+"</A></H4>";
	CAL+="</TABLE>";

	if(!$("#calendar").text())
		{
		$("BODY").append("<DIV></DIV>");
		$("DIV:last").attr("id","calendar");
		$("#calendar").append("<DIV></DIV><IFRAME src='' name='calFrame' scrolling='no' frameborder='0'></IFRAME>").fadeIn(300);
		}

	if(e)
		{
		e=e || window.event;
		$("#calendar").css("top",e.clientY+document.body.scrollTop+3).css("left",e.clientX+document.body.scrollLeft+5)
		}

	$("#calendar DIV:eq(0)").html(CAL);
	return false;
	}

function CalendarFormSubmit(mon)
	{
	var reg = /^[0-9]+$/;
	if(reg.exec(cINPUT)==null) alert('������������ ���� ����.');
	else
		if(cINPUT<1900 || cINPUT>2099) alert('���������� ��������: 1900 - 2099.');
		else Calendar(cINPUT+"-"+mon+"-01");
	}

function CalendarMonView(mon)
	{
	var DL=$("#calendar DL:eq(0)");
	if(DL.find("DD:eq(0)").is(":hidden"))
		{
		DL.css("background-color","#FFF").css("border","#AAC solid 1px");
		DL.find("DT:eq(0)").css("border-bottom","#AAC solid 1px")
			.find("A:eq(0)").css("border","#FFF solid 1px");
		DL.find("DD:eq("+(mon-1)+") A:eq(0)").css("font-weight","bold");
		DL.find("DD").css("display","block");
		}
	else CalendarMonHide();
	}

function CalendarMonHide()
	{
	var DL=$("#calendar DL:eq(0)");
	DL.css("background-color","#DDF")
		.css("border-top","#DDF solid 1px")
		.css("border-left","#DDF solid 1px")
		.css("border-right","#DDF solid 1px")
		.css("border-bottom","#CCC solid 1px")
		.find("DT:eq(0)").css("border-bottom","#DDF solid 1px");
	DL.find("A:eq(0)").css("border","#DDF solid 1px");
	DL.find("DD").css("display","none");
	}

function CalendarClose(){ $("#calendar").remove(); }
