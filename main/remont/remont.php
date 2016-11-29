<?php
switch($_GET['status'])
	{
	case 3: $status="where status=3 "; $remStatus=3; break;
	case 1: $status="where status=1 "; $remStatus=1; break;
	case 2: $status="where status=2 "; $remStatus=2; break;
	default: $status='';
	}

$remont=$ktv->QueryObjectArray("select * from remont ".$status."order by id");
if(count($remont)>0)
	{
	$remontSpisok="<TABLE cellspacing=0 cellpadding=0 id=spisok bgcolor=#E3ECE5>";
		$remontSpisok.="<TH>&nbsp;";
		$remontSpisok.="<TH>Абонент";
		$remontSpisok.="<TH>Адрес";
		$remontSpisok.="<TH>Причина";
		$remontSpisok.="<TH>Статус";
		$remontSpisok.="<TH>Дата внесения";
		$remontSpisok.="<TH>Примечание";

	foreach($remont as $n=>$rm)
		{
		$abon=$ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".$rm->id_abonent);
		if($abon->id)
			{
			$remontSpisok.="<TR>";
			$remontSpisok.="<TD align=right><U>".($n+1)."</U>";
			$remontSpisok.="<TD>".$abon->f." ".$abon->i." ".$abon->o;
			$remontSpisok.="<TD>".AdresSmall(0,$abon->adres_gorod_name,$abon->adres_ulica_name,$abon->adres_dom_num,$abon->adres_kv);
			$remontSpisok.="<TD><A HREF='/ab".$abon->id."/remont".($rm->status!=2?"/".$rm->id:'')."'".($rm->status==3?' style=color:#777':'').">".$rm->name."</A>";
			$remontSpisok.="<TD>".rmStatus($rm->status);
			$remontSpisok.="<TD align=right>".Data($rm->dtime_add);
			$remontSpisok.="<TD id=td".$rm->id."><EM>".$rm->prim."</EM>";
			if($rm->status==2) $remontSpisok.="<EM><A HREF='javascript:' onclick=RemPrimGet(".$rm->id.");>изменить</A></EM>";
			}
		}
	$remontSpisok.="</TABLE>";
	}
else $remontSpisok="<DIV id=msgEmpty><B>Список пуст.</B></DIV>";
?>
