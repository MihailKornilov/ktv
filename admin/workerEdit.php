<?php
if(!$kassir->rule_panel_admin) header("Location: /nopage");

$gorodArr=$ktv->QueryObjectArray("select * from adres_gorod order by name");

if($_POST['idWorker'])
	{
	foreach($gorodArr as $g) if($_POST['gorod'.$g->id]==1) $rule_gorod_allow.=$g->id.",";

	$ktv->Query("update admin set 
fio='".$_POST['fio']."',
adres='".$_POST['adres']."',
telefon='".$_POST['telefon']."',
rule_remont=".$_POST['rule_remont'].",

login='".$_POST['login']."',
".($_POST['pass']?"pass=password('".$_POST['pass']."'),":'')."

rule_enter=".$_POST['rule_enter'].",
rule_path_save=".$_POST['rule_path_save'].",

rule_panel_admin=".$_POST['rule_panel_admin'].",
rule_gorod_allow='".$rule_gorod_allow."0',
rule_gorod_add=".$_POST['rule_gorod_add'].",
rule_report_view=".$_POST['rule_report_view'].",
rule_abon_calc=".$_POST['rule_abon_calc']."

where id=".$_POST['idWorker']);
	}
$worker=$ktv->QueryObjectOne("select * from admin where id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if(!$worker->rule_enter) $panelEnter="<STYLE>.panelEnter { display:none; }</STYLE>";

foreach(explode(',',$worker->rule_gorod_allow) as $val) $ruleG[$val]=1;
if(count($gorodArr)>0)
	foreach($gorodArr as $g) $punkt.="<P>".CheckBox('gorod'.$g->id,$ruleG[$g->id]?1:0,$g->name,1);
?>
