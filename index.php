<!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.3");</script>
<script type="text/javascript">google.load("jqueryui", "1.7");</script> -->
<script type="text/javascript" src="/include/jquery-1.4.2.min.js"></script>
<?php
include_once('include/conf.php');
session_name($session);
session_start();
include_once('include/class_MysqlDB.php');
include_once('include/FUNCTIONS.php');
include_once('include/functions_date.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

if(!empty($_POST['EnterGo']))
	{
	$enter=$ktv->QueryObjectOne("select id,kassir_path_save,kassir_path from admin where rule_enter=1 and login='".$_POST['login']."' and pass=password('".$_POST['pass']."') limit 1");
	$_SESSION['ks']=$enter->id;
//	if($_SESSION['ks'] and $enter->kassir_path_save) echo "<SCRIPT LANGUAGE='JavaScript'>location.href='index.php?".$enter->kassir_path."'</SCRIPT>";
	}

if(@$_GET['page']=='exit') $_SESSION['ks']='';

if(@$_SESSION['ks'])
	{
	$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);
	switch(@$_GET['page'])
		{
		case 'ab_oplata':			include('abonent/oplata_tpl.php'); break;
		case 'ab_abonentka':	include('abonent/abonentka_tpl.php'); break;
		case 'ab_abReCalc':	include('abonent/abonentkaReCalc_tpl.php'); break;
		case 'ab_uslugi':			include('abonent/uslugi_tpl.php'); break;
		case 'ab_remont':			include('abonent/remont_tpl.php'); break;
		case 'ab_remExec':		include('abonent/remExec_tpl.php'); break;
		case 'ab_edit':				include('abonent/edit_tpl.php'); break;
		case 'ab_log':				include('abonent/log_tpl.php'); break;
		
		case 'admin':				include('admin/adminIndex_tpl.php'); break;
		case 'workers':				include('admin/workers_tpl.php'); break;
		case 'workerAdd':		include('admin/workerAdd_tpl.php'); break;
		case 'worker':				include('admin/workerEdit_tpl.php'); break;
		case 'lgota':					include('admin/adminLgota_tpl.php'); break;
		case 'lgotaEdit':			include('admin/adminLgotaEdit_tpl.php'); break;
		case 'lgotaAdd':			include('admin/adminLgotaAdd_tpl.php'); break;
		case 'dump':	 				include('admin/adminDumpBase_tpl.php'); break;

	
		case 'mySetup':			include('main/mySetup/mySetup_tpl.php'); break;
		case 'adresEdit':			include('main/adresEdit/adresEdit_tpl.php'); break;
		case 'remont':				include('main/remont/remont_tpl.php'); break;
		case 'abonCalc':			include('main/abonCalc/abonCalc_tpl.php'); break;
		case 'abonCalcOk':		include('main/abonCalc/abonCalcOk_tpl.php'); break;

		case 'find':					include('find/find_tpl.php'); break;

		case 'oplata':				include('main/oplata/oplata_tpl.php'); break;

		case 'abNew':				include('main/abNew/abNew_tpl.php'); break;

		case 'report':				include('report/report_tpl.php'); break;
		case 'reportMonth':		include('report/month/reportMonth_tpl.php'); break;
		case 'reportYear':			include('report/year/reportYear_tpl.php'); break;

		case '':							include('main/index_tpl.php'); break;
		default: include('noPage.php'); break;
		}
	}
else include('enter_tpl.php');
?>
