<?php
include_once('../../include/conf.php');
session_name($session);
session_start();
if($_SESSION['ks'])
	{
	include_once('../../include/class_MysqlDB.php');
	include_once('../../include/functions_date.php');
	include_once('../../include/FUNCTIONS.php');
	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
	$status=$ktv->QueryPtPArray("select id,abon_calc from abonent_status order by id");
	$QueryCalc="abonentka_calc_month=0 and abonentka_sum>0 and abonentka_calc=1 and status in (0";
	if(count($status)>0) foreach($status as $id=>$st) if($st==1) $QueryCalc.=",".$id;
	$QueryCalc.=")";

	$aaa=0;
	$mon=explode('-',$_GET['month']);
	$monTxt=fullmonth($mon[1])." ".$mon[0];
	$abonent=$ktv->QueryObjectArray("select id,abonentka_sum,balans from abonent where adres_gorod in (".$_GET['gorod'].") and ".$QueryCalc);
	if(count($abonent)>0)
		foreach($abonent as $ab)
			{
			$balans=$ab->balans-$ab->abonentka_sum;
			$ktv->Query("insert into abonentka (money,month,id_abonent,admin_add,balans,auto) values (".$ab->abonentka_sum.",'".$_GET['month']."',".$ab->id.",".$_SESSION['ks'].",".$balans.",1)");
			$ktv->Query("update abonent set balans=".$balans." where id=".$ab->id);
			$ktv->Query("insert into abonent_log (action,value_new,id_abonent,id_admin) values ('Начисление абонентской<BR>платы за ".$monTxt."','Сумма: <B>".$ab->abonentka_sum."</B>, баланс: ".$balans."',".$ab->id.",".$_SESSION['ks'].")");
			}
	}
?>
<SCRIPT LANGUAGE="JavaScript">parent.location='/abon-calc/ok';</SCRIPT>
