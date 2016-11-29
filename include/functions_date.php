<?php
$WeekFull=array
	(
	'Mon' => 'понедельник',
	'Tue' => 'вторник',
	'Wed' => 'среда',
	'Thu' => 'четверг',
	'Fri' => 'п€тница',
	'Sat' => 'суббота',
	'Sun' => 'воскресенье'
	);

$MonthFull=array
	(
	1 => '€нвар€',
	2 => 'феврал€',
	3 => 'марта',
	4 => 'апрел€',
	5 => 'ма€',
	6 => 'июн€',
	7 => 'июл€',
	8 => 'августа',
	9 => 'сент€бр€',
	10 => 'окт€бр€',
	11 => 'но€бр€',
	12 => 'декабр€'
	);

function Data($value)
	{
	$value=strtotime($value);
	return ned($value)." ".round(strftime("%d",$value))." ".month($value).strftime(" %Y&nbsp;<B>%H:%M</B>",$value);
	}

function realday($data)
	{
	$d=explode("-",$data);
	$mon=month($d[1]);
	$data=strtotime($data);
	return  ned($data)." ".round($d[2])." ".$mon." ".$d[0];
	}


function RealFullDay($value)
	{
	// среда, 14 апрел€ 2010
	global $WeekFull, $MonthFull; 
	$d=explode("-",$value);
	return $WeekFull[strftime("%a",strtotime($value))].", ".abs($d[2])." ".$MonthFull[abs($d[1])]." ".$d[0];
	}


function month($data)
	{
	if(strlen($data)>2) $data=strftime("%m",$data);
	switch($data)
		{
		case 1: return "€нв."; break;
		case 2: return "фев."; break;
		case 3: return "мар."; break;
		case 4: return "апр."; break;
		case 5: return "май"; break;
		case 6: return "июнь"; break;
		case 7: return "июль"; break;
		case 8: return "авг."; break;
		case 9: return "сен."; break;
		case 10: return "окт."; break;
		case 11: return "но€б."; break;
		case 12: return "дек."; break;
		}
	}

function fullmonth($data)
	{
	if(strlen($data)>2) $data=strftime("%m",$data);
	switch($data)
		{
		case 1: return "€нварь"; break;
		case 2: return "февраль"; break;
		case 3: return "март"; break;
		case 4: return "апрель"; break;
		case 5: return "май"; break;
		case 6: return "июнь"; break;
		case 7: return "июль"; break;
		case 8: return "август"; break;
		case 9: return "сент€брь"; break;
		case 10: return "окт€брь"; break;
		case 11: return "но€брь"; break;
		case 12: return "декабрь"; break;
		}
	}

function ned($data)
	{
	switch(strftime("%a",$data))
		{
		case 'Mon': return "пн."; break;
		case 'Tue': return "вт."; break;
		case 'Wed': return "ср."; break;
		case 'Thu': return "чт."; break;
		case 'Fri': return "пт."; break;
		case 'Sat': return "сб."; break;
		case 'Sun': return "вс."; break;
		}
	}

function DateCheck($value)
	{
	$arr=explode('-',$value);
	if($arr[0]=='0000' or $arr[1]=='00' or $arr[2]=='00') return '0000-00-00';
	else return $arr[0].'-'.abs($arr[1]).'-'.abs($arr[2]);
	}
?>
