<?php
include_once('../include/conf.php');
session_name($session);
session_start();
if($_SESSION['ks'])
	{
	require_once('../include/clsMsDocGenerator.php');
	require_once('../include/functions_date.php');
	require_once('../include/FUNCTIONS.php');
	include_once('../include/class_MysqlDB.php');
	
	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
	$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);
	
	$podkl=$ktv->QueryObjectArray("select * from abonent abonent where date_podkl='".$kassir->otchet_day."' ".($kassir->rule_report_view==0?" and admin_add=".$_SESSION['ks']:'')." order by id");
	if(count($podkl)>0)
		{
		$table="<H1>Отчёт по абонентам, подключённых ".realday($kassir->otchet_day)."<H1>";
		$table.="<TABLE cellspacing=0 cellpadding=0 id=OpSpisok>";
			$table.="<TR>";
			$table.="<TH>№";
			$table.="<TH>Абонент";
			$table.="<TH>Адрес";

		foreach($podkl as $n=>$p)
			{
			$table.="<TR>";
			$table.="<TD align=right style=border-left-style:solid;".($n<count($podkl)-1?'':"border-bottom-style:solid;").">".($n+1);
			$table.="<TD".($n<count($podkl)-1?'':" style=border-bottom-style:solid;").">".$p->f." ".$p->i." ".$p->o;
			$table.="<TD style=border-right-style:solid;".($n<count($podkl)-1?'':"border-bottom-style:solid;").">".AdresSmall(0,$p->adres_gorod_name,$p->adres_ulica_name,$p->adres_dom_num,$p->adres_kv);
			}
		$table.="</TABLE>";

		$table.="<H6><TABLE cellspacing=0 cellpadding=0><TR><TD>Администратор: <B>".$kassir->fio."</B> __________________<TD align=right style=width:200pt;>Дата: ___/___/______г.</TABLE></H6>";

		$doc = new clsMsDocGenerator($pageOrientation='PORTRAIT',    $pageType='A4',    $cssFile='otchet_doc.css',    $topMargin=1.0,    $rightMargin=1.0,    $bottomMargin=1.0,    $leftMargin=1.0);
		$doc->addParagraph($table);
		$doc->output("oplata_".$kassir->otchet_day);
		}
	}
?>
