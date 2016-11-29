<?php
$WeekFull=array
	(
	'Mon' => '�����������',
	'Tue' => '�������',
	'Wed' => '�����',
	'Thu' => '�������',
	'Fri' => '�������',
	'Sat' => '�������',
	'Sun' => '�����������'
	);

$MonthFull=array
	(
	1 => '������',
	2 => '�������',
	3 => '�����',
	4 => '������',
	5 => '���',
	6 => '����',
	7 => '����',
	8 => '�������',
	9 => '��������',
	10 => '�������',
	11 => '������',
	12 => '�������'
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
	// �����, 14 ������ 2010
	global $WeekFull, $MonthFull; 
	$d=explode("-",$value);
	return $WeekFull[strftime("%a",strtotime($value))].", ".abs($d[2])." ".$MonthFull[abs($d[1])]." ".$d[0];
	}


function month($data)
	{
	if(strlen($data)>2) $data=strftime("%m",$data);
	switch($data)
		{
		case 1: return "���."; break;
		case 2: return "���."; break;
		case 3: return "���."; break;
		case 4: return "���."; break;
		case 5: return "���"; break;
		case 6: return "����"; break;
		case 7: return "����"; break;
		case 8: return "���."; break;
		case 9: return "���."; break;
		case 10: return "���."; break;
		case 11: return "����."; break;
		case 12: return "���."; break;
		}
	}

function fullmonth($data)
	{
	if(strlen($data)>2) $data=strftime("%m",$data);
	switch($data)
		{
		case 1: return "������"; break;
		case 2: return "�������"; break;
		case 3: return "����"; break;
		case 4: return "������"; break;
		case 5: return "���"; break;
		case 6: return "����"; break;
		case 7: return "����"; break;
		case 8: return "������"; break;
		case 9: return "��������"; break;
		case 10: return "�������"; break;
		case 11: return "������"; break;
		case 12: return "�������"; break;
		}
	}

function ned($data)
	{
	switch(strftime("%a",$data))
		{
		case 'Mon': return "��."; break;
		case 'Tue': return "��."; break;
		case 'Wed': return "��."; break;
		case 'Thu': return "��."; break;
		case 'Fri': return "��."; break;
		case 'Sat': return "��."; break;
		case 'Sun': return "��."; break;
		}
	}

function DateCheck($value)
	{
	$arr=explode('-',$value);
	if($arr[0]=='0000' or $arr[1]=='00' or $arr[2]=='00') return '0000-00-00';
	else return $arr[0].'-'.abs($arr[1]).'-'.abs($arr[2]);
	}
?>
