<?php $abStyle="style='background:#AAE;border-top:#77A solid 1px;border-bottom:#77A solid 1px;border-right:#77A solid 1px;'"; ?>
<DIV id=abMenu>
	<H5><A HREF='/ab<?php echo $abonent->id; ?>' <?php if($_GET['page']=='ab_oplata') echo $abStyle; ?>><H6><DIV>Внести<BR>платёж</DIV></H6><IMG SRC='/img/oplata_add.gif'></A></H5>

	<H5><A HREF='/ab<?php echo $abonent->id; ?>/abonentka' <?php if($_GET['page']=='ab_abonentka') echo $abStyle; ?>><H6><DIV>Начислить<BR>абонентскую плату</DIV></H6><IMG SRC='/img/abon_calc_add.gif'></A></H5>

	<H5><A HREF='/ab<?php echo $abonent->id; ?>/uslugi' <?php if($_GET['page']=='ab_uslugi') echo $abStyle; ?>><H6><DIV>Списать со счёта<BR>за услуги</DIV></H6><IMG SRC='/img/money_drop.gif'></A></H5>

	<H5><A HREF='/ab<?php echo $abonent->id; ?>/remont' <?php if($_GET['page']=='ab_remont') echo $abStyle; ?>><H6><DIV>Принять заявку<BR>на неисправность</DIV></H6><IMG SRC='/img/remont_add.gif'></A></H5>

	<H5><A HREF='/ab<?php echo $abonent->id; ?>/edit' <?php if($_GET['page']=='ab_edit') echo $abStyle; ?>><H6><DIV>Редактировать<BR>данные абонента</DIV></H6><IMG SRC='/img/abonent_edit.gif'></A></H5>

	<H5><A HREF='/ab<?php echo $abonent->id; ?>/log' <?php if($_GET['page']=='ab_log') echo $abStyle; ?>><H6><DIV>Список<BR>действий</DIV></H6><IMG SRC='/img/actions.gif'></A></H5>
</DIV>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{
	$("#abMenu H5").mouseover(function(){ $(this).find("DIV:first").show(); }).mouseout(function(){ $(this).find("DIV:first").hide(); });
	});
//-->
</SCRIPT>
