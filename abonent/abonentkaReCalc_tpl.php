<?php include_once('abonentkaReCalc.php'); ?>
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
	$("#FormReAbon .myBytton").click(function(e){
		FormReAbonGo(e);
		return false;
		}).mouseout(ErrorHide);
	});

function FormReAbonGo(e)
	{
	money=FormReAbon.money.value;
	if(!money) ErrorView('�� ������� �����.',e);
	else
		{
		var regMoney = /^[0-9]+$/;
		if(regMoney.exec(money)==null)
			ErrorView('����� ������� �����������.',e);
		else
			if(money==FormReAbon.MoneyOld.value)
				ErrorView('����� �� ��������.',e);
			else FormReAbon.submit();
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

<?php if(!$abPlat->id) { ?>

					<DIV id=msgErr>��������� �������������. <A HREF='/ab<?php echo $abonent->id; ?>/abonentka'>�����</A>.</DIV>

<?php } else if($_POST['ReAbon']) { ?>

					<DIV id=msgOk>���������� ����������� ����� �� <B><?php echo fullmonth($data[1])." ".$data[0]; ?></B> ���������. <A HREF='/ab<?php echo $abonent->id; ?>/abonentka'><B>OK</B></A></DIV>

<?php } else { ?>

					
					<FORM METHOD=POST ACTION='/ab<?php echo $abonent->id; ?>/abonentka/<?php echo $abPlat->id; ?>' name=FormReAbon id=FormReAbon>
					<H2>���������� ����������� ����� �� <B><?php echo fullmonth($data[1])." ".$data[0]; ?></B>:</H2>
					<TABLE cellspacing=0 cellpadding=0>
						<TR><TH>���������� �������:	<TD><?php echo $adminName; ?>
						<TR><TH>���� ����������:			<TD><?php echo Data($abPlat->dtime_add); ?>
						<TR><TH>����� �����:					<TD><CODE><INPUT TYPE=text NAME='money' maxlength=5 value='<?php echo $abPlat->money; ?>'></CODE>
						<TR><TH>������� �����������:		<TD><SPAN><INPUT TYPE=text NAME='prim' maxlength=255></SPAN>
						<TR><TH><A HREF='/ab<?php echo $abonent->id; ?>/abonentka'>������</A>
								<TD><DIV class=myBytton><A HREF='#'>���������</A></DIV>
					</TABLE>
					<INPUT TYPE=hidden name=ReAbon value='<?php echo $abonent->id; ?>'>
					<INPUT TYPE=hidden name=Reid value='<?php echo $abPlat->id; ?>'>
					<INPUT TYPE=hidden name=MoneyOld value='<?php echo $abPlat->money; ?>'>
					</FORM>

<?php } ?>

				</DIV>
				
</TABLE>
	

</TABLE></BODY></HTML>
