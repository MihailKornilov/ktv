<?php
if($_POST['AbRegister'] and $KtvKassirDemo==0)
	{
	$ktv->Query("insert into abonent (
adres_gorod,
adres_ulica,
adres_dom,
adres_kv,
adres_podezd,
adres_etag,
f,
i,
o,
date_zayav,
tel_dom,
tel_sot,
status,
status_edit,
abonentka_sum,
admin_add) 
values (
".$_POST['adres_gorod'].",
".$_POST['adres_ulica'].",
".$_POST['adres_dom'].",
'".NumCreate($_POST['adres_kv'])."',
".$_POST['adres_podezd'].",
".$_POST['adres_etag'].",
'".$_POST['f']."',
'".$_POST['i']."',
'".$_POST['o']."',
'".$_POST['date_zayav']."',
'".$_POST['tel_dom']."',
'".$_POST['tel_sot']."',
".$_POST['status'].",
current_timestamp,
".$ktv->QRow("select abon_summa from adres_gorod where id=".$_POST['adres_gorod']).",
".$_SESSION['ks'].")");
					
		$id=$ktv->QRow("select id from abonent order by id desc limit 1");
		AdresSet($id,$_POST['adres_gorod'],$_POST['adres_ulica'],$_POST['adres_dom']);
		header("Location: /ab/new/".$id);
		}

$tekData=strftime("%Y-%m-%d",time());
?>
