<?php include_once('log.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Список действий, произведённых над абонентом</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/abonent/abonent.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>

</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<TABLE cellspacing=0 cellpadding=0>
	<caption>Абонент id:<B><?php echo $abonent->id; ?></B></caption>
	<TR><TD valign=top><?php include_once('abMenu.php'); ?>
			<TD valign=top id=abonent>
					<?php include_once('abInfoSmall.php'); ?>

					<H5>Список действий</H5>
					<?php echo $logSpisok; ?>

</TABLE>



</TABLE></BODY></HTML>
