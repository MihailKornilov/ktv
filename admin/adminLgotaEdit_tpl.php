<?php include_once('adminLgotaEdit.php'); ?>
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
	�������������� ������
</DIV>

<?php if($_POST['idLgota']) { ?>
	<DIV id=msgOk>������ �������� <A HREF='/admin/lgota'><B>OK</B></A>.</DIV>
<?php } else { ?>


<CENTER>
<DIV>
<FORM METHOD=POST ACTION="/admin/lgota/<?php echo $lgota->id; ?>" name="FormLgota" id="FormLgota">
	<TABLE cellpadding=0 cellspacing=0 width=400 id=TableSetup>
	<TR><TD colspan=2><H1>��������� �������������� ������</H1>
	<TR><TH>������������:			<TD><INPUT TYPE="text" NAME="name" value="<?php echo $lgota->name; ?>">
	<TR><TH>��������� �����������<BR>����� � �����:		<TD><?php echo $lgotaTip; ?>
	<TR><TH>��������:			<TD><INPUT TYPE="text" NAME="znach" style=width:50px; maxlength=5 value="<?php echo $lgota->value; ?>">
	<TR><TH>��������:			<TD><TEXTAREA NAME='about'><?php echo $lgota->about; ?></TEXTAREA>
	<TR><TD colspan=2 align=center><H2 class=myBytton><A HREF='#'>���������</A></H2>
	</TABLE>

	<INPUT TYPE="hidden" name="tip" id="tip" value="<?php echo $lgota->tip; ?>">
	<INPUT TYPE="hidden" name="idLgota" value="<?php echo $lgota->id; ?>">
</FORM>
</DIV>
</CENTER>
<?php } ?>


</TABLE></BODY></HTML>
