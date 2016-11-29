$(document).ready(function()
	{	
	$("#spisok TR").hover(
		function(){ $(this).find("A:eq(1)").css("color","#D33"); },
		function(){ $(this).find("A:eq(1)").css("color","#E3ECE5"); }
		);
	});

function RemPrimGet(id)
	{
	$("#spisok").find("EM").css("display","inline")
		.end().find(".primEdit").remove();
	$("#td"+id).find("EM").hide()
		.end().append("<DIV class=primEdit>Новое примечание:<BR><INPUT TYPE=text maxlength=255><P><SPAN><A HREF='javascript:' onclick=RemPrimOtmena("+id+");>отмена</A></SPAN><A HREF='javascript:' onclick=RemPrimSave("+id+");><B>сохранить</B></A></P></DIV>")
		.find("DIV:first").slideDown("fast");
	}

function RemPrimOtmena(id)
	{
	$("#td"+id+" DIV:first").slideUp("fast",function(){
		$(this).remove();
		$("#td"+id+" EM").show();
		});
	}


function RemPrimSave(id_remont)
	{
	$("#td"+id_remont)
		.find("EM:first").html("<IMG SRC=/img/ajax-loader.gif>").css("display","inline")
		.load("/main/remont/AjaxRemPrimSave.php?id_remont="+id_remont+"&value="+encodeURIComponent($("#td"+id_remont+" INPUT:first").val()),function(){ $(this).next().css("display","inline"); })
		.end().find("DIV:first").remove();
	}
