<?php include_once('adminLgotaAdd.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - �������������� ������</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/admin/admin.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT src="/admin/admin.js"></SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=path>
	<A HREF="/">�������</A> / 
	<A HREF="/admin">�����������������</A> / 
	<A HREF="/admin/lgota">������ ��� ���������</A> /
	���������� ����� ������
</DIV>

<?php if($_POST['newLgota']) { ?>
	<DIV id=msgOk>����� ������ ������� <A HREF='/admin/lgota'><B>OK</B></A>.</DIV>
<?php } else { ?>


<CENTER>
<FORM METHOD=POST ACTION="/admin/lgota/add" name="FormLgota" id="FormLgota">
	<TABLE cellpadding=0 cellspacing=0 width=400 id=TableSetup>
	<TR><TD colspan=2><H1>���������� ����� ������</H1>
	<TR><TH>������������:			<TD><INPUT TYPE="text" NAME="name">
	<TR><TH>��������� �����������<BR>����� � �����:		<TD><?php echo $lgotaTip; ?>
	<TR><TH>��������:			<TD><INPUT TYPE="text" NAME="znach" style=width:50px; maxlength=5>
	<TR><TH>��������:			<TD><TEXTAREA NAME='about'></TEXTAREA>
	<TR><TD colspan=2 align=center><H2 class=myBytton><A HREF='#'>������</A></H2>
	</TABLE>

	<INPUT TYPE="hidden" name="tip" id="tip" value="1">
	<INPUT TYPE="hidden" name="newLgota" value="1">
</FORM>
</CENTER>
<?php } ?>


</TABLE></BODY></HTML>
