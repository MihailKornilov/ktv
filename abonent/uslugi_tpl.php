<?php include_once('uslugi.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - услуги</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/abonent/abonent.css" rel="stylesheet" type="text/css">
<!--[if IE]>
<style>
#abSelectUslugi  A {
	position:relative;
	top:-1px;
	}
</style>
<![endif]-->
<SCRIPT src="/include/script.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{	
	var DD=$(this).find("DD");
	var len=DD.length;
	for(var n=0;n<len;n++)
		DD.eq(n).click(function(){
			FormUslugi.name.value=$(this).find("SPAN:eq(0)").text();
			FormUslugi.cena.value=$(this).find("B:eq(0)").text();
			});

	$("#FormUslugi .myBytton").click(function(e){FormUslugiGo(e); }).mouseout(ErrorHide);
	});

function FormUslugiGo(e)
	{
	if(!FormUslugi.name.value) ErrorView('не введено наименование.',e);
	else
		{
		cena=FormUslugi.cena.value;
		if(!cena) ErrorView('не введена сумма.',e);
		else
			{
			var regCena = /^[0-9]+$/;
			if(regCena.exec(cena)==null)
				ErrorView('стоимость введена некорректно.',e);
			else FormUslugi.submit();
			}
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

				<H5>Списание с лицевого счёта за услуги</H5>
					
				<DIV id=abUslugi>	

<?php if($_POST['UslugiAdd']) { ?>

					<DIV id=msgOk>Списание средств с лицевого счёта за услугу успешно произведено. <A HREF='/ab<?php echo $abonent->id; ?>/uslugi'><B>OK</B></A></DIV>

<?php } else { ?>

					<FORM METHOD=POST ACTION='/ab<?php echo $abonent->id; ?>/uslugi' name=FormUslugi id=FormUslugi>
					<TABLE cellspacing=0 cellpadding=0 width=100%>
						<TR><TH>Наименование:	<TD>
									
									<DIV id=abSelectUslugi>
											<INPUT TYPE=text NAME='name' maxlength=50><FONT><A HREF='javascript:'>v</A></FONT><BR>
									<DIV><DL><?php echo $UsSelectSpisok; ?></DL></DIV>
									</DIV>

						<TR><TH>Стоимость:			<TD><CODE><INPUT TYPE=text NAME='cena' maxlength=5></CODE>
						<TR><TH>Примечание:		<TD><SPAN><INPUT TYPE=text NAME='prim' maxlength=255></SPAN>
						<TR><TD colspan=2 align=center><DIV class=myBytton><A HREF='#'>внести</A></DIV>
					</TABLE>
					<INPUT TYPE=hidden name=UslugiAdd value='<?php echo $abonent->id; ?>'>
					</FORM>

<?php } ?>

				</DIV>

				<H5>Произведённые списания</H5>
				<?php echo $usSpisok; ?>
</TABLE>



</TABLE></BODY></HTML>
