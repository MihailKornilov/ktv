<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate");
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');

$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);

$kolonki=explode('-',$_GET['kolonki']);

$find=$ktv->QueryObjectOne("select sort,direct from abonent_find where name='default' and admin=".$_SESSION['ks']);
if($_GET['sort'])
	if($_GET['sort']==$find->sort)
		$direct=($find->direct?'':'desc');
	else $direct='';

$ktv->Query("update abonent_find set
f_gorod=".$_GET['gorod'].",
f_ulica=".$_GET['ulica'].",
f_dom=".$_GET['dom'].",
f_kv='".iconv("UTF-8", "WINDOWS-1251",$_GET['kv'])."',
f_fio_tel='".iconv("UTF-8", "WINDOWS-1251",$_GET['fio_tel'])."',
f_status=".$_GET['status'].",
v_telefon=".$kolonki[0].",
v_balans=".$kolonki[1].",
v_zayav=".$kolonki[2].",
v_podkl=".$kolonki[3].",
v_status=".$kolonki[4].",
v_prim=".$kolonki[5].",
".($_GET['page']?"page=".$_GET['page'].",":'')."
".($_GET['sort']?"sort=".$_GET['sort'].",direct='".$direct."',":'')."
strok=".$_GET['strok']."
where name='default' and admin=".$_SESSION['ks']);

$find=$ktv->QueryObjectOne("select * from abonent_find where name='default' and admin=".$_SESSION['ks']);

$q="adres_gorod in (".$kassir->rule_gorod_allow.")";
if($find->f_gorod>0) $q.=" and adres_gorod=".$find->f_gorod;
if($find->f_ulica>0) $q.=" and adres_ulica=".$find->f_ulica;
if($find->f_dom>0) $q.=" and adres_dom=".$find->f_dom;
if($find->f_kv) $q.=" and adres_kv like '%".$find->f_kv."%'";

if($find->f_status>0) $q.=" and status=".$find->f_status;
if($find->f_fio_tel) $q.=" and (f LIKE '%".$find->f_fio_tel."%' or i LIKE '%".$find->f_fio_tel."%' or o LIKE '%".$find->f_fio_tel."%' or tel_dom LIKE '%".$find->f_fio_tel."%' or tel_sot LIKE '%".$find->f_fio_tel."%')";

switch($find->sort)
	{
	case 2: $sort="f ".$find->direct.",i ".$find->direct.",o ".$find->direct; break;
	case 3: $sort="adres_gorod_name ".$find->direct.",adres_ulica_name ".$find->direct.",adres_dom_num ".$find->direct.",adres_kv ".$find->direct; break;
	case 4: $sort="balans ".$find->direct; break;
	case 5: $sort="date_zayav ".$find->direct; break;
	case 6: $sort="date_podkl ".$find->direct; break;
	case 10: $sort="status ".$find->direct; break;
	default: $sort="id ".$find->direct; break;
	}

$abon=$ktv->QueryObjectArray("select * from abonent where ".$q." order by ".$sort." limit ".(($find->page-1)*$find->strok).",".$find->strok);
if(count($abon)>0)
	{
	include('find_page_arrow.php');
	$spisok="<TABLE cellspacing=0 cellpadding=0 id=spisok>";
		$spisok.="<TR><TH width=40><EM onclick=findSpisokGet(1);>id".($find->sort==1?"<IMG SRC=/img/arrow_".$find->direct.".gif>":'')."</EM>";
		$spisok.="<TH><EM onclick=findSpisokGet(2);>ФИО".($find->sort==2?"<IMG SRC=/img/arrow_".$find->direct.".gif>":'')."</EM>";
		$spisok.="<TH>Город";
		$spisok.="<TH><EM onclick=findSpisokGet(3);>улица".($find->sort==3?"<IMG SRC=/img/arrow_".$find->direct.".gif>":'')."</EM>";
		$spisok.="<TH>дом";
		$spisok.="<TH>кв.";
//		$spisok.="<TH>договор";
		$spisok.="<TH>сбер";
		if($find->v_telefon) $spisok.="<TH>телефоны";
		if($find->v_balans) $spisok.="<TH><EM onclick=findSpisokGet(4);>баланс".($find->sort==4?"<IMG SRC=/img/arrow_".$find->direct.".gif>":'')."</EM>";
		if($find->v_zayav) $spisok.="<TH><EM onclick=findSpisokGet(5);>дата заявки".($find->sort==5?"<IMG SRC=/img/arrow_".$find->direct.".gif>":'')."</EM>";
		if($find->v_podkl) $spisok.="<TH><EM onclick=findSpisokGet(6);>дата подключения".($find->sort==6?"<IMG SRC=/img/arrow_".$find->direct.".gif>":'')."</EM>";
		if($find->v_status) $spisok.="<TH><EM onclick=findSpisokGet(10);>статус".($find->sort==10?"<IMG SRC=/img/arrow_".$find->direct.".gif>":'')."</EM>";
		if($find->v_prim) $spisok.="<TH>примечание";

	$statusName=$ktv->QueryPtPArray("select id,name from abonent_status order by sort");
	$statusBg=$ktv->QueryPtPArray("select id,bg from abonent_status order by id");
	foreach($abon as $ab)
		{
		$spisok.="<TR bgcolor=#".$statusBg[$ab->status].">";
		$spisok.="<TD style='padding:0;'><A HREF='/ab".$ab->id."' class=spisokid>".$ab->id."</A>";
		$spisok.="<TD>".(strlen($ab->prim)>0?"<IMG SRC=/img/prim.gif>":'');
		$spisok.=($ktv->Qrow("select count(id) from remont where status=2 and id_abonent=".$ab->id)>0?"<IMG SRC=/img/remont_clock.gif>":'');
		$spisok.=$ab->f." ".$ab->i." ".$ab->o;
		$spisok.="<TD>".$ab->adres_gorod_name;
		$spisok.="<TD>".$ab->adres_ulica_name;
		$spisok.="<TD align=right>".($ab->adres_dom_num?preg_replace("/^0{1,}/",'',$ab->adres_dom_num):'&nbsp;');
		$spisok.="<TD align=right>".($ab->adres_kv?preg_replace("/^0{1,}/",'',$ab->adres_kv):'&nbsp;');
//		$spisok.="<TD>".$ab->dog_nomer;
		$spisok.="<TD>TV".$ab->id;
		if($find->v_telefon) $spisok.="<TD>".$ab->tel_dom."&nbsp;".$ab->tel_sot;
		if($find->v_balans) $spisok.="<TD align=right><B class=".($ab->balans>=0?'bPlus':'bMinus').">".$ab->balans."</B>";
		if($find->v_zayav) $spisok.="<TD align=right>".($ab->date_zayav!='0000-00-00'?realday($ab->date_zayav):'&nbsp;');
		if($find->v_podkl) $spisok.="<TD align=right>".($ab->date_podkl!='0000-00-00'?realday($ab->date_podkl):'&nbsp;');
		if($find->v_status) $spisok.="<TD align=center>".$statusName[$ab->status];
		if($find->v_prim) $spisok.="<TD id=td".$ab->id."><TT>".($ab->prim?$ab->prim:'')."</TT><EM><A HREF='javascript:' onclick=FindPrimEdit(".$ab->id."); style=color:#".$statusBg[$ab->status].">изменить</A></EM>";
		}
	$spisok.="</TABLE>";
	echo "<DIV id=numbers>".$NumRow.$Numbers."</DIV>".$spisok;
	}
else echo "<DIV id=numbers><SPAN>Ничего не найдено.</SPAN></DIV>";
?>
