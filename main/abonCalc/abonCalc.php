<?php
if($kassir->rule_abon_calc==0) header("Location: /nopage");
$jetzMon=abs(strftime("%m",time()));
$abSelectMon="<DT>".fullmonth($jetzMon);
for($n=1;$n<=12;$n++) $abSelectMon.="<DD><A HREF='javascript:'>".fullmonth($n)."</A>";

$jetzYear=strftime("%Y",time());
$abSelectYear="<DT>".$jetzYear;
for($n=2005;$n<=$jetzYear+1;$n++) $abSelectYear.="<DD><A HREF='javascript:'>".$n."</A>";


foreach(explode(',',$kassir->rule_gorod_allow) as $val) $ruleG[$val]=1;
$gorodArr=$ktv->QueryObjectArray("select * from adres_gorod order by name");
$punkt="<DL id=calcGorod>";
if(count($gorodArr)>0)
	foreach($gorodArr as $g) $punkt.=($ruleG[$g->id]?"<DD><INPUT TYPE=hidden value='".$g->id."'>".CheckBox('',1,$g->name,1):'');
$punkt.="</DL>";
?>
