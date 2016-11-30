<TABLE cellspacing=0 cellpadding=0 style=margin:20px;>
	<TR><TD id=headLeft>
			<H1>Интерфейс кассира</H1>
			<P>Администратор: <B><?php echo $kassir->fio; ?></B><?php if($kassir->rule_panel_admin) echo "<A HREF='/admin'>администрирование</A>"; ?></P>
		<TD id=headRight>
			<!-- <A HREF='index.php?help=1'><IMG SRC=/img/help_1.gif></A> -->
			<A HREF='/exit'><IMG SRC=/img/exit.gif></A>
	<TR><TD id=headLinks colspan=2>
			<A HREF='/'>Главная</A>
			<A HREF='/find'>Поиск абонентов</A>
			<A HREF='/oplata'>Список платежей</A>
			<A HREF='/ab/new'>Внести нового абонента</A>
			<A HREF='/report'>Отчёты</A>
	<TR><TD id=bodyContent colspan=2>