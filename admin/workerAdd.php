<?php
if(!$kassir->rule_panel_admin) header("Location: /nopage");

if($_POST['workerAdd'])
	{
	$ktv->Query("insert into admin (fio,adres,telefon) values ('".$_POST['fio']."','".$_POST['adres']."','".$_POST['telefon']."')");
	$id=$ktv->QRow("select * from admin order by id desc limit 1");
	$ktv->Query("insert into abonent_find (admin,name) values (".$id.",'abonCalc')");
	$ktv->Query("insert into abonent_find (admin,name) values (".$id.",'default')");
	header("Location: /admin/workers/".$ktv->QRow("select id from admin order by id desc limit 1"));
	}
?>
