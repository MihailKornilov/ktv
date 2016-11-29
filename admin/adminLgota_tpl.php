<?php include_once('adminLgota.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - настройки льгот</TITLE>
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
	Льготы для абонентов
</DIV>

<A HREF="/admin/lgota/add">Добавить новую льготу</A>
<BR>

<?php echo $lgotaSpisok; ?>

</TABLE></BODY></HTML>
