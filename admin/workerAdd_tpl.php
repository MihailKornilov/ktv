<?php include_once('workerAdd.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - ��������� ������ ����������</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/admin/admin.css" rel="stylesheet" type="text/css">
<?php echo $panelEnter; ?>
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function(){
	$("#TableSetup TR:even").css("background-color","#D7F3D7");

	$("#FormWorker .myBytton").click(function(e){
		if(!FormWorker.fio.value) ErrorView("�� ������� ��� ����������.",e);
		else FormWorker.submit();
		return false;
		}).mouseout(ErrorHide);
	});
//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=path>
	<A HREF="/">�������</A> / 
	<A HREF="/admin">�����������������</A> / 
	<A HREF="/admin/workers">���������� ������������</A> / 
	���������� ������ ����������
</DIV>

<BR>

<CENTER>
<DIV>	
<FORM METHOD=POST ACTION="/admin/workers/add" name=FormWorker id=FormWorker>
	<TABLE cellpadding=0 cellspacing=0 width=500 id=TableSetup>
		<TR><TD colspan=2><H1>������ ����������</H1>
		<TR><TH width=220>���:				<TD><INPUT TYPE="text" NAME="fio">
		<TR><TH>�������� �����:			<TD><INPUT TYPE="text" NAME="adres">
		<TR><TH>���������� ��������:	<TD><INPUT TYPE="text" NAME="telefon">
		<TR><TD align=right><A HREF='/admin/workers'>������</A><TD><H2 class=myBytton><A HREF='#'>��������</A></H2>
	</TABLE>
	<INPUT TYPE="hidden" name="workerAdd" value="1">
</FORM>
</DIV>
</CENTER>

</TABLE></BODY></HTML>
