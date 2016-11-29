<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../../include/conf.php');
session_name($session);
session_start();
include_once('../../include/class_MysqlDB.php');
include_once('../../include/functions_date.php');
include_once('../../include/FUNCTIONS.php');

$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);

// ----------------===== НАПРАВЛЕНИЕ СОРТИРОВКИ =====--------------------- ///////////
$find=$ktv->QueryObjectOne("select abcalc_sort,abcalc_direct from abonent_find where name='default' and admin=".$_SESSION['ks']);
if($_GET['abcalc_sort'])
	if($_GET['abcalc_sort']==$find->abcalc_sort)
		$direct=($find->abcalc_direct?'':'desc');
	else $direct='';

// ----------------===== ОБНОВЛЕНИЕ ПОИСКОВОЙ ИНФОРМАЦИИ =====--------------------- ///////////
$ktv->Query("update abonent_find set 
".($_GET['abcalc_sort']?"abcalc_sort=".$_GET['abcalc_sort'].",abcalc_direct='".$direct."',":'')." 
".($_GET['abcalc_page']?"abcalc_page=".$_GET['abcalc_page'].",":'')." 
f_gorod=0 
where name='default' and admin=".$_SESSION['ks']);



$find=$ktv->QueryObjectOne("select * from abonent_find where name='default' and admin=".$_SESSION['ks']);

$q="adres_gorod in (".$_GET['gorod'].")";
//if($find->f_gorod>0) $q.=" and adres_gorod=".$find->f_gorod;

//if($find->f_status>0) $q.=" and status=".$find->f_status;

switch($find->abcalc_sort)
	{
	case 2: $sort="f ".$find->abcalc_direct.",i ".$find->abcalc_direct.",o ".$find->abcalc_direct; break;
	case 3: $sort="adres_gorod_name ".$find->abcalc_direct.",adres_ulica_name ".$find->abcalc_direct.",adres_dom_num ".$find->abcalc_direct.",adres_kv ".$find->abcalc_direct; break;
	case 10: $sort="status ".$find->abcalc_direct; break;
	case 11: $sort="abonentka_sum ".$find->abcalc_direct; break;
	case 12: $sort="lgota ".$find->abcalc_direct; break;
	case 13: $sort="status ".$find->abcalc_direct.",lgota ".$find->abcalc_direct; break;
	default: $sort="id ".$find->abcalc_direct; break;
	}

$find->page=$find->abcalc_page;
$find->strok=200;

// ----------------===== ФОРМИРОВАНИЕ НАЗВАНИЯ МЕСЯЦА =====--------------------- ///////////
$data=explode('-',$_GET['month']);
$data=fullmonth($data[1])." ".$data[0];

switch ($_GET['calc'])
	{
	case 'calcGo':
		$head="<H3>Список абонентов для начисления абонентской платы за <B>".$data."</B>:</H3>";

		$status=$ktv->QueryPtPArray("select id,abon_calc from abonent_status order by id");
		$q.=" and abonentka_calc_month=0 and abonentka_sum>0 and abonentka_calc=1 and status in (0";
		if(count($status)>0) foreach($status as $id=>$st) if($st==1) $q.=",".$id;
		$q.=")";
		
		$abon=$ktv->QueryObjectArray("select * from abonent where ".$q." order by ".$sort." limit ".(($find->page-1)*$find->strok).",".$find->strok);
		if(count($abon)>0)
			{
			include('../../find/find_page_arrow.php');
			$spisok="<TABLE cellspacing=0 cellpadding=0 id=spisok bgcolor=#CEEBD4>";
				$spisok.="<TR><TH><EM onclick=findSpisokGet(2);>ФИО".($find->abcalc_sort==2?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";
				$spisok.="<TH><EM onclick=findSpisokGet(3);>Адрес".($find->abcalc_sort==3?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";
				$spisok.="<TH><EM onclick=findSpisokGet(11);>Сумма".($find->abcalc_sort==11?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";
				$spisok.="<TH><EM onclick=findSpisokGet(12);>Льгота".($find->abcalc_sort==12?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";

			$lgota=$ktv->QueryPtPArray("select id,name from lgota order by id");
			foreach($abon as $ab)
				{
				$spisok.="<TR>";
				$spisok.="<TD><A HREF='/ab".$ab->id."/abonentka'>".$ab->f." ".$ab->i." ".$ab->o."</A>";
				$spisok.="<TD>".AdresSmall(0,$ab->adres_gorod_name,$ab->adres_ulica_name,$ab->adres_dom_num,$ab->adres_kv);
				$spisok.="<TD align=right><B>".$ab->abonentka_sum."&nbsp;</B>";
				$spisok.="<TD>".($ab->lgota>0?$lgota[$ab->lgota]:'&nbsp;');
				}
			$spisok.="</TABLE>";
			echo "<DIV id=numbers>".$head.$NumRow.$Numbers."</DIV>".$spisok;
			}
		else echo "<DIV id=numbers>".$head."<SPAN>Ничего не найдено.</SPAN></DIV>";
		break;

	



	case 'calcYes':
		$head="<H3>Список абонентов, которым произведено начисление за <B>".$data."</B>:</H3>";
		$q.=" and abonentka_calc_month=1";
		$abon=$ktv->QueryObjectArray("select * from abonent where ".$q." order by ".$sort." limit ".(($find->page-1)*$find->strok).",".$find->strok);
		if(count($abon)>0)
			{
			include('../../find/find_page_arrow.php');
			$spisok="<TABLE cellspacing=0 cellpadding=0 id=spisok bgcolor=#CEEBD4>";
				$spisok.="<TR><TH><EM onclick=findSpisokGet(2);>ФИО".($find->abcalc_sort==2?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";
				$spisok.="<TH><EM onclick=findSpisokGet(3);>Адрес".($find->abcalc_sort==3?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";
				$spisok.="<TH>Сумма";
				$spisok.="<TH>Администратор";

			$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");
			foreach($abon as $ab)
				{
				$calc=$ktv->QueryObjectOne("select * from abonentka where id_abonent=".$ab->id." and tip=0 and month='".$_GET['month']."'");
				$spisok.="<TR>";
				$spisok.="<TD><A HREF='/ab".$ab->id."/abonentka'>".$ab->f." ".$ab->i." ".$ab->o."</A>";
				$spisok.="<TD>".AdresSmall(0,$ab->adres_gorod_name,$ab->adres_ulica_name,$ab->adres_dom_num,$ab->adres_kv);
				$spisok.="<TD align=right><B>".$calc->money."&nbsp;</B>";
				$spisok.="<TD>".($calc->admin_add>0?$admin[$calc->admin_add]:'&nbsp;').($calc->auto==1?"<IMG SRC=/img/abon_calc_auto.gif>":'');
				}
			$spisok.="</TABLE>";
			echo "<DIV id=numbers>".$head.$NumRow.$Numbers."</DIV>".$spisok;
			}
		else echo "<DIV id=numbers>".$head."<SPAN>Ничего не найдено.</SPAN></DIV>";
		break;


	
	
	
	case 'calcNo':
		$head="<H3>Список абонентов, которым не производится начисление за <B>".$data."</B>:</H3>";

		$status=$ktv->QueryPtPArray("select id,abon_calc from abonent_status order by id");
		$q.=" and abonentka_calc_month=0 and (abonentka_sum=0 or abonentka_calc=0 or status in (0";
		if(count($status)>0) foreach($status as $id=>$st) if($st==0) $q.=",".$id;
		$q.="))";

		$abon=$ktv->QueryObjectArray("select * from abonent where ".$q." order by ".$sort." limit ".(($find->page-1)*$find->strok).",".$find->strok);
		if(count($abon)>0)
			{
			include('../../find/find_page_arrow.php');
			$spisok="<TABLE cellspacing=0 cellpadding=0 id=spisok bgcolor=#CEEBD4>";
				$spisok.="<TR><TH><EM onclick=findSpisokGet(2);>ФИО".($find->abcalc_sort==2?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";
				$spisok.="<TH><EM onclick=findSpisokGet(3);>Адрес".($find->abcalc_sort==3?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";
				$spisok.="<TH><EM onclick=findSpisokGet(13);>Причина".($find->abcalc_sort==13?"<IMG SRC=/img/arrow_".$find->abcalc_direct.".gif>":'')."</EM>";

			$statusName=$ktv->QueryPtPArray("select id,name from abonent_status where abon_calc=0 order by id");
			$statusBg=$ktv->QueryPtPArray("select id,bg from abonent_status where abon_calc=0 order by id");
			$lgota=$ktv->QueryPtPArray("select id,name from lgota order by id");
			foreach($abon as $ab)
				{
				$spisok.="<TR>";
				$spisok.="<TD><A HREF='/ab".$ab->id."/abonentka'>".$ab->f." ".$ab->i." ".$ab->o."</A>";
				$spisok.="<TD>".AdresSmall(0,$ab->adres_gorod_name,$ab->adres_ulica_name,$ab->adres_dom_num,$ab->adres_kv);
				if($statusName[$ab->status]) $spisok.="<TD style=background:#".$statusBg[$ab->status].">".$statusName[$ab->status];
				else
					if($ab->lgota>0) $spisok.="<TD>".$lgota[$ab->lgota];
					else
						if($ab->abonentka_calc==0) $spisok.="<TD>не начислять";
						else
							if($ab->abonentka_sum==0) $spisok.="<TD>сумма абонентки = 0";
							else $spisok.="<TD><I>не известна</I>";
				}
			$spisok.="</TABLE>";
			echo "<DIV id=numbers>".$head.$NumRow.$Numbers."</DIV>".$spisok;
			}
		else echo "<DIV id=numbers>".$head."<SPAN>Ничего не найдено.</SPAN></DIV>";
		break;
	}
?>
