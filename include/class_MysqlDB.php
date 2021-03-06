<?php
// name	: ����� Mysql
// version	: 1.6 (4.12.2009)
// author	: Mikhail V Kornilov (mihan_k@mail.ru)

class MysqlDB
	{
	var $host;
	var $user;
	var $pass;
	var $database;
	var $names;

	var $conn;

	function MysqlDB($alt_host='localhost',$alt_user='',$alt_pass='',$alt_database='',$alt_names='latin1')
		{
		$this->host = $alt_host;
		$this->user = $alt_user;
		$this->pass = $alt_pass;
		$this->database = $alt_database;
		$this->names = $alt_names;
		$this->conn=mysql_connect($this->host,$this->user,$this->pass,1);
		mysql_select_db ($this->database,$this->conn);
		mysql_query("set NAMES `".$this->names."`",$this->conn);
		}

	function Query($sql)
		{
		mysql_query($sql,$this->conn) or die($sql);
		}

	function QRow($sql)
		{
		$result=mysql_query($sql,$this->conn) or die($sql);
		$rez=mysql_fetch_row($result);
		return $rez[0];
		}

	function QueryRowOne($sql)
		{
		$result=mysql_query($sql,$this->conn) or die($sql);
		return mysql_fetch_row($result);
		}

	function QueryRowArray($sql)
		{
		$result=mysql_query($sql,$this->conn) or die($sql);
		$n=0;
		while($temp=mysql_fetch_row($result))
			{
			$rez[$n]=$temp;
			$n++;
			}
		return $rez;
		}

	function QueryPtPArray($sql)
		{
		$arr=array();
		$result=mysql_query($sql,$this->conn) or die($sql);
		$n=0;
		while($temp=mysql_fetch_row($result))
			{
			$arr+=array($temp[0] => $temp[1]);
			$n++;
			}
		return $arr;
		}

	function QueryObjectOne($sql)
		{
		$result=mysql_query($sql,$this->conn) or die($sql);
		return mysql_fetch_object($result);
		}
	
	function QueryObjectArray($sql)
		{
		$result=mysql_query($sql,$this->conn) or die($sql);
		$n=0;
		while($temp=mysql_fetch_object($result))
			{
			$rez[$n]=$temp;
			$n++;
			}
		return $rez;
		}
	
	function QNumRows($sql)
		{
		$result=mysql_query($sql,$this->conn) or die($sql);
		return mysql_num_rows($result);
		}
	}
?>