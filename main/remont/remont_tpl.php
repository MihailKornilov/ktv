<?php include_once('remont.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - ������ ������ �� �������������</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/main/remont/remont.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT src="/main/remont/remont.js"></SCRIPT>

</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=SetupHead><IMG SRC=/img/remont_small.gif><P>������ ������ �� �������������</P></DIV>
<TABLE cellspacing=0 cellpadding=0 id=RemontLink>
<TR>
	<TD>���������� ������:
	<TD<?php echo (!$remStatus?' id=RemontLinkSel':''); ?>><A HREF='/remont'>���</A>
	<TD<?php echo ($remStatus==2?' id=RemontLinkSel':''); ?>><A HREF='/remont/wait' style=color:#A00;>�������</A>
	<TD<?php echo ($remStatus==1?' id=RemontLinkSel':''); ?>><A HREF='/remont/executed' style=color:#0A0;>�����������</A>
	<TD<?php echo ($remStatus==3?' id=RemontLinkSel':''); ?>><A HREF='/remont/deleted' style=color:#666;>��������</A>
</TABLE>


<?php echo $remontSpisok; ?>

</TABLE></BODY></HTML>
