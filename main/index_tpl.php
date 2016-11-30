<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Главная</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/main/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=MainLinks>
	<H1>Обслуживание</H1>
	<DIV><H4>
		<A HREF='/my-setup'><IMG SRC=/img/settings.gif><P>Мои<BR>настройки</P></A>
		<A HREF='/adres-edit'><IMG SRC=/img/adres_edit.gif><P>Редактирование<BR>адресов</P></A>
		<A HREF='/remont/wait'><IMG SRC=/img/remont.gif><P>Заявки<BR>на неисправности</P></A>
		<?php if($kassir->rule_abon_calc == 1) { ?><A HREF='/abon-calc'><IMG SRC=/img/abon_calc.gif><P>Начисление<BR>абонентской платы</P></A><?php } ?>
		<A HREF='/bonus'><IMG SRC=/img/bonus.png><P>Бонусы<br />для абонентов</P></A>
		<!-- <A HREF='index.php?p=7'><IMG SRC=/img/AbonReCalc.gif><P>Перерасчёт<BR>абонентской платы</P></A> -->
		<!-- <A HREF='index.php?p=9'><IMG SRC=/img/kvit_print.gif><P>Печать<BR>квитанций</P></A> -->
	</H4></DIV>
</DIV>

</TABLE></BODY></HTML>


