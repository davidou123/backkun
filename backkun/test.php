<?php
$menuname="power"; //$_GET['menuname'];

require_once("SQLconnection.php");
require_once("function.php");

if(!$menuname){$toplo="請左邊選擇一個欄位";}else{
 $chname= chtranslate($menuname);  	//欄位中英轉換
	// 抓欄位---------------------------------------------------------------------------------
    $link = create_connection();
	$sql = "SHOW COLUMNS FROM $menuname";   //$sql = "SELECT * FROM  bulletin WHERE reference=-1"; 
	$result = mysql_query($sql); // 執行SQL指令
	$cloummum= mysql_num_rows($result); //欄位數
if (mysql_num_rows($result) != 0) {
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) $cloum[]=$rows[0];
  }
  mysql_free_result($result);
  
for($i=0;$i<$cloummum;$i++){
if($cloum[$i]!="memo")	$toplo=$toplo. "<td class=\"pad\" width=\"10%\"><B>".$chname[$cloum[$i]]."</B></td>";
	}
	// 抓欄位	------------------------------------------------------------------------------------------------


	//列產品資料
	$sql = "SELECT * FROM  $menuname";  
	$result = mysql_query($sql); // 執行SQL指令
if (mysql_num_rows($result) != 0) 
{
  while ($rows[] = mysql_fetch_array($result, MYSQL_BOTH)) {

	 }
}
  mysql_free_result($result);
  	//列產品資料
	}
	print_r($rows);
?>