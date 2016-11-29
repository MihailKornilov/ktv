<?php
if(abs($_GET['mon'])-1==0) $back=($_GET['year']-1)."/12"; else $back=$_GET['year']."/".(abs($_GET['mon'])-1);
if(abs($_GET['mon'])+1==13) $next=($_GET['year']+1)."/1"; else $next=$_GET['year']."/".(abs($_GET['mon'])+1);

$CalendMon="<H6><DL id=CalendMon>";
for($n=1;$n<=12;$n++) $CalendMon.="<D".($n==abs($_GET['mon'])?'T':'D')."><A HREF='/report/".$_GET['year']."/".$n."/".$_GET['table']."'>".fullmonth($n)."</A>";
$CalendMon.="</DL></H6>";

$CalendYear="<H6><DL id=CalendYear>";
for($n=$_GET['year']-5;$n<=strftime("%Y",time())+1;$n++) $CalendYear.="<D".($n==$_GET['year']?'T':'D')."><A HREF='/report/".$n."/".$_GET['mon']."/".$_GET['table']."'>".$n."</A>";
$CalendYear.="</DL></H6>";

$calend="<TABLE cellpadding=0 cellspacing=1 id=repCalendar width=150>";
$calend.="<TR><TD width=20><B><A HREF='/report/".$back."/".$_GET['table']."'><</A></B>";
	$calend.="<TD colspan=3 style=text-align:right;padding-right:5px;><INPUT TYPE=hidden value=".abs($_GET['mon'])."><A HREF='javascript:'>".fullmonth($_GET['mon'])."</A>";
	$calend.="<TD colspan=2 style=text-align:left;>".$CalendMon.$CalendYear."<A HREF='javascript:'>".$_GET['year']."</A>";
	$calend.="<TD width=20><B><A HREF='/report/".$next."/".$_GET['table']."'>></A></B>";
$calend.="</TABLE>";

?>
