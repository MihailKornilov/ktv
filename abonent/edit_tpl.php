<?php include_once('edit.php'); ?>
<HTML>
<HEAD>
<TITLE> KTV: ��������� ������� - �������������� ������ ��������</TITLE>
<META http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="/include/style.css" rel="stylesheet" type="text/css">
<link href="/abonent/abonent.css" rel="stylesheet" type="text/css">
<SCRIPT src="/include/script.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function()
	{	
	$("#imgCalcAbonChange").click(function(){ abCalcAbonChange(this); } );
	$("#imgCalcSumUnical").click(function(){ abCalcSumUnical(); } );
	$("#AbForm .myBytton").click(function(e){ AbEditSave(e); return false; }).mouseout(ErrorHide);

	$("#f").blur(fioPovtorFind);
	$("#i").blur(fioPovtorFind);
	$("#o").blur(fioPovtorFind);

	$("#primSpisok A:first").click(function(){
		var T=$("#primSpisok CENTER:first");
		if(T.css("display")=='none') T.slideDown("fast");
		else T.slideUp("fast");
		return false; });
	});


////////////////////////// ---- �������� ���������� ��� ----------- ///////////////////////////////////////////////////////
function fioPovtorFind()
	{
	if($("#f").val())
		$("#fioPovtor").load("/main/abNew/AjaxFioPovtorFind.php?id="+AbForm.AbEdit.value
			+"&f="+encodeURIComponent($("#f").val())
			+"&i="+encodeURIComponent($("#i").val())
			+"&o="+encodeURIComponent($("#o").val()));
	else $("#fioPovtor").html('');
	}


////////////////////////// ---- �������� ���������� ������ ----------- ///////////////////////////////////////////////////////
function adresPovtorFind()
	{
	if($("#adres_gorod").val()>0)
		$("#adresPovtor").load("/main/abNew/AjaxAdresPovtorFind.php?id="+AbForm.AbEdit.value
			+"&gorod="+$("#adres_gorod").val()
			+"&ulica="+$("#adres_ulica").val()
			+"&dom="+$("#adres_dom").val()
			+"&kv="+encodeURIComponent($("#adres_kv").val()));
	else $("#adresPovtor").html('');
	}



////////////////////////// ---- ����������� ����� ----------- ///////////////////////////////////////////////////////
function abCalcAbonChange(IMG)
	{
	var value=imgCheckValue(IMG.src)
	$("#ctr").toggle("fast");
	AbForm.abonentka_calc.value=value==1?0:1;
	IMG.src="/img/check_"+(value==1?0:1)+".gif";
	}

function abCalcSumUnical()
	{
	CODE=$("#ctr CODE");
	var AbonSum=AbForm.abonentka_sum.value;
	IMG=$("#imgCalcSumUnical IMG");
	if(imgCheckValue(IMG.attr('src'))=='1')
		{
		value=0;
		CODE.html("<BIG>"+AbForm.abonSumGorod.value+"</BIG><INPUT TYPE='hidden' NAME='abonentka_sum' value='"+AbForm.abonSumGorod.value+"'>");
		AbForm.abonentka_sum.value=AbForm.abonSumGorod.value;
		$("#Lg").show("fast");
		}
	else
		{
		value=1;
		CODE.html("<INPUT TYPE=text NAME='abonentka_sum' size=4 maxlength=5 value='"+AbonSum+"'>");
		AbForm.lgota.value=0
		$("#mySel P").text(' ');
		$("#Lg").hide("fast");
		}
	AbForm.abonentka_sum_unical.value=value;
	IMG.attr("src","/img/check_"+value+".gif");
	}

function abLgotaSet(OBJ,SUM,idLgota)
	{
	$("#mySel P").text(OBJ==0?' ':$(OBJ).find("SPAN").text());
	AbForm.abonentka_sum.value=SUM;
	AbForm.lgota.value=idLgota;
	$("#ctr BIG").text(SUM);
	$("#mySel DD").hide();
	}

////////////////////////// ---- ��������� ���� ��������� ������� � ���������� �� �������� ----------- /////////////////////////////////
function abEditStatus(id,OBJ)
	{
	$("#StatusSelect CODE A").eq(0).html(OBJ.innerHTML);
	$("#StatusSelect CODE").eq(0).css("background",OBJ.style.background);
	AbForm.status.value=id;
	var arr = new Date().toUTCString().split(/ /);
	abStatusEditSet(Math.abs(arr[3])+"-"+getMon[arr[2]]+"-"+Math.abs(arr[1]));
	}

////////////////////////// ---- �������������� ������ �������� ----------- ///////////////////////////////////////////////////////
function abDataZayavSet(day)
	{
	AbForm.date_zayav.value=day;
	document.getElementById('AbForm').getElementsByTagName('H4')[0].innerHTML="<A HREF='javascript:' onclick=Calendar('"+day+"',event,'abDataZayavSet');>"+getFullDay(day)+"</A>";
	CalendarClose();
	}

function abDataPodklSet(day)
	{
	AbForm.date_podkl.value=day;
	document.getElementById('AbForm').getElementsByTagName('H4')[1].innerHTML="<A HREF='javascript:' onclick=Calendar('"+day+"',event,'abDataPodklSet');>"+getFullDay(day)+"</A>";
	CalendarClose();
	}

function abStatusEditSet(day)
	{
	AbForm.status_edit.value=day;
	document.getElementById('AbForm').getElementsByTagName('FONT')[0].innerHTML="(<A HREF='javascript:' onclick=Calendar('"+day+"',event,'abStatusEditSet');>"+getSokrDay(day)+"</A>)";
	CalendarClose();
	}

// -- ��������� ���� �������� --
function abDogDateSet(day)
	{
	AbForm.dog_date.value=day;
	document.getElementById('AbForm').getElementsByTagName('H4')[2].innerHTML="<A HREF='javascript:' onclick=Calendar('"+day+"',event,'abDogDateSet');>"+getFullDay(day)+"</A>";
	CalendarClose();
	}

// -- ��������� ���� ������ �������� --
function abPaspDateSet(day)
	{
	AbForm.pasp_vydan_date.value=day;
	$('#AbForm H3 > SPAN:eq(0)').html("<A HREF='javascript:' onclick=Calendar('"+day+"',event,'abPaspDateSet');>"+getSokrDay(day)+"</A>");
	CalendarClose();
	}

////////////////////////// ---- ���������� ----------- ///////////////////////////////////////////////////////
function AbEditSave(e)
	{
	if(AbForm.adres_gorod.value==0 || AbForm.adres_ulica.value==0) ErrorView('�� ������ �����.',e);
	else
		if(!AbForm.f.value) ErrorView('�� ������� �������.',e);
		else
			{
			var regMoney = /^[0-9]+$/;
			if(regMoney.exec(AbForm.abonentka_sum.value)==null)
				ErrorView('����� ����������� ����� ������� �����������.',e);
			else
				if(AbForm.abonentka_sum_unical.value==1 && AbForm.abonentka_sum.value==0)
					ErrorView('����� ����������� ����� �� ����� ���� ����� 0.',e);
				else AbForm.submit();
			}
	}

//-->
</SCRIPT>
</HEAD>

<BODY>
<?php include_once('head.php'); ?>

<?php if($_GET['save']) echo "<DIV id=msgOk>������ ���������.</DIV>"; ?>

<TABLE cellspacing=0 cellpadding=0>
	<caption>������� id:<B><?php echo $abonent->id; ?></B></caption>
	<TR><TD valign=top><?php include_once('abMenu.php'); ?>
			<TD id=abonent>

<FORM METHOD=POST ACTION='/ab<?php echo $abonent->id; ?>/edit' name=AbForm id=AbForm>
<H5>�������� ����������</H5>
<TABLE cellspacing=0 cellpadding=0 id=abEdit>
	<TR><TH width=150><P><B>�����:</B>
			<TH><?php AdresAjax($abonent->adres_gorod,$abonent->adres_ulica,$abonent->adres_dom,$abonent->adres_kv,$abonent->adres_podezd,$abonent->adres_etag,"adresPovtorFind()",1); ?>
					<DIV id=adresPovtor></DIV>
	<TR><TH><P><B>�������:</B>	<TH><INPUT TYPE=text NAME=f id=f value='<?php echo $abonent->f; ?>' maxlength=50>
	<TR><TH><P>���:							<TH><INPUT TYPE=text NAME=i id=i value='<?php echo $abonent->i; ?>' maxlength=50>
	<TR><TH><P>��������:					<TH><INPUT TYPE=text NAME=o id=o value='<?php echo $abonent->o; ?>' maxlength=50><SPAN id=fioPovtor></SPAN>
	<TR><TH><P>�������� �������:	<TH><INPUT TYPE=text NAME=tel_dom style=width:250px; maxlength=50 value='<?php echo $abonent->tel_dom; ?>'>
	<TR><TH><P>������� �������:		<TH><INPUT TYPE=text NAME=tel_sot style=width:250px; maxlength=50 value='<?php echo $abonent->tel_sot; ?>'>
	<TR><TH><P>���� ������ ������:	<TH><H4><?php echo $dateZayav; ?></H4><INPUT TYPE="hidden" name='date_zayav' value='<?php echo $abonent->date_zayav; ?>'>
	<TR><TH><P>���� �����������:	<TH><H4><?php echo $datePodkl; ?></H4><INPUT TYPE="hidden" name='date_podkl' value='<?php echo $abonent->date_podkl; ?>'>
	<TR><TH><P>������:						<TH><?php echo StatusSelect($abonent->status,'abEditStatus',1); ?><FONT><?php echo $statusEdit; ?></FONT>
																		<INPUT TYPE="hidden" name="status" value='<?php echo $abonent->status; ?>'>
																		<INPUT TYPE="hidden" name='status_edit' value='<?php echo $abonent->status_edit; ?>'>
</TABLE>


<H5>����������� �����</H5>
<TABLE cellspacing=0 cellpadding=0 id=abEdit>	
	<TR><TH width=150><P>���������<BR>����������� �����:	<TH><IMG SRC='/img/check_<?php echo $abonent->abonentka_calc; ?>.gif' id=imgCalcAbonChange>
																									<INPUT TYPE=hidden NAME='abonentka_calc' id='abonentka_calc' value='<?php echo $abonent->abonentka_calc; ?>'>
</TABLE>

<DIV id=ctr <?php echo $CalcDisplay; ?>>
	<TABLE cellspacing=0 cellpadding=0 id=abEdit>	
		<TR><TH width=150><P>����� � �����: <TH><CODE><?php echo $AbonSum; ?></CODE>
																<U id=imgCalcSumUnical><IMG SRC='/img/check_<?php echo $abonent->abonentka_sum_unical; ?>.gif'>�������������� �����</U>
																<INPUT TYPE=hidden NAME='abonentka_sum_unical' value='<?php echo $abonent->abonentka_sum_unical; ?>'>
																<INPUT TYPE=hidden NAME='abonSumGorod' value='<?php echo $AbonSumma[$abonent->adres_gorod]; ?>'>
	</TABLE>

	<DIV id=Lg <?php echo $LgotaDisplay; ?>><TABLE cellspacing=0 cellpadding=0 id=abEdit><TR><TH width=150><P>������:<TH><?php echo $lgota; ?><TH>&nbsp;</TABLE></DIV>
	<INPUT TYPE=hidden NAME='lgota' value='<?php echo $abonent->lgota; ?>'>
</DIV>



<H5>�������</H5>
<TABLE cellspacing=0 cellpadding=0 id=abEdit>
	<TR><TH width=150><P>����� ��������:	<TH><INPUT TYPE=text NAME='dog_nomer' size=15 maxlength=20 value='<?php echo $abonent->dog_nomer; ?>'>
	<TR><TH><P>���� ����������:		<TH><H4><?php echo $dogDate; ?></H4><INPUT TYPE="hidden" name='dog_date' value='<?php echo $abonent->dog_date; ?>'>
	<TR><TH><P>��������� ������:	<TH>
									<H3>�����:<INPUT TYPE=text NAME='pasp_seria' size=4 maxlength=5 value='<?php echo $abonent->pasp_seria; ?>'>
											�����:<INPUT TYPE=text NAME='pasp_nomer' size=6 maxlength=6 value='<?php echo $abonent->pasp_nomer; ?>'></H3>
									<H3>��� �����:<INPUT TYPE=text NAME='pasp_vydan_kem' size=40 maxlength=50 value='<?php echo $abonent->pasp_vydan_kem; ?>'></H3>
									<H3>���� ������: <SPAN><?php echo $paspVydanDate; ?></SPAN><INPUT TYPE="hidden" name='pasp_vydan_date' value='<?php echo $abonent->pasp_vydan_date; ?>'></H3>
									<H3>��������:<INPUT TYPE=text NAME='pasp_propiska' size=40 maxlength=50 value='<?php echo $abonent->pasp_propiska; ?>'></H3>

</TABLE>


<H5>����������</H5>
<TABLE cellspacing=0 cellpadding=0 id=abEdit>
<TR><TD colspan=2 align=center><TEXTAREA NAME='prim'><?php echo $abonent->prim; ?></TEXTAREA>
														<DIV id=primSpisok><?php echo $primSpisok; ?></DIV><BR>
														<DIV class=myBytton><A HREF='#'>���������</A></DIV><BR>
</TABLE>

<INPUT TYPE=hidden NAME=AbEdit value='<?php echo $abonent->id; ?>'>
</FORM>

</TABLE>



</TABLE></BODY></HTML>
