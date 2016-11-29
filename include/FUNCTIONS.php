<?php
function DataSelect($table,$god,$date,$jezt)
	{
	//$table:	название таблицы
	//$god:	первый год
	//$date:	выставляется дата, пусто - если не нужно
	//$jezt:		показывать 'сегодня'
	$d=explode('-',$date);
	$DataRet="<SELECT NAME='".$table."_day' class='data'>";
	$DataRet.="<OPTION value='0'>- -";
	for($n=1;$n<=31;$n++) $DataRet.="<OPTION value='".($n<10?'0':'').$n."'".(round($d[2])==$n?' selected':'').">".$n;
	$DataRet.="</SELECT>";
	
	$DataRet.="<SELECT NAME='".$table."_mon' class='data'>";
	$DataRet.="<OPTION value='0'>- -";
	$DataRet.="<OPTION value='01'".($d[1]=='01'?' selected':'').">января";
	$DataRet.="<OPTION value='02'".($d[1]=='02'?' selected':'').">февраля";
	$DataRet.="<OPTION value='03'".($d[1]=='03'?' selected':'').">марта";
	$DataRet.="<OPTION value='04'".($d[1]=='04'?' selected':'').">апреля";
	$DataRet.="<OPTION value='05'".($d[1]=='05'?' selected':'').">мая";
	$DataRet.="<OPTION value='06'".($d[1]=='06'?' selected':'').">июня";
	$DataRet.="<OPTION value='07'".($d[1]=='07'?' selected':'').">июля";
	$DataRet.="<OPTION value='08'".($d[1]=='08'?' selected':'').">августа";
	$DataRet.="<OPTION value='09'".($d[1]=='09'?' selected':'').">сентября";
	$DataRet.="<OPTION value='10'".($d[1]=='10'?' selected':'').">октября";
	$DataRet.="<OPTION value='11'".($d[1]=='11'?' selected':'').">ноября";
	$DataRet.="<OPTION value='12'".($d[1]=='12'?' selected':'').">декабря";
	$DataRet.="</SELECT>";
	
	$DataRet.="<SELECT NAME='".$table."_year' class='data'>";
	$DataRet.="<OPTION value='0'>- - - -";	
	for($n=$god;$n<=strftime("%Y",time());$n++) $DataRet.="<OPTION value='".$n."'".($d[0]==$n?' selected':'').">".$n;
	$DataRet.="</SELECT>";
	if($jezt) $DataRet.=" <A HREF='javascript:' onclick=document.all.".$table."_day.value='".strftime('%d',time())."';document.all.".$table."_mon.value='".strftime('%m',time())."';document.all.".$table."_year.value='".strftime('%Y',time())."';>сегодня</A>";
	return $DataRet;
	}


function NumCreate($num='')
	{
	if($num)
		if(preg_match("/\D/",$num.'.',$match,PREG_OFFSET_CAPTURE))
				for($n=0;$n<=4-$match[0][1];$n++) $num='0'.$num;
	return $num;
	}


function AdresSet($id,$gorod,$ulica,$dom)
	{
	global $ktv;

	if($_POST['adres_gorod']>0)
		$gorodName=$ktv->QRow("select name from adres_gorod where id=".$gorod);
	else $gorodName='';

	if($_POST['adres_ulica']>0)
		$ulicaName=$ktv->QRow("select name from adres_ulica where id=".$ulica);
	else $ulicaName='';

	if($_POST['adres_dom']>0)
		$domNum=$ktv->QRow("select num from adres_dom where id=".$dom);
	else $domNum='';

	$ktv->Query("update abonent set adres_gorod_name='".$gorodName."',adres_ulica_name='".$ulicaName."',adres_dom_num='".$domNum."' where id=".$id);
	}


function AdresSmall($sql=0,$gorod='',$ulica='',$dom='',$kv='')
	{
	global $ktv;
	$adres='';
	if($gorod)
		{
		if($sql) $gorod=$ktv->QRow("select name from adres_gorod where id=".$gorod);
		$adres.=$gorod;
		if($ulica)
			{
			if($sql) $ulica=$ktv->QRow("select name from adres_ulica where id=".$ulica);
			$adres.=", ".$ulica;
			if($dom)
				{
				if($sql) $dom=$ktv->QRow("select num from adres_dom where id=".$dom);
				$adres.=" ".preg_replace("/^0{1,}/",'',$dom).($kv?'-'.preg_replace("/^0{1,}/",'',$kv):'');
				}
			}
		}
	return $adres;
	}










function AdresAjax($gorod=0,$ulica=0,$dom=0,$kv='',$podezd=0,$etag=0,$func='',$PEview=0)
	{
	// $PEview : показывать или нет подъезд и этаж
	// $func : функция, которая выполняется после установки поля адреса
	global $ktv,$kassir;
	$Adres="<DIV id=Adres>";
		$Adres.="<TABLE cellspacing=0 cellpadding=0>";

// ------------------ УСТАНОВКА СПИСКА ГОРОДОВ ------------
		$Adres.="<TR><TD>г.<TD>";
		$Adres.="<DIV><DL style=width:150px;><DD><A HREF='javascript:' onclick=GorodSet(0);><I>не указан</I></A>";
		$gorodSP=$ktv->QueryPtPArray("select id,name from adres_gorod where id in(".$kassir->rule_gorod_allow.") order by name");
		if(count($gorodSP)>0) foreach($gorodSP as $id=>$g) $Adres.="<DD><A HREF='javascript:' onclick=GorodSet(".$id."); id=gorod".$id.">".$g."</A>";
		$Adres.="</DL></DIV><TT onclick=AdresOpen(0);>".($gorod>0?"<B>".$gorodSP[$gorod]."</B>":'<I>выбрать</I>')."</TT>";

// ------------------ УСТАНОВКА СПИСКА УЛИЦ ------------
		if($gorod>0)
			{
			$ulicaSend="<DIV><DL style=width:150px;><DD><A HREF='javascript:' onclick=UlicaSet(0);><I>не указана</I></A>";
			$ulicaSP=$ktv->QueryPtPArray("select id,name from adres_ulica where id_gorod=".$gorod." order by name");
			if(count($ulicaSP)>0) foreach($ulicaSP as $id=>$u) $ulicaSend.="<DD><A HREF='javascript:' onclick=UlicaSet(".$id."); id=ulica".$id.">".$u."</A>";
			$ulicaSend.="</DL></DIV><TT onclick=AdresOpen(1);>".($ulica>0?"<B>".$ulicaSP[$ulica]."</B>":'<I>выбрать</I>')."</TT>";
			$ul='ул.';
			}
		$Adres.="<TD>".$ul."<TD>".$ulicaSend;

// ------------------ УСТАНОВКА СПИСКА ДОМОВ ------------
		if($ulica>0)
			{
			$domSend="<DIV><DL style=width:60px;><DD><A HREF='javascript:' onclick=DomSet(0);><I>не указан</I></A>";
			$domSP=$ktv->QueryPtPArray("select id,num from adres_dom where id_ulica=".$ulica." order by num");
			if(count($domSP)>0) foreach($domSP as $id=>$d) $domSend.="<DD><A HREF='javascript:' onclick=DomSet(".$id.");  id=dom".$id." style=text-align:center;>".preg_replace("/^0{1,}/",'',$d)."</A>";
			$domSend.="</DL></DIV><TT onclick=AdresOpen(2);>".($dom?"<B>".preg_replace("/^0{1,}/",'',$domSP[$dom])."</B>":'<I>выбрать</I>')."</TT>";
			$d='д.';
			}
		$Adres.="<TD>".$d."<TD>".$domSend;

		$Adres.="<TD>".($dom>0?"кв.":'')."<TD><INPUT TYPE=text NAME=adres_kv id=adres_kv maxlength=4 ".($dom==0?"style=display:none;":'')." value='".preg_replace("/^0{1,}/",'',$kv)."' ".($func?"onkeyup=".$func."();":'').">";
		$Adres.="</TABLE>";

		if($PEview!=0)
			{
			$Adres.="<TABLE cellspacing=0 cellpadding=0 ".($dom==0?"style=display:none;":'').">";
				$Adres.="<TR><TD>подъезд:<TD><DIV><DL style=width:60px;><DD><A HREF='javascript:' onclick=PodezdSet(0);><I>не указан</I></A>";
				for($n=1;$n<=8;$n++) $Adres.="<DD><A HREF='javascript:' onclick=PodezdSet(".$n."); style=text-align:center;>".$n."</A>";
				$Adres.="</DL></DIV><TT onclick=AdresOpen(3);>".($podezd?"<B>".$podezd."</B>":'<I>выбрать</I>')."</TT>";
		
				$Adres.="<TD>этаж:<TD><DIV><DL style=width:60px;><DD><A HREF='javascript:' onclick=EtagSet(0);><I>не указан</I></A>";
				for($n=1;$n<=6;$n++) $Adres.="<DD><A HREF='javascript:' onclick=EtagSet(".$n."); style=text-align:center;>".$n."</A>";
				$Adres.="</DL></DIV><TT onclick=AdresOpen(4);>".($etag?"<B>".$etag."</B>":'<I>выбрать</I>')."</TT>";
			$Adres.="</TABLE>";
			$Adres.="<INPUT TYPE=hidden name=adres_podezd	id=adres_podezd	value='".$podezd."'>";
			$Adres.="<INPUT TYPE=hidden name=adres_etag		id=adres_etag		value='".$etag."'>";
			}
	$Adres.="</DIV>";

	$Adres.="<INPUT TYPE=hidden name=adres_gorod		id=adres_gorod	value='".$gorod."'>";
	$Adres.="<INPUT TYPE=hidden name=adres_ulica		id=adres_ulica		value='".$ulica."'>";
	$Adres.="<INPUT TYPE=hidden name=adres_dom		id=adres_dom		value='".$dom."'>";
	echo $Adres;
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
// ---------------------------- ВВОД  АДРЕСА -------------------------------------
function AdresOpen(n)	{ $("#Adres DL:eq("+n+")").show("fast"); }
function GorodSet(id)
	{
	$("#adres_gorod").val(id);
	$("#adres_ulica").val(0);
	$("#adres_dom").val(0);

	var TT=$("#Adres TT:first");
	var TD=$("#Adres TD");
	if(id==0)
		{
		TT.html("<I>выбрать</I>");
		TD.eq(2).html("&nbsp;");
		TD.eq(3).html("&nbsp;");
		<?php if($func) echo $func; ?>
		}
	else
		{
		TD.eq(3).html("<IMG SRC=/img/ajax-loader.gif>");
		TT.text($("#gorod"+id).text()+", ");
		TD.eq(2).text("ул.");
		TD.eq(3).load("/abonent/AjaxUlicaSelect.php?gorod="+id<?php if($func) echo ",function(){".$func.";}"; ?>);
		}

	DomView('none');
	TD.eq(4).html("&nbsp;");
	TD.eq(5).html("&nbsp;");
	TD.eq(6).html("&nbsp;");
	}

function UlicaSet(id)
	{
	$("#adres_ulica").val(id);
	$("#adres_dom").val(0);

	var TT=$("#Adres TT:eq(1)");
	var TD=$("#Adres TD");
	if(id==0)
		{
		TT.html("<I>выбрать</I>");
		TD.eq(4).html("&nbsp;");
		TD.eq(5).html("&nbsp;");
		<?php if($func) echo $func; ?>
		}
	else
		{
		TD.eq(5).html("<IMG SRC=/img/ajax-loader.gif>");
		TT.text($("#ulica"+id).text()+", ");
		TD.eq(4).text("д.");
		TD.eq(5).load("/abonent/AjaxDomSelect.php?ulica="+id<?php if($func) echo ",function(){".$func.";}"; ?>);
		}

	DomView('none');
	TD.eq(6).html("&nbsp;");
	}

function DomSet(id)
	{
	var TT=$("#Adres TT:eq(2)");
	var TD=$("#Adres TD");
	if(id==0)
		{
		TT.html("<I>выбрать</I>");
		TD.eq(6).html("&nbsp;");
		DomView('none');
		}
	else
		{
		TT.text($("#dom"+id).text()+", ");
		TD.eq(6).text("кв.");
		DomView('block');
		}

	$("#adres_dom").val(id);
	<?php if($func) echo $func; ?>
	}

function DomView(val)
	{
	$("#adres_kv").val("").css("display",val);
	$("#Adres TABLE:eq(1)").css("display",val);
	$("#adres_podezd").val(0);
	$("#adres_etag").val(0);
	$("#Adres TT:eq(3)").html("<I>выбрать</I>");
	$("#Adres TT:eq(4)").html("<I>выбрать</I>");
	}

function PodezdSet(id)
	{
	$("#Adres TT:eq(3)").html(id==0?"<I>выбрать</I>":id);
	$("#adres_podezd").val(id);
	}

function EtagSet(id)
	{
	$("#Adres TT:eq(4)").html(id==0?"<I>выбрать</I>":id);
	$("#adres_etag").val(id);
	}
//-->
</SCRIPT>
<?php } 







function Checkbox($name,$value,$txt='',$ret=0)
	{
	$check="<SPAN class=check><A HREF='javascript:' class=check".$value.">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$txt."</A><INPUT TYPE=hidden name='".$name."' value='".$value."'></SPAN>";
	if($ret==0) echo $check; else return $check;
	}





function DateSet($name)
	{
	if($_POST[$name.'_year']=='0000' or $_POST[$name.'_mon']=='00' or $_POST[$name.'_day']=='00')
		return "0000-00-00";
	else
		return $_POST[$name.'_year']."-".$_POST[$name.'_mon']."-".$_POST[$name.'_day'];
	}

function rmStatus($value)
	{
	switch($value)
		{
		case 3; return "<B style=color:#666;>удалена</B>";
		case 1; return "<B style=color:#0A0>выполнена</B>";
		default: return "<B style=color:#A00>ожидает</B>";
		}
	}

function StatusSelect($tekStatus_id=0,$script='',$NoNull=0,$NoDel=0)
	{
	global $ktv;
	
	$status=$ktv->QueryObjectArray("select * from abonent_status order by sort");
	$statusSend="<DIV id=StatusSelect><BLOCKQUOTE><DL>";
	if(!$NoNull) $statusSend.="<DD><A HREF='javascript:' onclick=".$script."(0,this);><I>не выбран</I></A>";
	foreach($status as $st)
		{
		if($NoDel and $st->id==2) ; else $statusSend.="<DD><A HREF='javascript:' onclick=".$script."(".$st->id.",this); style=background:#".$st->bg.">".$st->name."</A>";
		if($tekStatus_id==$st->id)
			{
			$tekSstatusBg="style=background:#".$st->bg;
			$tekStatusName=$st->name;
			}
		}
	$statusSend.="</DL></BLOCKQUOTE>";


	$statusSend.="<CODE ".$tekSstatusBg.">";
	$statusSend.="<A HREF='javascript:'>".($tekStatus_id>0?$tekStatusName:'<I>не выбран</I>')."</A>";
	$statusSend.="</CODE></DIV>";
												
	return $statusSend;
	}
?>
