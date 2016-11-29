<?php
$abonent=$ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if($abonent->id)
	{
	if($_POST['remontAdd'] and $KtvKassirDemo==0)
		{
		$ktv->Query("insert into remont (id_abonent,name,admin_add) values (".$_POST['remontAdd'].",'".$_POST['name']."',".$_SESSION['ks'].")");
		$id=$ktv->QRow("select id from remont where id_abonent=".$abonent->id." and status=2 order by id desc limit 1");
		if($_POST['prim']) $ktv->Query("insert into remont_prim (id_remont,prim,admin_add) values (".$id.",'".$_POST['prim']."',".$_SESSION['ks'].")");
		$ktv->Query("insert into abonent_log (action,value_new,id_abonent,id_admin) values ('Заявка на неисправность','<A HREF=\'/ab".$abonent->id."/remont/".$id."\'>".$_POST['name']."</A>',".$_POST['remontAdd'].",".$_SESSION['ks'].")");
		if($ktv->QRow("select count(id) from remont_var where name='".$_POST['name']."'")==0) $ktv->Query("insert into remont_var (name) values ('".$_POST['name']."')");
		}

	$rem=$ktv->QueryObjectOne("select * from remont where id_abonent=".$abonent->id." and status=2");
	if($rem->id)
		{
		if($_POST['remontSave'] and $KtvKassirDemo==0)
			{
			$ktv->Query("update remont set status=".($_GET['del']?3:1).",admin_red=".$_SESSION['ks'].",dtime_red=current_timestamp".($_GET['del']?'':",sotrudniki='".$_POST['name']."'")." where id=".$_POST['remontSave']);
			if($_POST['prim']) $ktv->Query("insert into remont_prim (id_remont,prim,admin_add) values (".$_POST['remontSave'].",'".$_POST['prim']."',".$_SESSION['ks'].")");
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение статуса заявки<BR><A HREF=\'/ab".$abonent->id."/remont/".$rem->id."\'>".$rem->name."</A>','".rmStatus(2)."','".rmStatus($_GET['del']?3:1)."',".$abonent->id.",".$_SESSION['ks'].")");
			if($_GET['del']) header("Location: /ab".$abonent->id."/remont/".$rem->id);
			}
		else
			{
			$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");
			$workers=$ktv->QueryObjectArray("select fio from admin where rule_remont=1 order by fio");
			if(count($workers)>0)
				foreach($workers as $w) $zWorkersSpisok.="<DD><A HREF='javascript:'>".$w->fio."</A>";
			else $zWorkersSpisok.="<DD><A HREF='javascript:'><I>список пуст</I></A>";
			
			$prim=$ktv->QueryObjectArray("select * from remont_prim where id_remont=".$rem->id." order by id");
			if(count($prim)>0)
				{
				$primSpisok="<TABLE cellspacing=0 cellpadding=0>";
				$primSpisok.="<CAPTION>История<CAPTION>";
				foreach($prim as $p) $primSpisok.="<TR><TD><STRONG>".$p->prim."</STRONG><TD>".$admin[$p->admin_add]."<TD>".Data($p->dtime_add);
				$primSpisok.="</TABLE>";
				}
			}
		}
	else
		{
		$remontVar=$ktv->QueryObjectArray("select * from remont_var order by name");
		if(count($remontVar)>0)
			foreach($remontVar as $rm) $zSelectSpisok.="<DD><A HREF='javascript:'>".$rm->name."</A>";
		else $zSelectSpisok.="<DD><A HREF='javascript:'><I>пусто</I></A>";
		}

	$remont=$ktv->QueryObjectArray("select * from remont where status!=2 and id_abonent=".$abonent->id);
	if(count($remont)>0)
		{
		$zSpisok.="<TABLE cellspacing=0 cellpadding=0 id=spisok bgcolor=#E3ECE5>";
			$zSpisok.="<TH>&nbsp;";
			$zSpisok.="<TH>Наименование";
			$zSpisok.="<TH>Статус";
			$zSpisok.="<TH>Дата выполнения";

		foreach($remont as $n=>$rm)
			{
			$zSpisok.="<TR".($rm->status==3?' style=color:#777':'').">";
			$zSpisok.="<TD align=right><U>".($n+1)."</U>";
			$zSpisok.="<TD><A HREF='/ab".$abonent->id."/remont/".$rm->id."'".($rm->status==0?' style=color:#777':'').">".$rm->name."</A>";
			$zSpisok.="<TD>".rmStatus($rm->status);
			$zSpisok.="<TD align=right>".Data($rm->dtime_red);
			}
		$zSpisok.="</TABLE>";
		}
	else $zSpisok.="<DIV class=msgEmpty>Выполненных заявок нет.</DIV>";
	}
else header("Location: /nopage");
?>
