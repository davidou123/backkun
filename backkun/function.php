<?
function chtranslate($menuname)	//欄位中英轉換
{
    $link = create_connection();
	$sql = "SHOW FULL FIELDS FROM $menuname";  
	$result = mysql_query($sql); // 執行SQL指令
	if (mysql_num_rows($result) != 0) {
		while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {
		$chname[$rows['0']]=$rows["Comment"]; //$chname[pic] $chname[name]...
	 }
	}
	mysql_free_result($result);
	return $chname;
}
function location($menuname)  //現在位置
{
    $link = create_connection();
	$sql = "select * from menu where menulink='$menuname'";  
	$result = mysql_query($sql); // 執行SQL指令
	if (mysql_num_rows($result) != 0) {
	while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {
	$location=$rows[bigmenu]."><B>".$rows[name]."</b>";
	 }
	}
	mysql_free_result($result);
	return $location;
}
function leftmenu($menuname){  //左邊選單
	
	$link = create_connection();
	$sql = "select bigmenu from menu group by bigmenu";  
	$result = mysql_query($sql); // 執行SQL指令
	if (mysql_num_rows($result) != 0) 
	{
		$bignum=mysql_num_rows($result);
		while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {$menu[]=  $rows["bigmenu"]; }
	}
	mysql_free_result($result);

	for($i=0;$i<$bignum;$i++)
	{
	$check=$i+1;
	$showmenu[menu].= "<DIV ><li><img border='0' src='img/folder_2.gif' width='13' height='16'> <font class='bigmenu' onkeypress=change($check) onclick=change($check)>".$menu[$i]."<BR></font></li></DIV>";

	$showmenu[menu].="<div id=$check >";
	$sql2 = "select * from menu where bigmenu='$menu[$i]'";  
	$result2 = mysql_query($sql2); // 執行SQL指令
	if (mysql_num_rows($result2) != 0) 
	{
		while ($row = mysql_fetch_array($result2, MYSQL_BOTH)) {
		if($row["name"]!="#")
		$showmenu[menu].="<a style=\"padding-left: 16px;\" href='?menuname=".$row["menulink"]."' >".$row["name"]."</a><BR>";
	if($row["menulink"]==$menuname) $showmenu[num]=$check;}
	}
	$showmenu[menu].="</div>";
	}

	return $showmenu;
}
function catchrow($menuname){
	// 抓欄位---------------------------------------------------------------------------------
    $link = create_connection();
	$sql = "SHOW COLUMNS FROM $menuname"; 
	$result = mysql_query($sql); // 執行SQL指令
	$cloummum= mysql_num_rows($result); //欄位數
	if (mysql_num_rows($result) != 0) {
		while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) $cloum[]=$rows[0];
	}
	mysql_free_result($result);
	return $cloum;
  }
function listfirst(){
	$link = create_connection();
	$sql = "select menulink from menu where menulink<> '#' limit 1";  
	$result = mysql_query($sql); // 執行SQL指令
	if (mysql_num_rows($result) != 0) 
	{
		$rows = mysql_fetch_array($result, MYSQL_BOTH);
		return $rows[0];
	}
	mysql_free_result($result);

}


?>