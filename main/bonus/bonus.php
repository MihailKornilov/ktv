<?php
$sql = "SELECT `bonus_procent` FROM `setup`";
$bonus_procent = $ktv->QRow($sql);

$bonusTab = '<i class="grey">Начисления бонусов ещё не производились.</i>';
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
			'<th>Кол-во'.
			'<th>Сумма'.
		'<tr><td>Весь период'.
			'<td class="center">'.$bonus->count.
			'<td class="r">'.$bonus->sum.' руб.'.
	'</table>';
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<HEAD>
<TITLE> KTV: Интерфейс кассира - Бонусы</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css?<?php echo rand(0,10000); ?>" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js?<?php echo rand(0,10000); ?>"></SCRIPT>

</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead>
	<IMG SRC="/img/bonus.png" height="32">
	<P>Бонусы для абонентов</P>
</DIV>

<div class="mt20 fs14 b">Описание и правила:</div>
<p class="mt5">1. Бонус начисляется на счёт абонента автоматически при внесении очередного платежа.
<p>2. Начисление происходит при условии, если абонент произвёл оплату вовремя, то есть у него не было просрочено предыдущих платежей.
<p>3. Размер бонуса - это процент от суммы платежа. Процент указывается в настройке ниже.

<div class="mt20 fs14 b">Настройки:</div>
<table class="bs10">
	<tr><td>Процент от суммы платежа:
		<td><input type="text" id="bonus_procent" class="w50 r" value="<?php echo $bonus_procent; ?>" /> %
		<td><div class="myBytton mr20" onclick="bonusProcentSet($(this), event)"><a>применить</a></div>
</table>

<div class="mt20 fs14 b">Начисления:</div>
<div class="mt5"><?php echo $bonusTab; ?></div>

</TABLE>
</BODY>
</HTML>
