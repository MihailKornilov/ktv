<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();
include_once('../include/class_MysqlDB.php');
include_once('../include/functions_date.php');

$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);
$kassir=$ktv->QueryObjectOne("select * from admin where id=".$_SESSION['ks']);
if($kassir->rule_report_view==0) $rule=" and admin_add=".$_SESSION['ks']; else $rule='';

if($_GET['mon']) $_SESSION['mn']=$_GET['mon'];
else if(!$_SESSION['mn']) $_SESSION['mn']=strftime("%Y-%m",time());



$day=$ktv->QueryPtPArray("select distinct(date_format(dtime_add,'%Y-%m-%d')),1 from oplata where status=1 and dtime_add like '".$_SESSION['mn']."%'".$rule);
$abon=$ktv->QueryRowArray("select distinct(date_format(dtime_add,'%Y-%m-%d')) from abonentka where dtime_add like '".$_SESSION['mn']."%'".$rule);
if(count($abon)>0) foreach($abon as $ab) if(!$day[$ab[0]]) $day+=array($ab[0] => '1');
$zayav=$ktv->QueryRowArray("select distinct(date_zayav) from abonent where date_zayav like '".$_SESSION['mn']."%'".$rule);
if(count($zayav)>0) foreach($zayav as $z) if(!$day[$z[0]]) $day+=array($z[0] => '1');
$podkl=$ktv->QueryRowArray("select distinct(date_podkl) from abonent where date_podkl like '".$_SESSION['mn']."%'".$rule);
if(count($podkl)>0) foreach($podkl as $p) if(!$day[$p[0]]) $day+=array($p[0] => '1');

$mon=explode('-',$_SESSION['mn']);

if($mon[1]-1==0) $back=($mon[0]-1)."-12";
else { $d=$mon[1]-1; $back=$mon[0]."-".($d<10?'0'.$d:$d); }
if($mon[1]+1==13) $next=($mon[0]+1)."-01";
else { $d=$mon[1]+1; $next=$mon[0]."-".($d<10?'0'.$d:$d); }


$CalendMon="<H6><DL id=CalendMon>";
for($n=1;$n<=12;$n++) $CalendMon.="<D".($n==$mon[1]?'T':'D')."><A HREF='javascript:' onclick=repMonNext('".$mon[0]."-".($n<10?'0':'')."".$n."');>".fullmonth($n)."</A>";
$CalendMon.="</DL></H6>";

$CalendYear="<H6><DL id=CalendYear>";
for($n=$mon[0]-5;$n<=strftime("%Y",time())+1;$n++) $CalendYear.="<D".($n==$mon[0]?'T':'D')."><A HREF='javascript:' onclick=repMonNext('".$n."-".$mon[1]."');>".$n."</A>";
$CalendYear.="</DL></H6>";


$calend="<TABLE cellpadding=0 cellspacing=1 id=repCalendar>";
$calend.="<TR><TD><B><A HREF='javascript:' onclick=repMonNext('".$back."');><</A></B>";

	$calend.="<TD colspan=3 style=text-align:right;padding-right:5px;><INPUT TYPE=hidden value=".abs($mon[1])."><A HREF='javascript:'>".fullmonth($mon[1])."</A>";

	$calend.="<TD colspan=2 style=text-align:left;>".$CalendMon.$CalendYear."<A HREF='javascript:'>".$mon[0]."</A>";
	$calend.="<TD><B><A HREF='javascript:' onclick=repMonNext('".$next."');>></A></B>";

$calend.="<TR><TH>пн<TH>вт<TH>ср<TH>чт<TH>пт<TH>сб<TH>вс";
$calend.="<TR>";
$totime=strtotime($_SESSION['mn']."-01");
$d7=1;
$d31=date("t",$totime);
$n=1;
$ned=date("w",$totime);
if($ned==0) $ned=7;
$today=strftime('%Y-%m-%d',time());
while($n<=$d31)
	{
	if($ned>1)	{ $calend.="<TD>&nbsp;";	$ned--;	}
	else
		{
		$d=$_SESSION['mn']."-".($n<10?'0':'').$n;
		if($d==$kassir->otchet_day) $sel="sel"; else $sel='';
		$calend.="<TD".($d==$today?' style=background:#FF8':'').">";
		if($day[$d]) $calend.="<U><A HREF='javascript:' class=dayB".$sel." onclick=ReportGet('".$d."',this);>".$n."</A></U>";
		else $calend.="<P class=dayB".$sel.">".$n;
		if($d7==7 and $n!=$d31) { $d7=0; $calend.="<TR>";}
		$n++;
		}
	$d7++;
	}
$calend.="</TABLE>";

echo $calend;
?>
