<?php include_once('find.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: Интерфейс кассира - Поиск</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/find/find.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{
	findSpisokGet();

	$("#findCountStr").click(function(e){
		$(this).find("A").attr("class","radio0");
		$(e.target).attr("class","radio1");
		findSpisokGet('',1);
		return false;
		});
	
	$("#findKolonki").click(function(){
		findSpisokGet();
		return false;
		});

	$("#findHead TT:first").click(function(){
		$("#f_fio_tel").val('');
		$("#findStatus").val(0);
		$("#StatusSelect CODE").css("background","#F2FAF2").find("A").html("<I>не выбран</I>");
		GorodSet(0);
		return false;
		});
	});

function findStatusSet(id,OBJ)
	{
	$("#findStatus").val(id);
	$("#StatusSelect CODE").css("background",OBJ.style.background).find("A").html(OBJ.innerHTML);
	findSpisokGet('',1);
	return false;
	}

function findSpisokGet(sort,page)
	{
	$("#findHead SPAN:first").html("<IMG SRC=/img/ajax-loader.gif>");
	var URL="kolonki="+$("#findKolonki INPUT:first").val()+"-"+
									$("#findKolonki INPUT:eq(1)").val()+"-"+
									$("#findKolonki INPUT:eq(2)").val()+"-"+
									$("#findKolonki INPUT:eq(3)").val()+"-"+
									$("#findKolonki INPUT:eq(4)").val()+"-"+
									$("#findKolonki INPUT:eq(5)").val();
	URL+="&gorod="+$("#adres_gorod").val();
	URL+="&ulica="+$("#adres_ulica").val();
	URL+="&dom="+$("#adres_dom").val();
	URL+="&kv="+encodeURIComponent($("#adres_kv").val());
	URL+="&fio_tel="+encodeURIComponent($("#f_fio_tel").val());
	URL+="&status="+$("#findStatus").val();
	URL+="&strok="+$("#findCountStr .radio1").text();
	if(sort) URL+="&sort="+sort;
	if(page) URL+="&page="+page;
	$("#findSpisok").load("/find/AjaxFindSpisok.php?"+URL,function(){
		$("#findHead SPAN:first").html('');
		ktvinit();
		if($("#findKolonki INPUT:eq(5)").val()==1)
			$("#spisok TR").bind({
				mouseover:	function(){ var A=$(this).find("EM:first A:first"); BG=A.css("color"); A.css("color","#D00"); },
				mouseout:	function(){ $(this).find("EM:first A:first").css("color",BG); }		
				});
		});
	return false;
	}


function FindPrimEdit(id)
	{
	$("#spisok").find(".primEdit").remove()
		.end().find("EM").css("display","inline")
		.end().find("TT").css("display","inline");

	$("#td"+id).find("EM:first").hide()
		.end().find("TT:first").hide()
		.end().append("<DIV class=primEdit>Новое примечание:<BR><INPUT TYPE=text maxlength=255><P><SPAN><A HREF='javascript:' onclick=FindPrimOtmena("+id+");>отмена</A></SPAN><A HREF='javascript:' onclick=FindPrimSave("+id+");><B>сохранить</B></A></P></DIV>")
		.find("DIV:first").slideDown("fast");
	}

function FindPrimOtmena(id)
	{
	$("#td"+id+" DIV:first").slideUp("fast",function(){
		$(this).remove();
		$("#td"+id).find("TT:first").css("display","inline")
			.end().find("EM:first").css("display","inline");
		});	
	}

function FindPrimSave(id)
	{
	$("#td"+id).find("TT:first").css("display","inline").html("<IMG SRC=/img/ajax-loader.gif>").load("/find/AjaxFindPrimSave.php?id_abonent="+id+"&value="+encodeURIComponent($("#td"+id+" INPUT:first").val()),function(){
			$(this).next().css("display","inline").next().remove();
			})
		.end().find("DIV:first").remove();
	}
//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<DIV id=findHead><U>Условия для поиска</U><TT>(<A HREF='javascript:'>очистить</A>)</TT><SPAN></SPAN></DIV>
<DIV id=findRamka>
	
	<DIV style="float:left;width:560px;">

		<DIV class=row>
			<DIV class=about>Адрес:</DIV>
			<DIV class=contain><?php AdresAjax($find->f_gorod,$find->f_ulica,$find->f_dom,$find->f_kv,0,0,"findSpisokGet('',1)"); ?></DIV>
		</DIV>

		<DIV class=row>
			<DIV class=about>ФИО или телефон:</DIV>
			<DIV class=contain><INPUT TYPE="text" id=f_fio_tel value="<?php echo $find->f_fio_tel; ?>" onkeyup=findSpisokGet('',1);></DIV>
		</DIV>

		<DIV class=row>
			<DIV class=about>Статус:</DIV>
			<DIV class=contain><?php echo StatusSelect($find->f_status,'findStatusSet'); ?><INPUT TYPE=hidden id=findStatus value='<?php echo $find->f_status; ?>'></DIV>
		</DIV>

		<DIV class=row>
			<DIV class=about>Строк на странице:</DIV>
			<DIV class=contain id=findCountStr>
				<A HREF='javascript:' class=radio<?php echo ($find->strok==50?1:0); ?>>50</A>
				<A HREF='javascript:' class=radio<?php echo ($find->strok==100?1:0); ?>>100</A>
				<A HREF='javascript:' class=radio<?php echo ($find->strok==300?1:0); ?>>300</A>
			</DIV>
		</DIV>

	</DIV>

	<DIV id=findKolonki>
		<H1>Показывать колонки:</H1>
<?php
CheckBox('v_telefon',$find->v_balans,'Телефоны');
CheckBox('v_balans',$find->v_balans,'Баланс');
CheckBox('v_zayav',$find->v_zayav,'Дата заявки');
CheckBox('v_podkl',$find->v_podkl,'Дата подключения');
CheckBox('v_status',$find->v_status,'Статус');
CheckBox('v_prim',$find->v_prim,'Примечание');
?>
	</DIV>

	<div style="clear:both;height:0px;overflow:hidden;">&nbsp;</div>
</DIV>

<DIV id=findSpisok></DIV>

</TABLE></BODY></HTML>
