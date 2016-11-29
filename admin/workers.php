<?php
if(!$kassir->rule_panel_admin) header("Location: /nopage");

$workers=$ktv->QueryObjectArray("select * from admin order by id");
if(count($workers)>0)
	{
	$workSpisok="<TABLE cellpadding=0 cellspacing=0 id=spisok bgcolor=#E4F1E7>";
	$workSpisok.="<CAPTION>Список сотрудников</CAPTION>";
	$workSpisok.="<TR><TH>ФИО<TH>Адрес проживания<TH>Контактные телефоны<TH>&nbsp;";
	foreach($workers as $work)
		{
		$workSpisok.="<TR>";
		$workSpisok.="<TD>".$work->fio."&nbsp;";
		$workSpisok.="<TD>".$work->adres."&nbsp;";
		$workSpisok.="<TD>".$work->telefon."&nbsp;";
		$workSpisok.="<TD><A HREF='/admin/workers/".$work->id."'><IMG SRC='/img/workerEdit.gif'></A>";
		}
	$workSpisok.="</TABLE>";
	}
?>
