<?php include_once('workerAdd.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - изменение данных сотрудника</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/admin/admin.css" rel="stylesheet" type="text/css">
<?php echo $panelEnter; ?>
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function(){
	$("#TableSetup TR:even").css("background-color","#D7F3D7");

	$("#FormWorker .myBytton").click(function(e){
		if(!FormWorker.fio.value) ErrorView("не указаны ФИО сотрудника.",e);
		else FormWorker.submit();
		return false;
		}).mouseout(ErrorHide);
	});
//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=path>
	<A HREF="/">Главная</A> / 
	<A HREF="/admin">Администрирование</A> / 
	<A HREF="/admin/workers">Управление сотрудниками</A> / 
	Добавление нового сотрудника
</DIV>

<BR>

<CENTER>
<DIV>	
<FORM METHOD=POST ACTION="/admin/workers/add" name=FormWorker id=FormWorker>
	<TABLE cellpadding=0 cellspacing=0 width=500 id=TableSetup>
		<TR><TD colspan=2><H1>Личная информация</H1>
		<TR><TH width=220>ФИО:				<TD><INPUT TYPE="text" NAME="fio">
		<TR><TH>Домашний адрес:			<TD><INPUT TYPE="text" NAME="adres">
		<TR><TH>Контактные телефоны:	<TD><INPUT TYPE="text" NAME="telefon">
		<TR><TD align=right><A HREF='/admin/workers'>отмена</A><TD><H2 class=myBytton><A HREF='#'>добавить</A></H2>
	</TABLE>
	<INPUT TYPE="hidden" name="workerAdd" value="1">
</FORM>
</DIV>
</CENTER>

</TABLE></BODY></HTML>
