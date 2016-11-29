<?php
if(!$kassir->rule_panel_admin) header("Location: /nopage");

$lgota=$ktv->QueryObjectArray("select * from lgota order by id");
if(count($lgota)>0)
	{
	$lgotaSpisok="<TABLE cellpadding=0 cellspacing=0 id=spisok bgcolor=#E4F1E7>";
	$lgotaSpisok.="<TR>";
	$lgotaSpisok.="<TH>Наименование";
	$lgotaSpisok.="<TH>Изменение абонентской платы";
	$lgotaSpisok.="<TH>Абоненты";
	$lgotaSpisok.="<TH>Описание";
	$lgotaSpisok.="<TH>&nbsp;";
	
	foreach($lgota as $lg)
		{
		switch($lg->tip)
			{
			case '1': $tip="Скидка ".$lg->value."%"; break;
			case '2': $tip="Скидка ".$lg->value." руб."; break;
			case '3': $tip="Сумма = ".$lg->value." руб."; break;
			}
		$lgotaSpisok.="<TR>";
		$lgotaSpisok.="<TD><B>".$lg->name."</B>";
		$lgotaSpisok.="<TD>".$tip;
		$lgotaSpisok.="<TD align=center><A HREF=''>".$ktv->QRow("select count(id) from abonent where lgota=".$lg->id)."</A>";
		$lgotaSpisok.="<TD width=250><I>".$lg->about."</I>";
		$lgotaSpisok.="<TD><A HREF='/admin/lgota/".$lg->id."'>редактировать</A>";
		}
	$lgotaSpisok.="</TABLE>";
	}
?>
