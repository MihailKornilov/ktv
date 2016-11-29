<?php
header("Content-type: text/html; charset=windows-1251");
header("Cache-Control: no-store, no-cache,  must-revalidate"); 
header("Expires: ".date("r"));
include_once('../include/conf.php');
session_name($session);
session_start();

if($_SESSION['ks'])
	{
	include_once('../include/class_MysqlDB.php');
	include_once('../include/functions_date.php');
	$ktv = new MysqlDB($mysql['ktv_host'],$mysql['ktv_user'],$mysql['ktv_pass'],$mysql['ktv_database'],$mysql['ktv_names']);

	if($_GET['content']) $ktv->Query("insert into idea (content,admin_add) values ('".iconv("UTF-8", "WINDOWS-1251",$_GET['content'])."',".$_SESSION['ks'].")");
	if($_GET['otvet'])
		{
		$ktv->Query("insert into idea (content,admin_add,otvet) values ('".iconv("UTF-8", "WINDOWS-1251",$_GET['otvet'])."',".$_SESSION['ks'].",".$_GET['id'].")");
		$ktv->Query("update idea set otvet_count=otvet_count+1 where id=".$_GET['id']);
		}
	if($_GET['gotovo'])
		{
		$status=$ktv->QRow("select status from idea where id=".$_GET['id']);
		$ktv->Query("update idea set status=".($status==1?0:1)." where id=".$_GET['id']);
		}

	$idea=$ktv->QueryObjectArray("select * from idea where otvet=0 order by id desc");
	if(count($idea)>0)
		{
		$admin=$ktv->QueryPtPArray("select id,fio from admin order by id");
		foreach($idea as $i)
			{
			$ideaSpisok.="<DIV ".($i->status==1?"class=ideaGotovo":'')." id=idea".$i->id.">";
				$ideaSpisok.="<H2>".($i->status==1?"<EM>Выполнено</EM>":'').$admin[$i->admin_add]."<SPAN>".Data($i->dtime_add)."</SPAN></H2>";
				$ideaSpisok.="<H3>".$i->content."</H3>";
				if($i->otvet_count>0)
					{
					$otvet=$ktv->QueryObjectArray("select * from idea where otvet=".$i->id." order by id");
					$ideaSpisok.="<DL>";
					foreach($otvet as $o)
						{
						$ideaSpisok.="<DT><U>Добавлено:</U><SPAN>".Data($o->dtime_add)."</SPAN>, ".$admin[$o->admin_add];
						$ideaSpisok.="<DD>".$o->content;
						}
					$ideaSpisok.="</DL>";
					}
				$ideaSpisok.="<H5>".($_SESSION['ks']==1?"<A HREF='javascript:' onclick=ideaGotovo(".$i->id.");>готово</A> :: ":'')."<A HREF='javascript:' onclick=ideaOtvetView(".$i->id.");>ответить или уточнить</A></H5>";
				$ideaSpisok.="<H6><INPUT TYPE=text><A HREF='javascript:' onclick=ideaOtvetSend(".$i->id.",event);>отправить</A></H6>";
			$ideaSpisok.="</DIV>";
			}
		}
	echo $ideaSpisok;
	}

?>