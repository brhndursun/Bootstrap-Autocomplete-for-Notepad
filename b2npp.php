<?php
	$str = file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.css');
	$str=substr($str,strpos($str,'LICENSE'));
	$tmp_str='';
	$stopAdding=false;
	for($i=0;$i<strlen($str);$i++)
	{
		if($str[$i]=="{")
			$stopAdding=true;
		if($str[$i]=="}")
		{
			$stopAdding=false;
			continue;
		}
		if(!$stopAdding)
		{
			$tmp_str.=$str[$i];
		}
	}
	$str=$tmp_str;
	$num=-1;
	for($i=0;$i<strlen($str);$i++)
	{
		$started=false;
		if($str[$i]!="." && $str[$i]!="#" && !$started)
			continue;
		$started=true;
		$tmp_str='';
		while($str[$i+1]!="," && $str[$i+1]!="{" && $str[$i+1]!="}" && $str[$i+1]!=":" && $str[$i+1]!=" "){
			$i++;
			$tmp_str.=$str[$i];
		}
		if(strpos($tmp_str,'['))
			$tmp_str=substr($tmp_str,0,strpos($tmp_str,'['));
		$tmp_str=str_replace('.',"\"/&gt;<br>&lt;KeyWord name=\"",$tmp_str);
		$tmp_str=str_replace(')','',$tmp_str);
		$all_str[$num]=$tmp_str;
		$num++;
		$started=false;
	}
	$all_str=array_unique($all_str);
	foreach($all_str as $a)
	{
		if($a!="")
			echo "&lt;KeyWord name=\"".$a."\" /&gt;<br>";
	}
		
?>
