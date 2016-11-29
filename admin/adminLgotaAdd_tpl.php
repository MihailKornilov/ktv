<?php include_once('adminLgotaAdd.php'); ?>
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
	Добавление новой льготы
</DIV>

<?php if($_POST['newLgota']) { ?>
	<DIV id=msgOk>Новая льгота внесена <A HREF='/admin/lgota'><B>OK</B></A>.</DIV>
<?php } else { ?>


<CENTER>
<FORM METHOD=POST ACTION="/admin/lgota/add" name="FormLgota" id="FormLgota">
	<TABLE cellpadding=0 cellspacing=0 width=400 id=TableSetup>
	<TR><TD colspan=2><H1>Добавление новой льготы</H1>
	<TR><TH>Наименование:			<TD><INPUT TYPE="text" NAME="name">
	<TR><TH>Изменение абонентской<BR>платы в месяц:		<TD><?php echo $lgotaTip; ?>
	<TR><TH>Значение:			<TD><INPUT TYPE="text" NAME="znach" style=width:50px; maxlength=5>
	<TR><TH>Описание:			<TD><TEXTAREA NAME='about'></TEXTAREA>
	<TR><TD colspan=2 align=center><H2 class=myBytton><A HREF='#'>внести</A></H2>
	</TABLE>

	<INPUT TYPE="hidden" name="tip" id="tip" value="1">
	<INPUT TYPE="hidden" name="newLgota" value="1">
</FORM>
</CENTER>
<?php } ?>


</TABLE></BODY></HTML>
