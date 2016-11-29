<?php include_once('mySetup.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Мои настройки</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/settings_small.gif><P>Мои настройки</P></DIV>

<CENTER>
	<?php echo $msg; ?>
	<FORM METHOD=POST ACTION='/my-setup' name=FormMySetup>
	<TABLE cellspacing=0 cellpadding=0 id=TableSetup>
		<TR><TD colspan=2><H1>Изменение настроек интерфейса</H1>
		<TR><TH>Логин:<TD><B><?php echo $kassir->login; ?></B>
		<TR><TH>Старый пароль:	<TD><INPUT TYPE=password NAME=oldpass>
		<TR><TH>Новый пароль:	<TD><INPUT TYPE=password NAME=newpass>
		<TR><TH>Запоминать состояние при выходе:	<TD><?php CheckBox('kassir_path_save',$kassir->kassir_path_save); ?>
		<TR><TD colspan=2 align=center><H2 class=myBytton><A HREF='#' onclick=FormMySetup.submit();>сохранить</A></H2>
		<INPUT TYPE=hidden NAME=mySetup value=1>
	</TABLE>
	</FORM>
</CENTER>

</TABLE></BODY></HTML>
