<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - �������</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/main/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=MainLinks>
	<H1>������������</H1>
	<DIV><H4>
		<A HREF='/my-setup'><IMG SRC=/img/settings.gif><P>���<BR>���������</P></A>
		<A HREF='/adres-edit'><IMG SRC=/img/adres_edit.gif><P>��������������<BR>�������</P></A>
		<A HREF='/remont/wait'><IMG SRC=/img/remont.gif><P>������<BR>�� �������������</P></A>
		<?php if($kassir->rule_abon_calc == 1) { ?><A HREF='/abon-calc'><IMG SRC=/img/abon_calc.gif><P>����������<BR>����������� �����</P></A><?php } ?>
		<A HREF='/bonus'><IMG SRC=/img/bonus.png><P>������<br />��� ���������</P></A>
		<!-- <A HREF='index.php?p=7'><IMG SRC=/img/AbonReCalc.gif><P>����������<BR>����������� �����</P></A> -->
		<!-- <A HREF='index.php?p=9'><IMG SRC=/img/kvit_print.gif><P>������<BR>���������</P></A> -->
	</H4></DIV>
</DIV>

</TABLE></BODY></HTML>


