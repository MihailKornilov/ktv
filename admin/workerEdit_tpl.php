<?php include_once('workerEdit.php'); ?>
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

	$("SPAN:eq(1)").click(function(){ $(".panelEnter").toggle(); });

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
	<?php echo $worker->fio; ?>
</DIV>

<CENTER>
<?php if($_POST['idWorker']) echo "<DIV id=msgOk>������ ���������.</DIV>"; ?>
<DIV>	
<FORM METHOD=POST ACTION="/admin/workers/<?php echo $worker->id; ?>" name=FormWorker id=FormWorker>
	<TABLE cellpadding=0 cellspacing=0 width=500 id=TableSetup>
		<TR><TD colspan=2><H1>������ ����������</H1>
		<TR><TH width=220>���:				<TD><INPUT TYPE="text" NAME="fio" value="<?php echo $worker->fio; ?>">
		<TR><TH>�������� �����:			<TD><INPUT TYPE="text" NAME="adres" value="<?php echo $worker->adres; ?>">
		<TR><TH>���������� ��������:	<TD><INPUT TYPE="text" NAME="telefon" value="<?php echo $worker->telefon; ?>">
		<TR><TH>��������� � ����������<BR>������ �� �������������:<TD><?php CheckBox('rule_remont',$worker->rule_remont); ?>
		<TR><TH>���� �����������:			<TD><?php echo Data($worker->date_add); ?>

		<TR><TD colspan=2><H1>���� � ���������</H1>
		<TR><TH>��������� ����<BR>� ������ ����������:<TD><?php CheckBox('rule_enter',$worker->rule_enter); ?>
		<TR class=panelEnter><TH width=220>�����:	<TD><INPUT TYPE="text" NAME="login" value="<?php echo $worker->login; ?>">
		<TR class=panelEnter><TH>������:	<TD><INPUT TYPE="password" NAME="pass">
		<TR class=panelEnter><TH>���������� ��������������<BR>��� ������ �� ������ ����������:<TD><?php CheckBox('rule_path_save',$worker->rule_path_save); ?>

		<TR class=panelEnter><TD colspan=2><H1>��������� ����</H1>
		<TR class=panelEnter><TH>��������� ����<BR>� ������ <B>�����������������</B>:<TD><?php CheckBox('rule_panel_admin',$worker->rule_panel_admin); ?>
		<TR class=panelEnter><TH width=220>������ � ��������� �������:<TD><?php echo $punkt; ?>
		<TR class=panelEnter><TH>����� ���������<BR>����� ��������� ������:<TD><?php CheckBox('rule_gorod_add',$worker->rule_gorod_add); ?>
		<TR class=panelEnter><TH>����� ������ ��� ������,<BR>����� ������ ����:<TD><?php CheckBox('rule_report_view',$worker->rule_report_view); ?>
		<TR class=panelEnter><TH>����� ��������� �����������<BR>����� ����� �������:<TD><?php CheckBox('rule_abon_calc',$worker->rule_abon_calc); ?>
		<TR><TD align=right><A HREF='/admin/workers'>������</A><TD><H2 class=myBytton><A HREF='#'>���������</A></H2>
	</TABLE>
	<INPUT TYPE="hidden" name="idWorker" value="<?php echo $worker->id; ?>">
</FORM>
</DIV>
</CENTER>

</TABLE></BODY></HTML>
