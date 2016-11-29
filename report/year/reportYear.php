<?php
$calend="<TABLE cellpadding=0 cellspacing=1 id=repCalendar width=120>";
$calend.="<TR><TD width=20><B><A HREF='/report/".($_GET['year']-1)."/".$_GET['table']."'><</A></B>";
	$calend.="<TD><B>".$_GET['year']."</B></A>";
	$calend.="<TD width=20><B><A HREF='/report/".($_GET['year']+1)."/".$_GET['table']."'>></A></B>";
$calend.="</TABLE>";
?>
