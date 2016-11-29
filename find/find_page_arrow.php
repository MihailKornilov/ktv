<?php
$NumRow="<span>Показано абонентов:</span> ";
$Num=$ktv->QNumRows("select id from abonent where ".$q." limit ".(($find->page-1)*$find->strok).",".$find->strok);

$count=$ktv->QRow("select ceiling(count(id)/".$find->strok.") from abonent where ".$q);
if($count>1)
	{
	$nBegin=1;
	$nEnd=$count;

	if($find->page>5)
		{
		if($count>10)
			{
			$nBegin=$find->page-4;
			if($count>$nBegin+9)
				{
				$nEnd=$nBegin+9;
				if($count>$nEnd) $tttEnd="<A HREF='javascript:' onclick=findSpisokGet('',".($nEnd+1).");>...</A> ";
				}
			else if($count<$nBegin+9) $nBegin=$count-9;
			$tttBegin="<A HREF='javascript:' onclick=findSpisokGet('',".($nBegin-1).");>...</A> ";
			}
		}
	else
		if($count>10)
			{
			$nEnd=10;
			$tttEnd="<A HREF='javascript:' onclick=findSpisokGet('',11);>...</A> ";
			}
		
	$NumB=($find->page-1)*$find->strok+1;
	$NumRow.=$Num." из <B>".$ktv->QNumRows("select id from abonent where ".$q)."</B>, (".$NumB."-".($NumB+$Num-1).").<BR>";
	$Numbers=$tttBegin;
	for($n=$nBegin;$n<=$nEnd;$n++)
		if($n==$find->page) $Numbers.="<u>".$n."</u> ";
		else $Numbers.="<A HREF='javascript:' onclick=findSpisokGet('',".$n.")>".$n."</A> ";
	$Numbers.=$tttEnd."&nbsp;&nbsp;&nbsp;На страницу (1-<EM>".$count."</EM>): <INPUT TYPE=text id=findPage maxlength=4><BUTTON onclick=findPageSet(event); onmouseout=ErrorHide();>перейти</BUTTON>";
	}
else $NumRow.=$Num;
?>
