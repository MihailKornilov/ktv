<?php
$abonent=$ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if($abonent->id)
	{
	if($_POST['AbEdit'] and $KtvKassirDemo==0)
		{
		if(	$abonent->adres_gorod!=$_POST['adres_gorod'] or 
			$abonent->adres_ulica!=$_POST['adres_ulica'] or 
			$abonent->adres_dom!=$_POST['adres_dom'] or 
			preg_replace("/^0{1,}/",'',$abonent->adres_kv)!=$_POST['adres_kv'])
			{
			$ktv->Query("update abonent set adres_gorod=".$_POST['adres_gorod'].",adres_ulica=".$_POST['adres_ulica'].",adres_dom=".$_POST['adres_dom'].",adres_kv='".NumCreate($_POST['adres_kv'])."' where id=".$_POST['AbEdit']);
			AdresSet($abonent->id,$_POST['adres_gorod'],$_POST['adres_ulica'],$_POST['adres_dom']);

			$adresOld=AdresSmall(0,$abonent->adres_gorod_name,$abonent->adres_ulica_name,$abonent->adres_dom_num,$abonent->adres_kv);
			$adresNew=AdresSmall(1,$_POST['adres_gorod'],$_POST['adres_ulica'],$_POST['adres_dom'],$_POST['adres_kv']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение адреса','".$adresOld."','".$adresNew."',".$abonent->id.",".$_SESSION['ks'].")");
			$abonent->adres_gorod=$_POST['adres_gorod'];
			}

		if($abonent->adres_podezd!=$_POST['adres_podezd'])
			{
			$ktv->Query("update abonent set adres_podezd=".($_POST['adres_podezd']?$_POST['adres_podezd']:'0')." where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение номера подъезда','".($abonent->adres_podezd?$abonent->adres_podezd:'&nbsp;')."','".($_POST['adres_podezd']?$_POST['adres_podezd']:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}

		if($abonent->adres_etag!=$_POST['adres_etag'])
			{
			$ktv->Query("update abonent set adres_etag=".($_POST['adres_etag']?$_POST['adres_etag']:'0')." where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение номера этажа','".($abonent->adres_etag?$abonent->adres_etag:'&nbsp;')."','".($_POST['adres_etag']?$_POST['adres_etag']:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}

		if($abonent->f!=$_POST['f'])
			{
			$ktv->Query("update abonent set f='".$_POST['f']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение фамилии','".($abonent->f?$abonent->f:'&nbsp;')."','".($_POST['f']?$_POST['f']:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}


		if($abonent->i!=$_POST['i'])
			{
			$ktv->Query("update abonent set i='".$_POST['i']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение имени','".($abonent->i?$abonent->i:'&nbsp;')."','".($_POST['i']?$_POST['i']:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}

		
		if($abonent->o!=$_POST['o'])
			{
			$ktv->Query("update abonent set o='".$_POST['o']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение отчества','".($abonent->o?$abonent->o:'&nbsp;')."','".($_POST['o']?$_POST['o']:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}


		if($abonent->tel_dom!=$_POST['tel_dom'])
			{
			$ktv->Query("update abonent set tel_dom='".$_POST['tel_dom']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение домашнего тел.','".($abonent->tel_dom?$abonent->tel_dom:'&nbsp;')."','".($_POST['tel_dom']?$_POST['tel_dom']:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}


		if($abonent->tel_sot!=$_POST['tel_sot'])
			{
			$ktv->Query("update abonent set tel_sot='".$_POST['tel_sot']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение сотового тел.','".($abonent->tel_sot?$abonent->tel_sot:'&nbsp;')."','".($_POST['tel_sot']?$_POST['tel_sot']:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}

		if($abonent->status!=$_POST['status'])
			{
			$ktv->Query("update abonent set status=".$_POST['status'].",status_edit=current_timestamp where id=".$_POST['AbEdit']);
			$statusName=$ktv->QueryPtPArray("select id,name from abonent_status order by id");
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение статуса','".$statusName[$abonent->status]."','".$statusName[$_POST['status']]."',".$abonent->id.",".$_SESSION['ks'].")");
			}
		
		if(DateCheck($_POST['date_zayav'])!=DateCheck($abonent->date_zayav))
			{
			$ktv->Query("update abonent set date_zayav='".$_POST['date_zayav']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение даты заявки','".($abonent->date_zayav!='0000-00-00'?realday($abonent->date_zayav):'&nbsp;')."','".($_POST['date_zayav']!='0000-00-00'?realday($_POST['date_zayav']):'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}

		if(DateCheck($_POST['date_podkl'])!=DateCheck($abonent->date_podkl))
			{
			$ktv->Query("update abonent set date_podkl='".$_POST['date_podkl']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение даты подключения','".($abonent->date_podkl!='0000-00-00'?realday($abonent->date_podkl):'&nbsp;')."','".($_POST['date_podkl']!='0000-00-00'?realday($_POST['date_podkl']):'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}


///////////// ================ АБОНЕНТКА ==================////////////////////
		if($abonent->abonentka_calc!=$_POST['abonentka_calc'])
			{
			$ktv->Query("update abonent set abonentka_calc=".$_POST['abonentka_calc']." where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение начисления<BR>абонентской платы','".($abonent->abonentka_calc?'да':'нет')."','".($_POST['abonentka_calc']?'да':'нет')."',".$abonent->id.",".$_SESSION['ks'].")");
			}

		if($_POST['abonentka_calc']==1)
			{
			if($abonent->abonentka_sum_unical!=$_POST['abonentka_sum_unical'])
				{
				$ktv->Query("update abonent set abonentka_sum_unical=".$_POST['abonentka_sum_unical']." where id=".$_POST['AbEdit']);
				$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Индивидуальная сумма<BR>абонентской оплаты','".($abonent->abonentka_sum_unical?'да':'нет')."','".($_POST['abonentka_sum_unical']?'да':'нет')."',".$abonent->id.",".$_SESSION['ks'].")");
				}

			if($abonent->abonentka_sum!=$_POST['abonentka_sum'])
				{
				$ktv->Query("update abonent set abonentka_sum=".$_POST['abonentka_sum']." where id=".$_POST['AbEdit']);
				$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение суммы<BR>абонентской оплаты','".$abonent->abonentka_sum."','".round($_POST['abonentka_sum'])."',".$abonent->id.",".$_SESSION['ks'].")");
				}

			if($abonent->lgota!=$_POST['lgota'])
				{
				$ktv->Query("update abonent set lgota=".$_POST['lgota']." where id=".$_POST['AbEdit']);
				$lgotaName=$ktv->QueryPtPArray("select id,name from lgota order by id");
				$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение льготы','".($abonent->lgota>0?$lgotaName[$abonent->lgota]:'&nbsp;')."','".($_POST['lgota']?$lgotaName[$_POST['lgota']]:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
				}
			}


///////////// ================ ДОГОВОР ==================////////////////////
		if($abonent->dog_nomer!=$_POST['dog_nomer'])
			{
			$ktv->Query("update abonent set dog_nomer='".$_POST['dog_nomer']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение номера договора','".($abonent->dog_nomer?$abonent->dog_nomer:'&nbsp;')."','".($_POST['dog_nomer']?$_POST['dog_nomer']:'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}

		if(DateCheck($_POST['dog_date'])!=DateCheck($abonent->dog_date))
			{
			$ktv->Query("update abonent set dog_date='".$_POST['dog_date']."' where id=".$_POST['AbEdit']);
			$ktv->Query("insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение даты заключения договора','".($abonent->dog_date!='0000-00-00'?realday($abonent->dog_date):'&nbsp;')."','".($_POST['dog_date']!='0000-00-00'?realday($_POST['dog_date']):'&nbsp;')."',".$abonent->id.",".$_SESSION['ks'].")");
			}

		if(	DateCheck($_POST['pasp_vydan_date'])!=DateCheck($abonent->pasp_vydan_date) or 
			$abonent->pasp_seria!=$_POST['pasp_seria'] or 
			$abonent->pasp_nomer!=$_POST['pasp_nomer'] or 
			$abonent->pasp_vydan_kem!=$_POST['pasp_vydan_kem'] or 
			$abonent->pasp_propiska!=$_POST['pasp_propiska'])
			{
			$ktv->Query("update abonent set pasp_vydan_date='".$_POST['pasp_vydan_date']."',pasp_seria='".$_POST['pasp_seria']."',pasp_nomer='".$_POST['pasp_nomer']."',pasp_vydan_kem='".$_POST['pasp_vydan_kem']."',pasp_propiska='".$_POST['pasp_propiska']."' where id=".$_POST['AbEdit']);

			$query="insert into abonent_log (action,value_old,value_new,id_abonent,id_admin) values ('Изменение паспортных данных',";

			$query.="'Серия: ".($abonent->pasp_seria?"<B>".$abonent->pasp_seria."</B>":'-')."&nbsp;&nbsp;";
			$query.="Номер: ".($abonent->pasp_nomer?"<B>".$abonent->pasp_nomer."</B>":'-')."<BR>";
			$query.="Кем выдан: ".($abonent->pasp_vydan_kem?"<B>".$abonent->pasp_vydan_kem."</B>":'-')."<BR>";
			$query.="Дата выдачи: ".($abonent->pasp_vydan_date!='0000-00-00'?"<B>".realday($abonent->pasp_vydan_date)."</B>":'-')."<BR>";
			$query.="Прописка: ".($abonent->pasp_propiska?"<B>".$abonent->pasp_propiska."</B>":'-')."',";

			$query.="'Серия: ".($_POST['pasp_seria']?"<B>".$_POST['pasp_seria']."</B>":'-')."&nbsp;&nbsp;";
			$query.="Номер: ".($_POST['pasp_nomer']?"<B>".$_POST['pasp_nomer']."</B>":'-')."<BR>";
			$query.="Кем выдан: ".($_POST['pasp_vydan_kem']?"<B>".$_POST['pasp_vydan_kem']."</B>":'-')."<BR>";
			$query.="Дата выдачи: ".($_POST['pasp_vydan_date']!='0000-00-00'?"<B>".realday($_POST['pasp_vydan_date'])."</B>":'-')."<BR>";
			$query.="Прописка: ".($_POST['pasp_propiska']?"<B>".$_POST['pasp_propiska']."</B>":'-')."',";

			$query.=$abonent->id.",".$_SESSION['ks'].")";
			$ktv->Query($query);
			}

		$ktv->Query("update abonent set prim='".$_POST['prim']."',status_edit='".$_POST['status_edit']."' where id=".$_POST['AbEdit']);
		$lastPrim=$ktv->QRow("select prim from abonent_prim where id_abonent=".$_POST['AbEdit']." order by id desc limit 1");
		if($_POST['prim'] and $_POST['prim']!=$lastPrim) $ktv->Query("insert into abonent_prim (id_abonent,prim,admin_add) values (".$_POST['AbEdit'].",'".$_POST['prim']."',".$_SESSION['ks'].")");

		header("Location: /ab".$abonent->id."/edit/save");
		}
	}
else header("Location: /nopage");

if($abonent->date_zayav=='0000-00-00') $dateZayav="<A HREF='javascript:' onclick=Calendar('',event,'abDataZayavSet');><I>не указана</I></A>";
else $dateZayav="<A HREF='javascript:' onclick=Calendar('".$abonent->date_zayav."',event,'abDataZayavSet');>".RealFullDay($abonent->date_zayav)."</A>";

if($abonent->date_podkl=='0000-00-00') $datePodkl="<A HREF='javascript:' onclick=Calendar('',event,'abDataPodklSet');><I>не указана</I></A>";
else $datePodkl="<A HREF='javascript:' onclick=Calendar('".$abonent->date_podkl."',event,'abDataPodklSet');>".RealFullDay($abonent->date_podkl)."</A>";

if($abonent->status_edit!='0000-00-00') $statusEdit="(<A HREF='javascript:' onclick=Calendar('".$abonent->status_edit."',event,'abStatusEditSet');>".realday($abonent->status_edit)."</A>)";

if($abonent->dog_date=='0000-00-00') $dogDate="<A HREF='javascript:' onclick=Calendar('',event,'abDogDateSet');><I>не указана</I></A>";
else $dogDate="<A HREF='javascript:' onclick=Calendar('".$abonent->dog_date."',event,'abDogDateSet');>".RealFullDay($abonent->dog_date)."</A>";

if($abonent->pasp_vydan_date=='0000-00-00') $paspVydanDate="<A HREF='javascript:' onclick=Calendar('',event,'abPaspDateSet');><I>не указана</I></A>";
else $paspVydanDate="<A HREF='javascript:' onclick=Calendar('".$abonent->pasp_vydan_date."',event,'abPaspDateSet');>".realday($abonent->pasp_vydan_date)."</A>";

if($abonent->abonentka_calc==0) $CalcDisplay="style=display:none;";

if($abonent->abonentka_sum_unical==0) $AbonSum="<BIG>".$abonent->abonentka_sum."</BIG><INPUT TYPE='hidden' NAME='abonentka_sum' value='".$abonent->abonentka_sum."'>";
else $AbonSum="<INPUT TYPE=text NAME='abonentka_sum' size=4 maxlength=5 value='".$abonent->abonentka_sum."'>";

if($abonent->abonentka_sum_unical==1) $LgotaDisplay="style=display:none;";


// ------------------ ВЫВОД СПИСКА ЛЬГОТ ------------
$AbonSumma=$ktv->QueryPtPArray("select id,abon_summa from adres_gorod order by id");

$abLgota=$ktv->QueryObjectArray("select * from lgota order by id");
$lgota="<DIV id='mySel'><DL>";
$lgota.="<DT><TABLE cellspacing=0 cellpadding=0><TR><TD width=100%><P>".$ktv->QRow("select name from lgota where id=".$abonent->lgota)."<TD><B>v</B></TABLE>";
$lgota.="<DD><A HREF='javascript:' onclick=abLgotaSet(0,".$AbonSumma[$abonent->adres_gorod].",0);><EM><I>без льготы</I>&nbsp;&nbsp;(".$AbonSumma[$abonent->adres_gorod].")</EM></A>";
if(count($abLgota)>0)
	foreach($abLgota as $abLg)
		{
		switch($abLg->tip)
			{
			case 1: $money=$AbonSumma[$abonent->adres_gorod]-round($AbonSumma[$abonent->adres_gorod]/100*$abLg->value); break;
			case 2: $money=$AbonSumma[$abonent->adres_gorod]-$abLg->value; break;
			case 3: $money=$abLg->value; break;
			}
		$lgota.="<DD><A HREF='javascript:' onclick=abLgotaSet(this,".$money.",".$abLg->id.");><SPAN>".$abLg->name."</SPAN><EM>(".$money.")</EM></A>";
		}
$lgota.="</DL></DIV>";

// ------------------ ВЫВОД ИСТОРИИ ПРИМЕЧАНИЙ ------------
$prim=$ktv->QueryObjectArray("select * from abonent_prim where id_abonent=".$abonent->id." order by id");
if(count($prim)>0)
	{
	$primSpisok="<A HREF='#'>показать историю</A>";
	$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");
	$primSpisok.="<CENTER style=display:none;><TABLE cellspacing=0 cellpadding=0>";
	$primSpisok.="<CAPTION>История примечаний:<CAPTION>";
	foreach($prim as $p) $primSpisok.="<TR><TD><STRONG>".$p->prim."</STRONG><TD>".$admin[$p->admin_add]."<TD align=right>".Data($p->dtime_add);
	$primSpisok.="</TABLE></CENTER>";
	}
?>
