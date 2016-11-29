<?php include_once('oplata.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - внесение платежа</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/abonent/abonent.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{	
	$("#FormOplata .myBytton").click(function(e){
		FormOplataGo(e);
		return false;
		}).mouseout(ErrorHide);

	$("#mySelOplata TABLE").click(function(){
		$("#mySelOplata DD").slideDown("fast");
		return false;
		});

	$("BODY").click(function(){ if($("#mySelOplata DD:eq(0)").is(":visible")) $("#mySelOplata DD").hide(); });

	$("#msgOk A:last").click(function(){
		window.open('/main/oplata/oplataKvitPrint.php?id=<?php echo $ktv->QRow("select id from oplata where status=1 and id_abonent=".$abonent->id." order by id desc limit 1"); ?>','','top=30,left=40,height=470,width=410,scrollbars=no');
		return false;
		});
});

function mySelectSet(obj,val)
	{
	$("#mySelOplata P").eq(0).html(obj.innerHTML).css("background-color",obj.style.backgroundColor);
	FormOplata.oplataTip.value=val;
	}

function FormOplataGo(e)
	{
	money=FormOplata.money.value;
	if(!money) ErrorView('не введена сумма.',e);
	else
		{
		var regMoney = /^[0-9]+$/;
		if(regMoney.exec(money)==null)
			ErrorView('сумма введена некорректно.',e);
		else FormOplata.submit();
		}
	}
//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<TABLE cellspacing=0 cellpadding=0>
	<caption>Абонент id:<B><?php echo $abonent->id; ?></B></caption>
	<TR><TD valign=top><?php include_once('abMenu.php'); ?>
			<TD valign=top id=abonent>
					<?php include_once('abInfoSmall.php'); ?>

					<H5>Зачисление платежа</H5>
					<DIV id=OplataAdd>
<?php if($_POST['oplataAdd']) { ?>

					<DIV id=msgOk>
						Платёж внесён. <A HREF='/ab<?php echo $abonent->id; ?>'><B>OK</B></A>.
						<H2><A HREF='javascript:'><IMG SRC='/img/iePrint.gif'>Распечатать<BR>квитанцию</A></H2>
					</DIV>

<?php } else { ?>
					
					<FORM METHOD=POST ACTION='/ab<?php echo $abonent->id; ?>' name=FormOplata id=FormOplata>
					<TABLE cellspacing=0 cellpadding=0>
						<TR><TH>Сумма:				<TD><CODE><INPUT TYPE=text NAME='money' maxlength=5></CODE>
						<TR><TH>Вид платежа:	<TD><?php echo $oplataTip; ?>
						<TR><TH>Примечание:	<TD><SPAN><INPUT TYPE=text NAME='prim' value='<?php echo $_POST['prim']; ?>' maxlength=255></SPAN>
						<TR><TD colspan=2 align=center><DIV class=myBytton><A HREF='#'>внести</A></DIV>
					</TABLE>
					<INPUT TYPE=hidden name=oplataAdd value='<?php echo $abonent->id; ?>'>
					<INPUT TYPE=hidden name=oplataTip value='2'>
					</FORM>
					<SCRIPT LANGUAGE='JavaScript'>FormOplata.money.focus();</SCRIPT>
<?php } ?>
					</DIV>
					<H5>Список платежей</H5>
					<?php echo $opSpisok; ?>
</TABLE>

</TABLE></BODY></HTML>
