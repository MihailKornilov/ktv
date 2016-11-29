<?php include_once('workers.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - список сотрудников</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/admin/admin.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=path>
	<A HREF="/">Главная</A> / 
	<A HREF="/admin">Администрирование</A> / 
	Управление сотрудниками
</DIV>

<A HREF="/admin/workers/add">Добавить нового сотрудника</A>
<BR>
<DIV id=admWork><?php echo $workSpisok; ?></DIV>

</TABLE></BODY></HTML>
