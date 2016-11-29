<?php
$abonent=$ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if($abonent->id)
	{
	$logAb=$ktv->QueryObjectArray("select * from abonent_log where id_abonent=".$abonent->id." order by dtime desc");
	if(count($logAb)>0)
		{
		$logSpisok="<TABLE cellspacing=0 cellpadding=0 id=spisok bgcolor=#E3ECE5>";
			$logSpisok.="<TH>&nbsp;";
			$logSpisok.="<TH>Действие";
			$logSpisok.="<TH>Значение";
			$logSpisok.="<TH>Дата";
			$logSpisok.="<TH>Администратор";

		$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");
		foreach($logAb as $n=>$log)
			{
			$logSpisok.="<TR>";
			$logSpisok.="<TD align=right><U>".($n+1)."</U>";
			$logSpisok.="<TD><B>".$log->action."</B>";
			$logSpisok.="<TD>".($log->value_old?"<CODE>".$log->value_old."</CODE><i>-></i>":'')."<CODE>".$log->value_new."</CODE>";
			$logSpisok.="<TD align=right>".Data($log->dtime);
			$logSpisok.="<TD align=center>".$admin[$log->id_admin];
			}
		$logSpisok.="</TABLE>";
		}
	else $logSpisok.="<DIV class=msgEmpty>Действия не производились.</DIV>";
	}
else header("Location: /nopage");
?>
