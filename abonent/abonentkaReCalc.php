<?php
$abonent=$ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if($abonent->id)
	{
	$abPlat=$ktv->QueryObjectOne("select * from abonentka where tip=0 and id_abonent=".$abonent->id." and id=".(preg_match("|^[\d]+$|",$_GET['re'])?$_GET['re']:'0'));
	if($abPlat->id)
		{
		if($_POST['ReAbon'] and $KtvKassirDemo==0)
			{
			$abonent->balans+=$_POST['MoneyOld']-$_POST['money'];
			$ktv->Query("update abonentka set money=".$_POST['money'].",balans=".$abonent->balans.",prim='Перерасчёт от ".realday(strftime("%Y-%m-%d",time()))."<BR>".($_POST['prim']?"Причина: ".$_POST['prim']."<BR>":'')."Произвёл: ".$kassir->fio."' where id=".$_POST['Reid']);
			$ktv->Query("update abonent set balans=".$abonent->balans." where id=".$_POST['ReAbon']);
			$ktv->Query("insert into abonent_log (action,value_new,id_abonent,id_admin) values ('Перерасчёт абонентской<BR>платы за ".$monTxt."','Новая сумма: <B>".$_POST['money']."</B>, баланс: ".$abonent->balans."',".$_POST['ReAbon'].",".$_SESSION['ks'].")");
			}
		$adminName=$ktv->QRow("select fio from admin where id=".$abPlat->admin_add);
		$data=explode("-",$abPlat->month);
		}
	}
else header("Location: /nopage");
?>
