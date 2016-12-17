<?php
$abonent = $ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if($abonent->id)
	{
	if($_POST['oplataAdd'] and $KtvKassirDemo==0) {
		$balans = $abonent->balans + $_POST['money'];

		$sql = "SELECT `bonus_procent` FROM `setup`";
		$bonus_procent = $ktv->QRow($sql);
		$bonus_sum = round($_POST['money'] * $bonus_procent / 100, 2);

		$sql = "INSERT INTO `oplata` (
					`money`,
					`id_abonent`,
					`tip`,
					`prim`,
					`admin_add`,
					`balans`,
					`bonus_procent`,
					`bonus_sum`
				) VALUES (
					".$_POST['money'].",
					".$abonent->id.",
					".$_POST['oplataTip'].",
					'".$_POST['prim']."',
					".$_SESSION['ks'].",
					".$balans.",
					".$bonus_procent.",
					".$bonus_sum."
				)";
		$ktv->Query($sql);

		$sql = "SELECT SUM(`bonus_sum`)
				FROM `oplata`
				WHERE `status`
				  AND `id_abonent`=".$abonent->id;
		$bonus_sum = $ktv->QRow($sql);
		$abonent->bonus_sum = $bonus_sum;

		$sql = "UPDATE `abonent`
				SET `balans`=".$balans.",
					`bonus_sum`=".$bonus_sum."
				WHERE id=".$abonent->id;
		$ktv->Query($sql);

		$sql = "INSERT INTO `abonent_log` (
					`action`,
					`value_new`,
					`id_abonent`,
					`id_admin`
				) VALUES (
					'Пополнение счёта',
					'Сумма: <B>".$_POST['money']."</B>, баланс: ".$balans."',
					".$abonent->id.",
					".$_SESSION['ks']."
				)";
		$ktv->Query($sql);
	}

	$opTip=$ktv->QueryObjectArray("select * from oplata_tip order by sort");
	$oplataTip="<DIV id=mySelOplata><DL>";
	$oplataTip.="<DT><TABLE cellspacing=0 cellpadding=0><TR><TD width=100%><P style=background:#".$opTip[0]->bg.">".$opTip[0]->name."<TD><B>v</B></TABLE>";
	if(count($opTip)>0)
		foreach($opTip as $op) 
			$oplataTip.="<DD><A HREF='javascript:' style='background:#".$op->bg.";' onclick=mySelectSet(this,".$op->id.");>".$op->name."</A>";
	$oplataTip.="</DL></DIV>";
	

	$oplata=$ktv->QueryObjectArray("select * from oplata where status=1 and id_abonent=".$abonent->id);
	if(count($oplata))
		{
		$opSpisok="<TABLE cellspacing=0 cellpadding=0 id=spisok>";
		$opSpisok.="<TH>&nbsp;";
		$opSpisok.="<TH>Сумма";
		$opSpisok.="<TH>Вид";
		$opSpisok.="<TH>Баланс";
		$opSpisok.="<TH>Дата";
		$opSpisok.="<TH>Администратор";
		$opSpisok.="<TH>Примечание";

		$tipBg=$ktv->QueryPtPArray("select id,bg from oplata_tip order by id");
		$tipName=$ktv->QueryPtPArray("select id,name from oplata_tip order by id");
		$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");

		foreach($oplata as $n=>$op) {
			$bonus = '';
			if($op->bonus_procent)
				$bonus =
					' <span class="fs10 grey">'.
						'+'.round($op->bonus_sum, 2).
//						' (бонус '.$op->bonus_procent.'%)'.
					'</span>';

			$opSpisok.="<TR align=center bgcolor=#".$tipBg[$op->tip].">";
			$opSpisok.="<TD align=right><U>".($n+1)."</U>";
			$opSpisok.="<TD><B class='fs11'>".$op->money."</B>".$bonus;
			$opSpisok.="<TD>".$tipName[$op->tip];
			$opSpisok.="<TD>".$op->balans;
			$opSpisok.="<TD align=right>".Data($op->dtime_add);
			$opSpisok.="<TD>".$admin[$op->admin_add];
			$opSpisok.="<TD align=left>".($op->prim?$op->prim:'&nbsp;');
		}
		$opSpisok.="</TABLE>";
	} else
		$opSpisok="<DIV class=msgEmpty>Платежи не производились.</DIV>";
} else
	header("Location: /nopage");
