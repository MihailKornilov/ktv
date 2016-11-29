<?php include_once('adminLgotaEdit.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - редактирование льготы</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/admin/admin.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT src="/admin/admin.js"></SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=path>
	<A HREF="/">Главная</A> / 
	<A HREF="/admin">Администрирование</A> / 
	<A HREF="/admin/lgota">Льготы для абонентов</A> /
	Редактирование льготы
</DIV>

<?php if($_POST['idLgota']) { ?>
	<DIV id=msgOk>Данные изменены <A HREF='/admin/lgota'><B>OK</B></A>.</DIV>
<?php } else { ?>


<CENTER>
<DIV>
<FORM METHOD=POST ACTION="/admin/lgota/<?php echo $lgota->id; ?>" name="FormLgota" id="FormLgota">
	<TABLE cellpadding=0 cellspacing=0 width=400 id=TableSetup>
	<TR><TD colspan=2><H1>Изменение характеристики льготы</H1>
	<TR><TH>Наименование:			<TD><INPUT TYPE="text" NAME="name" value="<?php echo $lgota->name; ?>">
	<TR><TH>Изменение абонентской<BR>платы в месяц:		<TD><?php echo $lgotaTip; ?>
	<TR><TH>Значение:			<TD><INPUT TYPE="text" NAME="znach" style=width:50px; maxlength=5 value="<?php echo $lgota->value; ?>">
	<TR><TH>Описание:			<TD><TEXTAREA NAME='about'><?php echo $lgota->about; ?></TEXTAREA>
	<TR><TD colspan=2 align=center><H2 class=myBytton><A HREF='#'>сохранить</A></H2>
	</TABLE>

	<INPUT TYPE="hidden" name="tip" id="tip" value="<?php echo $lgota->tip; ?>">
	<INPUT TYPE="hidden" name="idLgota" value="<?php echo $lgota->id; ?>">
</FORM>
</DIV>
</CENTER>
<?php } ?>


</TABLE></BODY></HTML>
