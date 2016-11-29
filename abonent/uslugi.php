<?php
$abonent=$ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if($abonent->id)
	{
	if($_POST['UslugiAdd'] and $KtvKassirDemo==0)
		{
		$abonent->balans-=$_POST['cena'];
		$ktv->Query("insert into abonentka (tip,name,money,id_abonent,prim,admin_add,balans) values (1,'".$_POST['name']."',".$_POST['cena'].",".$_POST['UslugiAdd'].",'".$_POST['prim']."',".$_SESSION['ks'].",".$abonent->balans.")");
		$ktv->Query("update abonent set balans=".$abonent->balans." where id=".$_POST['UslugiAdd']);
		$ktv->Query("insert into abonent_log (action,value_new,id_abonent,id_admin) values ('Списание за услугу<BR>\'".$_POST['name']."\'','Сумма: <B>".$_POST['cena']."</B>, баланс: ".$abonent->balans."',".$_POST['UslugiAdd'].",".$_SESSION['ks'].")");
		if($ktv->QRow("select count(id) from uslugi where name='".$_POST['name']."'")==0)
			$ktv->Query("insert into uslugi (name,cena) values ('".$_POST['name']."',".$_POST['cena'].")");
		}

	$uslugi=$ktv->QueryObjectArray("select * from uslugi order by name");
	if(count($uslugi)>0)
		foreach($uslugi as $us) $UsSelectSpisok.="<DD><A HREF='javascript:'><SPAN>".$us->name."</SPAN> (<B>".$us->cena."</B> руб.)</A>";


	$uslugi=$ktv->QueryObjectArray("select * from abonentka where tip=1 and id_abonent=".$abonent->id." order by id");
	if(count($uslugi)>0)
		{
		$usSpisok="<TABLE cellspacing=0 cellpadding=0 id=spisok bgcolor=#E3ECE5>";
			$usSpisok.="<TH>&nbsp;";
			$usSpisok.="<TH>Наименование";
			$usSpisok.="<TH>Сумма";
			$usSpisok.="<TH>Баланс";
			$usSpisok.="<TH>Дата внесения";
			$usSpisok.="<TH>Администратор";
			$usSpisok.="<TH>Примечание";

		$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");

		foreach($uslugi as $n=>$us)
			{
			$usSpisok.="<TR>";
			$usSpisok.="<TD align=right><U>".($n+1)."</U>";
			$usSpisok.="<TD>".$us->name;
			$usSpisok.="<TD align=center><B>".$us->money."</B>";
			$usSpisok.="<TD align=center>".$us->balans;
			$usSpisok.="<TD align=right>".Data($us->dtime_add);
			$usSpisok.="<TD align=center>".$admin[$us->admin_add];
			$usSpisok.="<TD align=left>".($us->prim?$us->prim:'&nbsp;');
			}
		$usSpisok.="</TABLE>";
		}
	else $usSpisok.="<DIV class=msgEmpty>Списания средств за услуги отсутствуют.</DIV>";
	}
else header("Location: /nopage");
?>
