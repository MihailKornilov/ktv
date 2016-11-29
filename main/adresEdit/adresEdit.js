$(document).ready(function()
	{	
	$("#adresEdit IMG:first").click(function(){
		$("#aUlicaAdd").hide("fast");
		$("#aDomAdd").hide("fast");
		$("#aGorodAdd").toggle("fast");
		});

	$("#adresEdit IMG:eq(1)").click(function(e){
		$("#aGorodAdd").hide("fast");
		$("#aDomAdd").hide("fast");
		if($("#aGorodSpisok A").length>0) $("#aUlicaAdd").toggle("fast"); else ErrorView("сначала нужно<BR>внести населённый пункт.",e);
		}).mouseout(ErrorHide);

	$("#adresEdit IMG:eq(2)").click(function(e){
		$("#aGorodAdd").hide("fast");
		$("#aUlicaAdd").hide("fast");
		if($("#aUlicaSpisok A").length>0) $("#aDomAdd").toggle("fast"); else ErrorView("сначала нужно внести улицу.",e);
		}).mouseout(ErrorHide);


	$("#aGorodAdd BUTTON:first").click(function(e){
		var VAL=$("#aGorodAdd INPUT:first").val();
		if(!VAL) ErrorView("укажите название населённого пункта.",e);
		else
			{
			var REP=0
			var NAME=$("#aGorodSpisok A");
			var LEN=NAME.length;
			if(LEN>0) for(var n=0;n<LEN;n++) if(VAL==NAME.eq(n).text()) REP=1;
			if(REP==1) ErrorView("населённый пункт с таким названием<BR>уже присутствует в списке.",e);
			else
				{
				$("#aGorodAdd").hide("fast").find("INPUT:first").val('');
				$("#aUlicaSpisok").find("DIV:first").slideUp("fast").end().append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>");
				$("#aDomSpisok").find("DIV:first").slideUp("fast").end().append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>");
				$("#aGorodSpisok DIV:first").slideUp("fast",function(){
					$("#aGorodSpisok").append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>");
					$(this).load("/main/adresEdit/AjaxGorodAdd.php?&name="+encodeURIComponent(VAL),function(){
						$(this).slideDown("fast");
						$("#aGorodSpisok DIV:last").remove();
						$("#aUlicaSpisok").find("DIV:last").remove().end().find("DIV:first").html("<SPAN>улиц нет</SPAN>").slideDown("fast");
						$("#aDomSpisok").find("DIV:last").remove().end().find("DIV:first").html("<SPAN>домов нет</SPAN>").slideDown("fast");
						$("#aUlicaAdd").find("B:first").text(VAL).end().find("INPUT:last").val('');
						});
					});
				}
			}
		}).mouseout(ErrorHide);
	
	
	$("#aUlicaAdd BUTTON:first").click(function(e){
		var VAL=$("#aUlicaAdd INPUT:first").val();
		if(!VAL) ErrorView("укажите название улицы.",e);
		else
			{
			var NAME=$("#aUlicaSpisok A");
			var REP=0
			for(var n=0;n<NAME.length;n++) if(VAL==NAME.eq(n).text()) REP=1;
			if(REP==1) ErrorView("улица с таким названием<BR>уже присутствует в списке.",e);
			else
				{
				$("#aUlicaAdd").hide("fast").find("INPUT:first").val('');
				$("#aDomSpisok DIV:first").slideUp("fast",function(){ $("#aDomSpisok").append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>"); });
				$("#aUlicaSpisok DIV:first").slideUp("fast",function(){
					$("#aUlicaSpisok").append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>");
					$(this).load("/main/adresEdit/AjaxUlicaAdd.php?gorod="+$("#aUlicaAdd INPUT:last").val()+"&name="+encodeURIComponent(VAL),function(){
						$("#aUlicaSpisok DIV:last").remove();
						$(this).slideDown("fast");
						$("#aDomSpisok").find("DIV:last").remove().end().find("DIV:first").html("<SPAN>домов нет</SPAN>").slideDown("fast");
						$("#aDomAdd").find("B:first").text(VAL).end().find("INPUT:last").val('');
						});
					});
				}
			}
		}).mouseout(ErrorHide);

	$("#aDomAdd BUTTON:first").click(function(e){
		var VAL=$("#aDomAdd INPUT:first").val();
		if(!VAL) ErrorView("укажите номер дома.",e);
		else
			{
			var REP=0
			var NAME=$("#aDomSpisok DD");
			var LEN=NAME.length;
			if(LEN>0) for(var n=0;n<LEN;n++) if(VAL==NAME.eq(n).text()) REP=1;
			if(REP==1) ErrorView("дом с таким номером<BR>уже присутствует в списке.",e);
			else
				{
				$("#aDomAdd").hide("fast").find("INPUT:first").val('');
				$("#aDomSpisok DIV:first").slideUp("fast",function(){
					$("#aDomSpisok").append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>");
					$(this).load("/main/adresEdit/AjaxDomAdd.php?gorod="+$("#aUlicaAdd INPUT:last").val()+"&ulica="+$("#aDomAdd INPUT:last").val()+"&num="+encodeURIComponent(VAL),function(){
						$(this).slideDown("fast");
						$("#aDomSpisok DIV:last").remove();
						});
					});
				}
			}
		}).mouseout(ErrorHide);
	});

function adresUlicaGet(id,e)
	{
	$("#aGorodAdd").hide("fast");
	$("#aUlicaAdd").hide("fast");
	$("#aDomAdd").hide("fast");

	$("#aGorodSpisok A").attr("class","aNaim");
	$("#aDomSpisok DIV:first").slideUp("fast",function(){ $("#aDomSpisok").append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>"); });
	$("#aUlicaSpisok DIV:first").slideUp("fast",function(){
		$("#aUlicaSpisok").append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>")
			.find("DIV:first").load("/main/adresEdit/AjaxUlicaGet.php?gorod="+id,function(){
				$(this).slideDown("fast");
				$("#aUlicaSpisok DIV:last").remove();
				$("#aDomSpisok DIV:first").load("/main/adresEdit/AjaxDomGet.php?gorod="+id,function(){
					$(this).slideDown("fast");
					$("#aDomSpisok DIV:last").remove();
					});
				$(e).attr("class","aNaimSel");
				$("#aUlicaAdd").find("B:first").text($(e).text()).end().find("INPUT:last").val(id);
				$("#aDomAdd").find("B:first").text($("#aUlicaSpisok A:first").text()).end().find("INPUT:last").val('');
				});
		});
	}

function adresDomGet(id,e)
	{
	$("#aGorodAdd").hide("fast");
	$("#aUlicaAdd").hide("fast");
	$("#aDomAdd").hide("fast");

	$("#aUlicaSpisok A").attr("class","aNaim");
	$("#aDomSpisok DIV:first").slideUp("fast",function(){
		$("#aDomSpisok").append("<DIV><IMG SRC=/img/ajax-loader.gif></DIV>");
		$(this).load("/main/adresEdit/AjaxDomGet.php?ulica="+id,function(){
				$(this).slideDown("fast");
				$("#aDomSpisok DIV:last").remove();
				$(e).attr("class","aNaimSel");
				$("#aDomAdd").find("B:first").text($(e).text()).end().find("INPUT:last").val(id);
				});
		});
	}
