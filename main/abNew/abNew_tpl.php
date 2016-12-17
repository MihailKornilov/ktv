<?php include_once('abNew.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Регистрация нового абонента</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/main/abNew/abNew.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js?2"></SCRIPT>
<SCRIPT src="/main/abNew/abNew.js"></SCRIPT>

</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/abonent_register.gif><P>Регистрация нового абонента</P></DIV>

<CENTER>
<?php if($_GET['regOk']) { ?>

	<div id=msgOk>Новый абонент успешно внесён в базу.</div>
	<TABLE cellspacing=0 cellpadding=0 id=regOk>
		<TR><TH>Дальнейшие действия:
		<TR><TD><A HREF='/ab<?php echo $_GET['regOk']; ?>/edit'>Продолжить редактирование</A>
		<TR><TD><A HREF='/ab<?php echo $_GET['regOk']; ?>'>Принять оплату за подключение</A>
		<TR><TD><A HREF='/ab/new'>Зарегистрировать нового абонента</A>
	</TABLE>

<?php } else { ?>

	<FORM METHOD=POST ACTION='/ab/new' id=register name=register>
	<TABLE cellspacing=0 cellpadding=0 width=100%>
			
		<TR><TH width=130><B>Адрес:</B>	<TH><?php echo AdresAjax(0,0,0,'',0,0,"adresPovtorFind()",1); ?><DIV id=adresPovtor></DIV>
		<TR><TH><B>Фамилия:</B>				<TH><INPUT TYPE=text NAME=f id=f>
		<TR><TH>Имя:										<TH><INPUT TYPE=text NAME=i id=i>
		<TR><TH>Отчество:								<TH><INPUT TYPE=text NAME=o id=o><SPAN id=fioPovtor></SPAN>
		<TR><TH>Домашний телефон:			<TH><INPUT TYPE=text NAME=tel_dom style=width:250px; maxlength=50>
		<TR><TH>Сотовый телефон:				<TH><INPUT TYPE=text NAME=tel_sot style=width:250px; maxlength=50>
		<TR><TH>Дата подачи заявки:			<TH><B><A HREF='javascript:' onclick=Calendar('<?php echo $tekData; ?>',event,'RegDataZayavSet');><?php echo RealFullDay($tekData); ?></A></B>
		<TR><TH>Статус:									<TH><?php echo StatusSelect(8,'RegEditStatus',1,1); ?>

		<TR><TD colspan=2 align=center><H4><DIV class=myBytton><A HREF='#'>внести</A></DIV></H4>

		<INPUT TYPE=hidden name=status value='8'>
		<INPUT TYPE=hidden name=date_zayav value='<?php echo $tekData; ?>'>
		<INPUT TYPE=hidden NAME=AbRegister value=1>
	</TABLE>
	</FORM>

<?php } ?>

</CENTER>


</TABLE></BODY></HTML>
