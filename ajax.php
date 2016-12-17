<?php
include_once('include/conf.php');

session_name($session);
session_start();

include_once('include/class_MysqlDB.php');
include_once('include/FUNCTIONS.php');
include_once('include/functions_date.php');
$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

define('REGEXP_NUMERIC',    '/^[0-9]{1,20}$/i');

switch(@$_POST['op']) {
	case 'setup_bonus_procent':
		if(!$v = _num($_POST['v']))
			jsonError('некорректно указан процент');

		if($v < 1 || $v > 100)
			jsonError('размер процент может быть от 1 до 100');

		$sql = "UPDATE `setup` SET `bonus_procent`=".$v;
		$ktv->Query($sql);

		jsonSuccess();
		break;
}

jsonError();

function _num($v) {
	if(empty($v) || is_array($v) || !preg_match(REGEXP_NUMERIC, $v))
		return 0;

	return intval($v);
}

function jsonError($values=null) {
	$send['error'] = 1;
	if(empty($values))
		$send['text'] = utf8('Произошла неизвестная ошибка.');
	elseif(is_array($values))
		$send += $values;
	else
		$send['text'] = utf8($values);
	die(json_encode($send));
}
function jsonSuccess($send=array()) {
	$send['success'] = 1;
	die(json_encode($send));
}

function win1251($txt) { return iconv('UTF-8', 'WINDOWS-1251//TRANSLIT', $txt); }
function utf8($txt) { return iconv('WINDOWS-1251', 'UTF-8', $txt); }
