<?php
$sql = "SELECT `bonus_procent` FROM `setup`";
$bonus_procent = $ktv->QRow($sql);

$bonusTab = '<i class="grey">���������� ������� ��� �� �������������.</i>';
$sql = "SELECT
			COUNT(`id`) `count`,
			SUM(`bonus_sum`) `sum`
		FROM `oplata`
		WHERE `status`
		  AND `bonus_procent`";
$bonus = $ktv->QueryObjectOne($sql);
if($bonus->count) {
	$bonusTab =
	'<table class="_spisok">'.
		'<tr><th>'.
			'<th>���-��'.
			'<th>�����'.
		'<tr><td>���� ������'.
			'<td class="center">'.$bonus->count.
			'<td class="r">'.$bonus->sum.' ���.'.
	'</table>';
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<HEAD>
<TITLE> KTV: ��������� ������� - ������</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css?<?php echo rand(0,10000); ?>" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js?<?php echo rand(0,10000); ?>"></SCRIPT>

</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead>
	<IMG SRC="/img/bonus.png" height="32">
	<P>������ ��� ���������</P>
</DIV>

<div class="mt20 fs14 b">�������� � �������:</div>
<p class="mt5">1. ����� ����������� �� ���� �������� ������������� ��� �������� ���������� �������.
<p>2. ���������� ���������� ��� �������, ���� ������� ������� ������ �������, �� ���� � ���� �� ���� ���������� ���������� ��������.
<p>3. ������ ������ - ��� ������� �� ����� �������. ������� ����������� � ��������� ����.

<div class="mt20 fs14 b">���������:</div>
<table class="bs10">
	<tr><td>������� �� ����� �������:
		<td><input type="text" id="bonus_procent" class="w50 r" value="<?php echo $bonus_procent; ?>" /> %
		<td><div class="myBytton mr20" onclick="bonusProcentSet($(this), event)"><a>���������</a></div>
</table>

<div class="mt20 fs14 b">����������:</div>
<div class="mt5"><?php echo $bonusTab; ?></div>

</TABLE>
</BODY>
</HTML>
