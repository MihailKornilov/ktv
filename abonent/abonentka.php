<?php
$abonent=$ktv->QueryObjectOne("select * from abonent where adres_gorod in (".$kassir->rule_gorod_allow.") and id=".(preg_match("|^[\d]+$|",$_GET['id'])?$_GET['id']:'0'));
if($abonent->id)
	{
	if($_POST['AbonAdd'] and $KtvKassirDemo==0)
		{
		$month=$_POST['abYear']."-".$_POST['abMonth']."-01";
		$monTxt=fullmonth($_POST['abMonth'])." ".$_POST['abYear'];
		if($ktv->QRow("select count(id) from abonentka where tip=0 and month='".$month."' and id_abonent=".$_POST['AbonAdd'])>0)
			$abonError="<DIV id=msgErr><B>Ошибка:</B> Абонентская плата за <B>".$monTxt."</B> уже начислялась. <A HREF='/ab".$abonent->id."/abonentka'>Назад</A>.</DIV>";
		else
			{
			$abonent->balans-=$_POST['money'];
			$ktv->Query("insert into abonentka (money,month,id_abonent,prim,admin_add,balans) values (".$_POST['money'].",'".$month."',".$_POST['AbonAdd'].",'".$_POST['prim']."',".$_SESSION['ks'].",".$abonent->balans.")");
			$ktv->Query("update abonent set balans=".$abonent->balans." where id=".$_POST['AbonAdd']);
			$ktv->Query("insert into abonent_log (action,value_new,id_abonent,id_admin) values ('Начисление абонентской<BR>платы за ".$monTxt."','Сумма: <B>".$_POST['money']."</B>, баланс: ".$abonent->balans."',".$_POST['AbonAdd'].",".$_SESSION['ks'].")");
			}
		}
	else
		{
		$jetzMon=strftime("%m",time());
		$abSelectMon="<DT>".fullmonth($jetzMon);
		for($n=1;$n<=12;$n++) $abSelectMon.="<DD><A HREF='javascript:'>".fullmonth($n)."</A>";

		$jetzYear=strftime("%Y",time());
		$abSelectYear="<DT>".$jetzYear;
		for($n=2005;$n<=$jetzYear+1;$n++) $abSelectYear.="<DD><A HREF='javascript:'>".$n."</A>";

		if($ktv->QRow("select count(id) from abonentka where tip=0 and month='".$jetzYear."-".$jetzMon."-01' and id_abonent=".$abonent->id)>0)
			$abCalc="<SPAN style=color:#C33;>Начисление за <B>".fullmonth($jetzMon)." ".$jetzYear."</B> уже произведено.</SPAN>";
		else $abCalc="<SPAN style=color:#393;>Начисление за <B>".fullmonth($jetzMon)." ".$jetzYear."</B> не производилось.</SPAN>";
		}


	$abonentka=$ktv->QueryObjectArray("select * from abonentka where tip=0 and id_abonent=".$abonent->id." order by month");
	if(count($abonentka)>0)
		{
		$abSpisok="<TABLE cellspacing=0 cellpadding=0 id=spisok bgcolor=#E3ECE5>";
			$abSpisok.="<TH>&nbsp;";
			$abSpisok.="<TH>Сумма";
			$abSpisok.="<TH>Месяц";
			$abSpisok.="<TH>Баланс";
			$abSpisok.="<TH>Дата внесения";
			$abSpisok.="<TH>Администратор";
			$abSpisok.="<TH>Примечание";

		$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");

		foreach($abonentka as $n=>$ab)
			{
			$year=explode('-',$ab->month);
			$abSpisok.="<TR align=right>";
			$abSpisok.="<TD><U>".($n+1)."</U>";
			$abSpisok.="<TD><BIG>".$ab->money."<A HREF='/ab".$abonent->id."/abonentka/".$ab->id."'><IMG SRC='/img/AbonReCalcSmall1.gif'></A></BIG>";
			$abSpisok.="<TD>".fullmonth($year[1])." ".$year[0];
			$abSpisok.="<TD align=center>".$ab->balans;
			$abSpisok.="<TD>".Data($ab->dtime_add);
			$abSpisok.="<TD align=left>".$admin[$ab->admin_add].($ab->auto==1?"<IMG SRC=/img/abon_calc_auto.gif>":'');
			$abSpisok.="<TD align=left>".($ab->prim?$ab->prim:'&nbsp;');
			}
		$abSpisok.="</TABLE>";
		}
	else $abSpisok.="<DIV class=msgEmpty>Начисления абонентской платы отсутствуют.</DIV>";


	}
else header("Location: /nopage");
?>
