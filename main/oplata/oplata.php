<?php
if(preg_match("|^[\d]+$|",$_GET['id']) and $KtvKassirDemo==0)
	{
	$op=$ktv->QueryObjectOne("select * from oplata where status=1 and id=".$_GET['id']." and admin_add=".$_SESSION['ks']." and dtime_add LIKE '".strftime('%Y-%m-%d',time())."%'");
	if($op->id)
		{
		$ktv->Query("update oplata set status=0,dtime_del=current_timestamp,admin_del=".$_SESSION['ks']." where id=".$_GET['id']);

		$sql = "SELECT SUM(`money`)
				FROM `abonentka`
				WHERE `id_abonent`=".$op->id_abonent;
		$abMoney = $ktv->QRow($sql);

		$sql = "SELECT
					SUM(`money`) `money`,
					SUM(`bonus_sum`) `bonus`
				FROM `oplata`
				WHERE `status`
				  AND `id_abonent`=".$op->id_abonent;
		$oplata = $ktv->QueryObjectOne($sql);

		$sql = "UPDATE `abonent`
				SET `balans`=".($oplata->money - $abMoney).",
					`bonus_sum`=".$oplata->bonus."
				WHERE id=".$op->id_abonent;
		$ktv->Query($sql);

		$ktv->Query("insert into abonent_log (action,value_new,id_abonent,id_admin) values ('Удаление платежа','Сумма: <B>".$op->money."</B>, баланс: ".$balans."',".$op->id_abonent.",".$_SESSION['ks'].")");
		$msg="<DIV id=msgOk>Платёж удалён. <A HREF='/oplata'><B>OK</B></A>.</DIV>";
		}
	}


$oplata=$ktv->QueryObjectArray("select * from oplata where status=1 and admin_add=".$_SESSION['ks']." and dtime_add LIKE '".strftime('%Y-%m-%d',time())."%' order by id");
if(count($oplata)>0)
	{
	$oplataSpisok="<CENTER id=numbers><SPAN>Список платежей за сегодня:</SPAN></CENTER>";
	$oplataSpisok.="<CENTER>";
	$oplataSpisok.="<TABLE cellspacing=0 cellpadding=0 id=spisok>";
		$oplataSpisok.="<TH>&nbsp;";
		$oplataSpisok.="<TH>Абонент";
		$oplataSpisok.="<TH>Адрес";
		$oplataSpisok.="<TH>Сумма";
		$oplataSpisok.="<TH>Дата";
		$oplataSpisok.="<TH>Вид";
		$oplataSpisok.="<TH>&nbsp;";

	$tipBg=$ktv->QueryPtPArray("select id,bg from oplata_tip order by id");
	$tipName=$ktv->QueryPtPArray("select id,name from oplata_tip order by id");

	foreach($oplata as $n=>$op)
		{
		$abon=$ktv->QueryObjectOne("select * from abonent where id=".$op->id_abonent);
		$oplataSpisok.="<TR bgcolor=#".$tipBg[$op->tip].">";
		$oplataSpisok.="<TD align=right>".($n+1);
		$oplataSpisok.="<TD><A HREF='/ab".$abon->id."'>".$abon->f." ".$abon->i." ".$abon->o."</A>";
		$oplataSpisok.="<TD>".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
		$oplataSpisok.="<TD align=right><B>".$op->money."</B>&nbsp;";
		$oplataSpisok.="<TD align=right>".Data($op->dtime_add);
		$oplataSpisok.="<TD align=center>".$tipName[$op->tip];
		$oplataSpisok.="<TD width=40><A HREF='#' onclick=OplataDel(".$op->id.");><IMG SRC=/img/del.gif></A>";
			$oplataSpisok.="<A HREF='javascript:' onclick=window.open('/main/oplata/oplataKvitPrint.php?id=".$op->id."','','top=30,left=40,height=470,width=410,scrollbars=no')><IMG SRC=/img/printer16.gif></A>";
		}
	$oplataSpisok.="</TABLE></CENTER>";
	}
else $oplataSpisok="<CENTER>Платежи за сегодня отсутствуют.</CENTER>";
?>
