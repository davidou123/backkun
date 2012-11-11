<?php
 require_once("SQLconnection.php");
    $link = create_connection();

	// 抓欄位
$sql = "SHOW COLUMNS FROM product_";   //$sql = "SELECT * FROM  bulletin WHERE reference=-1"; 
$result = mysql_query($sql); // 執行SQL指令
$cloummum= mysql_num_rows($result); //欄位數
if (mysql_num_rows($result) != 0) {
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) $cloum[]=$rows[0];
  }
  mysql_free_result($result);
  
for($i=0;$i<$cloummum;$i++){
	$toplo=$toplo. "<td class=\"pad\" width=\"10%\"><B>".$cloum[$i]."</B></td>";
	}
	//抓欄位

	//列產品資料
    $link = create_connection();
// 建立SQL指令字串
$sql = "SELECT * FROM  product_";  
$result = mysql_query($sql); // 執行SQL指令
// 是否有文章
if (mysql_num_rows($result) != 0) 
{
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {
	$prolo=$prolo.  "<tr class=\"line\">";
	for($i=0;$i<$cloummum;$i++){
	$prolo=$prolo. "<td class=\"pad\">".$rows[$cloum[$i]]."</td>";
	}
	$prolo=$prolo."</tr>";
	 }
}
  mysql_free_result($result);
  	//列產品資料
?>
<html>


<head>
</head>
<body>
	<table width="100%" cellspacing="0" cellpadding="0"class="rltimg">
			<tr  bgcolor="#EEEEEE">
<?=$toplo?>
			</tr>
			

<?

?>

<?= $prolo;?>
