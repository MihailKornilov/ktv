<?php
if(!$kassir->rule_panel_admin) header("Location: /nopage");

if($_POST['idLgota']) $ktv->Query("update lgota set name='".$_POST['name']."',tip=".$_POST['tip'].",value=".$_POST['znach'].",about='".$_POST['about']."' where id=".$_POST['idLgota']);
else
	{
	$lgota=$ktv->QueryObjectOne("select * from lgota where id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));

	switch($lgota->tip)
		{
		case '1': $tip="������ � ���������"; break;
		case '2': $tip="����� ������"; break;
		case '3': $tip="������������� �����"; break;
		}

	$lgotaTip="<DIV id='mySel'><DL>";
	$lgotaTip.="<DT><TABLE cellspacing=0 cellpadding=0><TR><TD width=100%><P>".$tip."<TD><B>v</B></TABLE>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,1);'>������ � ���������</A>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,2);'>����� ������</A>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,3);'>������������� �����</A>";
	$lgotaTip.="</DL></DIV>";
	}
?>
