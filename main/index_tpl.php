<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - �������</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/main/main.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{
	$("#ideaSpisok").load("/main/AjaxIdeaGet.php?id=0",ideaSpisokLoad);

	$("#idea .myBytton").click(function(e){
		var TEXT=$("#idea TEXTAREA:first");
		if(!TEXT.val()) ErrorView("����� ����������� ��������� ����",e);
		else
			{
			var IMG=$("#idea P:first IMG:first");
			IMG.css("display","inline");
			$("#ideaSpisok").load("/main/AjaxIdeaGet.php?content="+encodeURIComponent(TEXT.val()),function(){
				TEXT.val('');
				IMG.css("display","none");
				ideaSpisokLoad();
				});
			}
		return false;
		}).mouseout(ErrorHide);
	});

function ideaSpisokLoad()
	{
	$("#ideaSpisok H6 A").bind('mouseout',ErrorHide);
	}

function ideaOtvetView(id)
	{
	$("#ideaSpisok H6").slideUp("fast");
	$("#idea"+id+" H6:first").slideDown("fast");
	}

function ideaOtvetSend(id,e)
	{
	OTVET=$("#idea"+id+" INPUT:first").val();
	if(!OTVET) ErrorView("�� ����� �����",e);
	else
		{
		$("#idea"+id+" A:last").remove();
		$("#idea"+id+" H6:first").append("<IMG SRC=/img/ajax-loader.gif>");
		$("#ideaSpisok").load("/main/AjaxIdeaGet.php?id="+id+"&otvet="+encodeURIComponent(OTVET),ideaSpisokLoad);
		}
	}

function ideaGotovo(id)
	{
	$("#ideaSpisok").load("/main/AjaxIdeaGet.php?id="+id+"&gotovo=1",ideaSpisokLoad);
	}
//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=MainLinks>
	<H1>������������</H1>
	<DIV><H4>
		<A HREF='/my-setup'><IMG SRC=/img/settings.gif><P>���<BR>���������</P></A>
		<A HREF='/adres-edit'><IMG SRC=/img/adres_edit.gif><P>��������������<BR>�������</P></A>
		<A HREF='/remont/wait'><IMG SRC=/img/remont.gif><P>������<BR>�� �������������</P></A>
		<?php if($kassir->rule_abon_calc==1) { ?><A HREF='/abon-calc'><IMG SRC=/img/abon_calc.gif><P>����������<BR>����������� �����</P></A><?php } ?>
		<!-- <A HREF='index.php?p=7'><IMG SRC=/img/AbonReCalc.gif><P>����������<BR>����������� �����</P></A> -->
		<!-- <A HREF='index.php?p=9'><IMG SRC=/img/kvit_print.gif><P>������<BR>���������</P></A> -->
	</H4></DIV>

</DIV>

	<DIV id=idea>
		<H1>����������� ��� ��������� � ����������</H1>
		<P>��������� ����, ������� ���� ������ ��� ����� ���������:<IMG SRC=/img/ajax-loader.gif></P>
		<P><TEXTAREA></TEXTAREA></P>
		<H4><DIV class=myBytton><A HREF='#'>������</A></DIV></H4>
		<DIV id=ideaSpisok></DIV>
	</DIV>

</TABLE></BODY></HTML>


