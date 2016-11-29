<?php include_once('remont.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - заявки</TITLE>
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
	$("#FormRemont DL:first").click(function(e){ FormRemont.name.value=$(e.target).text(); });
	$("#FormRemontEdit DL:first").click(function(e){
		if(!FormRemontEdit.name.value)
			FormRemontEdit.name.value=$(e.target).text();
		else FormRemontEdit.name.value+=", "+$(e.target).text();
		});
	$("#FormRemont .myBytton").click(function(e){FormRemontGo(e); }).mouseout(ErrorHide);
	$("#FormRemontEdit U:first").click(function(e){RemontPrimSave(e); }).mouseout(ErrorHide);
	$("#prim").click(function(){ $("#FormRemontEdit U:first").html("<U><A HREF='javascript:'>сохранить</A></U>"); });
	
	$("#FormRemontEdit A:last").click(function(e){ 
		if(confirm("Удалить заявку?"))
			{
			FormRemontEdit.action="/ab"+FormRemontEdit.abonent.value+"/remont/del";
			FormRemontEdit.submit();
			}
		});
	});

	
function FormRemontGo(e)
	{
	if(!FormRemont.name.value) ErrorView('не введено наименование.',e);
	else FormRemont.submit();
	}

function RemontPrimSave(e)
	{
	var PRIM=FormRemontEdit.prim;
	if(!PRIM.value) ErrorView('не введено примечание.',e);
	else
		{
		$("#FormRemontEdit U:first").html("<IMG SRC=/img/ajax-loader.gif>");
		$("#primSpisok").load("/abonent/AjaxRemontPrimSave.php?id_remont="+FormRemontEdit.remontSave.value+"&value="+encodeURIComponent(PRIM.value),
											function(){ $("#FormRemontEdit U:first").html("<B>сохранено!</B>"); PRIM.value=''; });
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



				<DIV id=abRemont>

<?php if($_POST['remontAdd']) { ?>
					<H5>Внесение заявки на неисправность</H5>
					<DIV id=msgOk>Заявка на неисправность внесена. <A HREF='/ab<?php echo $abonent->id; ?>/remont'><B>OK</B></A></DIV>
<?php } else if($_POST['remontSave']) { ?>
					<H5>Сохранение заявки</H5>
					<DIV id=msgOk>Данные заявки сохранены. <A HREF='/ab<?php echo $abonent->id; ?>/remont'><B>OK</B></A></DIV>
<?php } else if($rem->id) { ?>
					<H5>Активная заявка</H5>
					
					<FORM METHOD=POST ACTION='/ab<?php echo $abonent->id; ?>/remont' name=FormRemontEdit id=FormRemontEdit>
					<H1><?php echo $rem->name; ?></H1>
					<TABLE cellspacing=0 cellpadding=0>
						<TR><TH>Заявку внёс:		<TD><H3><?php echo $admin[$rem->admin_add]; ?></H3>
						<TR><TH>Дата внесения:	<TD><H3><?php echo Data($rem->dtime_add); ?></H3>
						<TR><TH>Примечание:
								<TD><SPAN><INPUT TYPE=text NAME=prim id=prim maxlength=255></SPAN>
										<U><A HREF='javascript:'>сохранить</A></U>
					</TABLE>

					<CENTER id=primSpisok><?php echo $primSpisok; ?></CENTER>

					<H2>Отметка о выполнении:</H2>
					<TABLE cellspacing=0 cellpadding=0>
						<TR><TH>Cотрудники:<TD>

								<DIV id=abSelectUslugi>
									<INPUT TYPE=text NAME='name' maxlength=50><FONT><A HREF='javascript:'>v</A></FONT><BR>
									<DIV><DL><?php echo $zWorkersSpisok; ?></DL></DIV>
								</DIV>

						<TR><TH>&nbsp;<TD><DIV class=myBytton><A HREF='#' onclick=FormRemontEdit.submit();>применить</A></DIV>
					</TABLE>

					<H2>Дополнительно: <A HREF="#"><IMG SRC="/img/del.gif">удалить заявку</A></H2>
					<INPUT TYPE=hidden name=remontSave value='<?php echo $rem->id; ?>'>
					<INPUT TYPE=hidden name=abonent value='<?php echo $abonent->id; ?>'>
					</FORM>

<?php } else { ?>
					<H5>Внесение заявки на неисправность</H5>
					
					<FORM METHOD=POST ACTION='/ab<?php echo $abonent->id; ?>/remont' name=FormRemont id=FormRemont>
					<TABLE cellspacing=0 cellpadding=0>
						<TR><TH><B>Наименование</B>:	<TD>
						
								<DIV id=abSelectUslugi>
									<INPUT TYPE=text NAME='name' maxlength=50><FONT><A HREF='javascript:'>v</A></FONT><BR>
									<DIV><DL><?php echo $zSelectSpisok; ?></DL></DIV>
								</DIV>

						<TR><TH>Примечание:		<TD><SPAN><INPUT TYPE=text NAME='prim' maxlength=255></SPAN>
						<TR><TD colspan=2 align=center><DIV class=myBytton><A HREF='#'>внести</A></DIV>
					</TABLE>
					<INPUT TYPE=hidden name=remontAdd value='<?php echo $abonent->id; ?>'>
					</FORM>

<?php } ?>

				</DIV>

				<H5>Список выполненных заявок <A HREF='/remont'>к общему списку...</A></H5>
				<?php echo $zSpisok; ?>

</TABLE>



</TABLE></BODY></HTML>
