<?php include_once('oplata.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Принятые платежи</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT src="/main/oplata/oplata.js"></SCRIPT>

</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/oplata_small.gif><P>Принятые платежи</P></DIV>

<?php echo $msg.$oplataSpisok; ?>

</TABLE></BODY></HTML>
