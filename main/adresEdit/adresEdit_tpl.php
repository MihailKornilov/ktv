<?php include_once('adresEdit.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Редактор адресов</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/main/adresEdit/adresEdit.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT src="/main/adresEdit/adresEdit.js"></SCRIPT>

</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/adres_edit_small.gif><P>Редактор адресов</P></DIV>

<DIV id=adresEdit>
	<DIV class=row>
		<DIV class=aName><IMG SRC='/img/add.gif' <?php if($kassir->rule_gorod_add==0) echo "style=display:none;"; ?>>Населённые пункты</DIV>
		<DIV class=aName><IMG SRC='/img/add.gif'>Улицы</DIV>
		<DIV class=aName><IMG SRC='/img/add.gif'>Дома</DIV>
	</DIV>

	<DIV class=row id=aGorodAdd>Новый населённый пункт:<P><INPUT TYPE=text maxlength=50><BUTTON>добавить</BUTTON></DIV>

	<DIV class=row id=aUlicaAdd>
		Новая улица к г.<B><?php echo $gorodArr[0]->name; ?></B>:
		<P><INPUT TYPE=text maxlength=50>
		<INPUT TYPE="hidden" value="<?php echo $gorodArr[0]->id; ?>">
		<BUTTON>добавить</BUTTON>
	</DIV>

	<DIV class=row id=aDomAdd>
		Новый дом к улице <B><?php echo $ulicaArr[0]->name; ?></B>:
		<P><INPUT TYPE=text maxlength=50>
		<INPUT TYPE="hidden" value="<?php echo $ulicaArr[0]->id; ?>">
		<BUTTON>добавить</BUTTON>
	</DIV>

	<DIV class=row>
		<DIV class=aSpisok id=aGorodSpisok><DIV><?php echo $gorod; ?></DIV></DIV>
		<DIV class=aSpisok id=aUlicaSpisok><DIV><?php echo $ulica; ?></DIV></DIV>
		<DIV class=aSpisok id=aDomSpisok><DIV><?php echo $dom; ?></DIV></DIV>
	</DIV>

</DIV>

</TABLE></BODY></HTML>
