<?php
header("Content-type: text/html; charset=utf-8");
$menuname=$_GET['menuname'];
class runtime   //測試跑的時間多久
{ 
    var $StartTime = 0; 
    var $StopTime = 0; 
    function get_microtime() 
    { 
        list($usec, $sec) = explode(' ', microtime()); 
        return ((float)$usec + (float)$sec); 
    } 
    function start() 
    { 
        $this->StartTime = $this->get_microtime(); 
    } 
    function stop() 
    { 
        $this->StopTime = $this->get_microtime(); 
    } 
    function spent() 
    { 
        return round(($this->StopTime - $this->StartTime) * 1000, 1); 
    } 
}
//例子 
$runtime= new runtime;
$runtime->start();
require_once("SQLconnection.php");
require_once("function.php");

if(!$menuname){$menuname=listfirst();}//如果沒選欄位，隨機跑一個選項
 $chname= chtranslate($menuname);  	//欄位中英轉換
// 顯示欄位------------------------------------------------------------------------------------------------
  $cloum=catchrow($menuname);
  $cloummum= count($cloum);//欄位數
  
for($i=0;$i<$cloummum;$i++){
if($cloum[$i]!="memo")	$toplo=$toplo. "<td class=\"pad\" width=\"10%\"><B>".$chname[$cloum[$i]]."</B></td>";
	}
// 抓欄位	------------------------------------------------------------------------------------------------


	//列產品資料
	$sql = "SELECT * FROM  $menuname";  
	$result = mysql_query($sql); // 執行SQL指令
if (mysql_num_rows($result) != 0) 
{
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {
	$prolo=$prolo.  "<tr class='line'  onmouseOver=\"this.className='style4'\" onmouseout=\"this.className='style3'\">";
	for($i=0;$i<$cloummum;$i++){
	
	if($cloum[$i]=="memo"){ }
	else if(eregi("(.*).jpg",$rows[$cloum[$i]])||eregi("(.*).bmp",$rows[$cloum[$i]])) {
	 	$prolo=$prolo. "<td class=\"pad\"><img src=\"productpic/".$rows[$cloum[$i]]."\" width='105' height='80'></td>";
		}
	else if($cloum[$i]=="name"){$prolo=$prolo. "<td class=\"pad\"><a href=\"product.php?menuname=".$menuname."&productname=".$rows[$cloum[$i]]."\">".$rows[$cloum[$i]]."</a></td>";}
	else{$prolo=$prolo. "<td class=\"pad\">".$rows[$cloum[$i]]."</td>";}
	}
	$prolo=$prolo."</tr>";
	 }
}
  mysql_free_result($result);
  	//列產品資料
	
?>
<link rel="shortcut icon" href="img/ico.ico" />
<link rel="icon" href="img/ico.ico" type="image/x-icon" />
<html>

<head>
<meta http-equiv="Content-Language" content="zh-tw">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>廣力查詢系統</title>
<link rel="stylesheet" href="css/index.css" type="text/css" />	
<style type="text/css">

li {
list-style-type: none;line-height: 1.5;
}
.input{color:#6C6C6C;height:30;font-size:14pt;}

</style>

</head>

<body>
<div id='topDock'>

	<a class="right" href="http://www.kunlex.com.tw" target="_blank" style="font-size: 9pt;"><B>廣力電腦</b></a>
	<a class="right"  href="index.php" style="font-size: 9pt;"><B>查詢首頁|| </b></a>
</div>

<div align="center">
<BR><BR>
<form method="POST" action="">

	<img border="0" src="img/search.jpg" width="214" height="70"style="vertical-align: middle">
	<input type="text" class="input" size="50" value="搜尋產品"onfocus="if(this.value=='搜尋產品')this.value=''" onblur="if(this.value=='')this.value='搜尋產品'"><input type="submit" value="搜尋" name="B1">
</form>
<BR><BR>
<table border="0" width="1000" cellspacing="0" cellpadding="0">
	<tr><td  valign="top">
<!--左邊選單-->
	<div class="related" style="background-image: url('img/macbg.png')">
	<h3 align="center">左邊選單</h3>
	<ul class="rltimg">

		這邊可以放資料<BR><BR>
		<?$menu=leftmenu($menuname);	echo$menu[menu] ?>
	<script src="js/gathermenu.js" type="text/javascript"></script>
	<SCRIPT LANGUAGE="javascript">
	for (i=1; i<10; i++) {
	var j="<?=$menu[num]?>"
	if(j==""){j=1}
		if(i==j){}else{
		ID = document.getElementById(i);
		ID.style.display = "none";}
	}
</SCRIPT>						
	</ul>
	</div>
<!--左邊選單-->
</td>
<td valign="top">
<!--右邊選單-->
<div class="related" style="width:760px;">
	<h3 align="center"> 產品資訊</h3>
		<span class="location" ><img border="0" src="img/location.jpg" width="25" height="25"style="vertical-align: middle">目前位置：首頁><?=location($menuname)?></span><BR><BR>
	<table width="100%" cellspacing="0" cellpadding="0"class="rltimg">
		<tr  bgcolor="#EEEEEE"><?=$toplo?></tr>
		<?= $prolo;?>	
		</table>
<BR>
</div>
<!--右邊選單-->
</td></tr>
</table>
<?
$runtime->stop();
echo "<BR><B><p align='center'>頁面執行時間: ".$runtime->spent()." 毫秒</p></b>";?>
<?php include 'footer.htm'; ?>
</div>




</body>

</html>