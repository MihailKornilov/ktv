<?php
if(!$kassir->rule_panel_admin) header("Location: /nopage");

if($_POST['newLgota']) $ktv->Query("insert into lgota (name,tip,value,about) values ('".$_POST['name']."',".$_POST['tip'].",".$_POST['znach'].",'".$_POST['about']."')");
else
	{
	$lgotaTip="<DIV id='mySel'><DL>";
	$lgotaTip.="<DT><TABLE cellspacing=0 cellpadding=0><TR><TD width=100%><P>������ � ���������<TD><B>v</B></TABLE>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,1);'>������ � ���������</A>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,2);'>����� ������</A>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,3);'>������������� �����</A>";
	$lgotaTip.="</DL></DIV>";
	}
?>
