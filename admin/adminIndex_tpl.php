<?php if(!$kassir->rule_panel_admin) header("Location: /nopage"); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Администрирование</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/admin/admin.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=path>
	<A HREF="/">Главная</A> / Администрирование
</DIV>

<A HREF="/admin/workers">управление сотрудниками</A><BR>
<A HREF="/admin/lgota">настройки льгот</A><BR>
<A HREF="/admin/dump">резервное копирование</A><BR>
<A HREF="/find/exportspisok.php" target="_blank">экспорт списка абонентов</A><BR>

</TABLE></BODY></HTML>
