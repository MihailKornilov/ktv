<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - ����</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
</HEAD>

<BODY>

<FORM METHOD=POST ACTION='/' id=Enter name=Enter>
<H5>��������� �������: <B>����</B></H5>
	<TABLE cellspacing=0 cellpadding=0>
	<TR><TH>�����:<TD><INPUT TYPE=text NAME='login' maxlength=15>
	<TR><TH>������:<TD><INPUT TYPE=password NAME='pass' maxlength=15>
	<TR><TD colspan=2 align=center><DIV class=myBytton><A HREF='#' onclick=Enter.submit();>�����</A></DIV>
	</TABLE>
<?php if(!empty($_POST['EnterGo'])) { ?>
	<DIV id=msgErr>�������� ����.</DIV>
<?php } ?>
<INPUT TYPE=hidden NAME=EnterGo value=1>
</FORM>

</BODY></HTML>
