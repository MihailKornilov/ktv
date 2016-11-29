$(document).ready(function()
	{	
	$("#register .myBytton").click(function(e){
		if(register.adres_gorod.value==0 || register.adres_ulica.value==0) ErrorView('необходимо обязательно<BR>указать город и улицу.',e);
		else
			if(!register.f.value) ErrorView('не указана фамилия.',e);
			else register.submit();
		return false;
		}).mouseout(ErrorHide);

	$("#f").blur(fioPovtorFind);
	$("#i").blur(fioPovtorFind);
	$("#o").blur(fioPovtorFind);
	});

function RegDataZayavSet(day)
	{
	register.date_zayav.value=day;
	$("#register TH").eq(13).html("<B><A HREF='javascript:' onclick=Calendar('"+day+"',event,'RegDataZayavSet');>"+getFullDay(day)+"</A></B>");
	CalendarClose();
	}

function RegEditStatus(id,OBJ)
	{
	$("#StatusSelect CODE A").eq(0).html(OBJ.innerHTML);
	$("#StatusSelect CODE").eq(0).css("background",OBJ.style.background);
	register.status.value=id;
	}

function fioPovtorFind()
	{
	if($("#f").val())
		$("#fioPovtor").load("/main/abNew/AjaxFioPovtorFind.php?f="+encodeURIComponent($("#f").val())+"&i="+encodeURIComponent($("#i").val())+"&o="+encodeURIComponent($("#o").val()));
	else $("#fioPovtor").html('');
	}

function adresPovtorFind()
	{
	if($("#adres_gorod").val()>0)
		$("#adresPovtor").load("/main/abNew/AjaxAdresPovtorFind.php?gorod="+$("#adres_gorod").val()+"&ulica="+$("#adres_ulica").val()+"&dom="+$("#adres_dom").val()+"&kv="+encodeURIComponent($("#adres_kv").val()));
	else $("#adresPovtor").html('');
	}
