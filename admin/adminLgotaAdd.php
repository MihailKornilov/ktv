<?php
if(!$kassir->rule_panel_admin) header("Location: /nopage");

if($_POST['newLgota']) $ktv->Query("insert into lgota (name,tip,value,about) values ('".$_POST['name']."',".$_POST['tip'].",".$_POST['znach'].",'".$_POST['about']."')");
else
	{
	$lgotaTip="<DIV id='mySel'><DL>";
	$lgotaTip.="<DT><TABLE cellspacing=0 cellpadding=0><TR><TD width=100%><P>скидка в процентах<TD><B>v</B></TABLE>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,1);'>скидка в процентах</A>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,2);'>сумма скидки</A>";
	$lgotaTip.="<DD><A HREF='javascript:' onclick='LgotaSet(this,3);'>фиксированная сумма</A>";
	$lgotaTip.="</DL></DIV>";
	}
?>
