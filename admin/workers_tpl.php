<?php include_once('workers.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - ������ �����������</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/admin/admin.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=path>
	<A HREF="/">�������</A> / 
	<A HREF="/admin">�����������������</A> / 
	���������� ������������
</DIV>

<A HREF="/admin/workers/add">�������� ������ ����������</A>
<BR>
<DIV id=admWork><?php echo $workSpisok; ?></DIV>

</TABLE></BODY></HTML>
