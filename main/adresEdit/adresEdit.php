<?php
$gorodArr=$ktv->QueryObjectArray("select * from adres_gorod where id in (".$kassir->rule_gorod_allow.") order by name");
if(count($gorodArr)>0)
	foreach($gorodArr as $g) $gorod.="<A HREF='javascript:' onclick=adresUlicaGet(".$g->id.",this); class=aNaim".($gorodArr[0]->id==$g->id?"Sel":'').">".$g->name."</A>";

if($gorod)
	{
	$idUlica=$ktv->QRow("select id,name from adres_ulica where id_gorod=".$gorodArr[0]->id." order by name limit 1");
	$ulicaArr=$ktv->QueryObjectArray("select * from adres_ulica where id_gorod=".$gorodArr[0]->id." order by name");
	if(count($ulicaArr)>0)
		foreach($ulicaArr as $u) $ulica.="<A HREF='javascript:' onclick=adresDomGet(".$u->id.",this); class=aNaim".($idUlica==$u->id?"Sel":'').">".$u->name."</A>";

	if($ulica)
		{
		$domArr=$ktv->QueryObjectArray("select num from adres_dom where id_ulica=".$idUlica." order by num");
		if(count($domArr)>0)
			{
			$dom="<DL>";
			foreach($domArr as $d) $dom.="<DD>".preg_replace("/^0{1,}/",'',$d->num);
			$dom.="</DL>";
			}
		}
	}
else $gorod="<SPAN>населённых пунктов нет</SPAN>";
if(!$ulica) $ulica="<SPAN>улиц нет</SPAN>";
if(!$dom) $dom="<SPAN>домов нет</SPAN>";
?>
