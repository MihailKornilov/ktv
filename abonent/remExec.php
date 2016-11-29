<?php
$abonent=$ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if($abonent->id)
	{
	$rem=$ktv->QueryObjectOne("select * from remont where id_abonent=".$abonent->id." and id=".(preg_match("|^[\d]+$|",$_GET['rem'])?$_GET['rem']:'0'));
	if($rem->id)
		if($rem->status==2) header("Location: /ab".$abonent->id."/remont");
		else
			{
			$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");
			
			$prim=$ktv->QueryObjectArray("select * from remont_prim where id_remont=".$rem->id." order by id");
			if(count($prim)>0)
				{
				$primSpisok="<TABLE cellspacing=0 cellpadding=0>";
				$primSpisok.="<CAPTION>История примечаний:<CAPTION>";
				foreach($prim as $p) $primSpisok.="<TR><TD><STRONG>".$p->prim."</STRONG><TD>".$admin[$p->admin_add]."<TD align=right>".Data($p->dtime_add);
				$primSpisok.="</TABLE>";
				}
			if($rem->status==1) $sotrudniki="<TR><TH>Сотрудники:<TD><H3>".($rem->sotrudniki?$rem->sotrudniki:'-')."</H3>";
			}
	}
else header("Location: /nopage");
?>
