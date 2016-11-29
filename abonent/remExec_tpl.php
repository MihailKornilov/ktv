<?php include_once('remExec.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - подробности заявки</TITLE>
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



				<DIV id=abRemont>
					<H5>Подробности заявки</H5>

<?php if($rem->id) { ?>
					<FORM>
					<H1><?php echo $rem->name; ?></H1>
					<TABLE cellspacing=0 cellpadding=0>
						<TR><TH>Заявку внёс:		<TD><H3><?php echo $admin[$rem->admin_add]; ?></H3>
						<TR><TH>Дата внесения:	<TD><H3><?php echo Data($rem->dtime_add); ?></H3>
					</TABLE>

					<CENTER id=primSpisok><?php echo $primSpisok; ?></CENTER>

					<H2>Отметка о выполнении:</H2>
					<TABLE cellspacing=0 cellpadding=0>
						<TR><TH>Статус:<TD><BLOCKQUOTE><?php echo rmStatus($rem->status); ?></BLOCKQUOTE>
						<?php echo $sotrudniki; ?>
						<TR><TH>Дата:<TD><H3><?php echo Data($rem->dtime_red); ?></H3>
						<TR><TH>Администратор:		<TD><H3><?php echo $admin[$rem->admin_red]; ?></H3>
					</TABLE>
					</FORM>

<?php } else { ?>
	<DIV class=msgEmpty>Несуществующая заявка.</DIV>

<?php } ?>
					<H4><A HREF="/ab<?php echo $abonent->id; ?>/remont">назад</A></H4>
				</DIV>
</TABLE>



</TABLE></BODY></HTML>
