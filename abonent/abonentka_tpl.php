<?php include_once('abonentka.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - ���������� ����������� �����</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/abonent/abonent.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{
	$("#FormAbon DL:eq(0)").click(function(e){
		var DD=$(this).find("DD");
		if(DD.is(":hidden"))
			{
			DD.find("A").css("font-weight","normal");
			DD.eq(FormAbon.abMonth.value-1).find("A").css("font-weight","bold");
			DD.slideDown("fast");
			}
		else
			{
			var month = {"������":1,"�������":2,"����":3,"������":4,"���":5,"����":6,"����":7,"������":8,"��������":9,"�������":10,"������":11,"�������":12};
			var mon=$(e.target).text();
			FormAbon.abMonth.value=month[mon];
			$(this).find("DT:eq(0)").text(mon);
			abMonthCheck();
			}
		});

	$("#FormAbon DL:eq(1)").click(function(e){
		var DD=$(this).find("DD");
		if(DD.is(":hidden"))
			{
			DD.find("A").css("font-weight","normal");
			for(var n=0;n<DD.length;n++)
				{
				var A=DD.eq(n).find("A");
				if(A.text()==FormAbon.abYear.value) A.css("font-weight","bold");
				}
			DD.slideDown("fast");
			}
		else
			{
			var year=$(e.target).text();
			FormAbon.abYear.value=year;
			$(this).find("DT:eq(0)").text(year);
			abMonthCheck();
			}
		});

	$("#FormAbon FONT").click(function(e){
		var month = {1:'������',2:'�������',3:'����',4:'������',5:'���',6:'����',7:'����',8:'������',9:'��������',10:'�������',11:'������',12:'�������'};
		var nMon=FormAbon.abMonth.value;
		if($(e.target).text()=="�") nMon++; else nMon--;
		var DT=$("#FormAbon DT");
		if(nMon==0) { nMon=12; FormAbon.abYear.value--; DT.eq(1).text(FormAbon.abYear.value); }
		if(nMon==13) { nMon=1; FormAbon.abYear.value++; DT.eq(1).text(FormAbon.abYear.value); }
		DT.eq(0).text(month[nMon]);
		FormAbon.abMonth.value=nMon;
		abMonthCheck();
		});

	$("BODY").click(function(){ for(var n=0;n<=1;n++) if($("#FormAbon DL").eq(n).find("DD").is(":visible")) $("#FormAbon DD").hide(); });

	$("#FormAbon .myBytton").click(function(e){
		FormAbonGo(e);
		return false;
		}).mouseout(ErrorHide);
	});

function abMonthCheck()
	{
	var H6=$("#FormAbon H6:eq(0)");
	H6.append(" <IMG SRC=/img/ajax-loader.gif>");
	H6.load("/abonent/AjaxAbonMonthCheck.php?year="+FormAbon.abYear.value+"&mon="+FormAbon.abMonth.value+"&abonent="+FormAbon.AbonAdd.value);
	}

function FormAbonGo(e)
	{
	money=FormAbon.money.value;
	if(!money) ErrorView('�� ������� �����.',e);
	else
		{
		var regMoney = /^[0-9]+$/;
		if(regMoney.exec(money)==null)
			ErrorView('����� ������� �����������.',e);
		else FormAbon.submit();
		}
	}

//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<TABLE cellspacing=0 cellpadding=0>
	<caption>������� id:<B><?php echo $abonent->id; ?></B></caption>
	<TR><TD valign=top><?php include_once('abMenu.php'); ?>
			<TD valign=top id=abonent>
					<?php include_once('abInfoSmall.php'); ?>
					<H5>���������� ����������� �����</H5>


				<DIV id=abAbon>

<?php if($_POST['AbonAdd']) if($abonError) echo $abonError; else { ?>

					<DIV id=msgOk>����������� ����� �� <B><?php echo $monTxt; ?></B> ���������. <A HREF='/ab<?php echo $abonent->id; ?>/abonentka'><B>OK</B></A></DIV>

<?php } else { ?>

					
					<FORM METHOD=POST ACTION='/ab<?php echo $abonent->id; ?>/abonentka' name=FormAbon id=FormAbon>
					<H6><?php echo $abCalc; ?></H6>
					<TABLE cellspacing=0 cellpadding=0>
						<TR><TH>�����:				<TD><TABLE cellspacing=0 cellpadding=0><TR>
																			<TD><FONT>�</FONT>
																			<TD width=83><DIV id=abSelectData><DL style=width:81px;><?php echo $abSelectMon; ?></DL></DIV>
																			<TD width=47><DIV id=abSelectData><DL style=width:45px;><?php echo $abSelectYear; ?></DL></DIV>
																			<TD><FONT>�</FONT>
																		</TABLE>
						<TR><TH>�����:				<TD><CODE><INPUT TYPE=text NAME='money' maxlength=5 value='<?php echo $abonent->abonentka_sum; ?>'></CODE>
						<TR><TH>����������:	<TD><SPAN><INPUT TYPE=text NAME='prim' maxlength=255></SPAN>
						<TR><TD colspan=2 align=center><DIV class=myBytton><A HREF='#'>������</A></DIV>
					</TABLE>
					<INPUT TYPE=hidden name=AbonAdd value='<?php echo $abonent->id; ?>'>
					<INPUT TYPE=hidden name=abMonth value='<?php echo $jetzMon; ?>'>
					<INPUT TYPE=hidden name=abYear value='<?php echo $jetzYear; ?>'>
					</FORM>

<?php } ?>

				</DIV>
				
				<H5>������ ����������</H5>
				<?php echo $abSpisok; ?>

</TABLE>
	

</TABLE></BODY></HTML>
