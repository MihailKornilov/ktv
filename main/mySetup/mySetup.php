<?php
if($_POST['mySetup'])
	{
	$ktv->Query("update admin set kassir_path_save=".$_POST['kassir_path_save']." where id=".$_SESSION['ks']);
	$kassir->kassir_path_save=$_POST['kassir_path_save'];
	$msg="<DIV id=msgOk>������ ���������.</DIV>";

	if($_POST['oldpass'] or $_POST['newpass'])
	if($ktv->QRow("select password('".$_POST['oldpass']."')")!=$kassir->pass) $msg="<div id=msgErr><B>������:</B> �������� ���� ������� ������.</DIV>";
	else
		if(!$_POST['newpass']) $msg="<div id=msgErr><B>������:</B> �� ����� ����� ������.</DIV>";
		else $ktv->Query("update admin set pass=password('".$_POST['newpass']."') where id=".$_SESSION['ks']);

	}
?>
