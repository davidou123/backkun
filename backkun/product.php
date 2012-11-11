<?php
$menuname=$_GET['menuname'];
$productname=$_GET['productname'];
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
if ($productname != true)
   header("Location:index.php?menuname=$menuname");
   
 require_once("SQLconnection.php");
require_once("function.php");  
if(!$menuname){$toplo="請左邊選擇一個欄位";}else{
 $chname= chtranslate($menuname);  	//欄位中英轉換
	// 抓欄位---------------------------------------------------------------------------------
  $cloum=catchrow($menuname);
  $cloummum= count($cloum);//欄位數
  
	// 抓欄位	------------------------------------------------------------------------------------------------
	//列產品資料
	$sql = "SELECT * FROM  $menuname where name= '$productname'";  
	$result = mysql_query($sql); // 執行SQL指令
if (mysql_num_rows($result) != 0) 
{
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {
	$propic=$rows[pic];
	if(!$rows[memo]) $rows[memo]="<BR><BR>尚無商品介紹。";
	$memo=$rows[memo];
	$name=$rows[name];
	$prolo="<table border='0' cellspacing='0' cellpadding='0' style=\"padding-left:10px; \">";
	for($i=0;$i<$cloummum;$i++){

	if($cloum[$i]!="memo"&&$cloum[$i]!="pic"){$prolo=$prolo."<tr class=word><td><B>".$chname[$cloum[$i]].": </b> </td><td style=\"padding-left:10px; \"> ".$rows[$cloum[$i]]."</td>";}
	}
$prolo.="<tr><td colspan='2'><img border='0' src='img/buy.png' width='331' height='35'></td></tr></table>";
	 }
}
  mysql_free_result($result);
  	//列產品資料
	}
	
function randslect($menuname){	//隨機挑選
	$sql = "SELECT name,pic FROM $menuname ORDER BY RAND() LIMIT 3";  
	$result = mysql_query($sql); // 執行SQL指令
if (mysql_num_rows($result) != 0) {
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {
	$randrow[pic][]=$rows[pic];
	$randrow[name][]=$rows[name];
	 }
}
return $randrow;
  mysql_free_result($result);	
  }
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
li 		{
		list-style-type: none;line-height: 1.5;}
.input	{color:#6C6C6C;height:30;font-size:14pt;}
.imgbord{ padding: 4px; border: 2px solid #ddd; background: #fff; margin: 5px;}
.fixed	{float:left; width:80px; text-align:right;margin-left: 0px;letter-spacing: 1pt;}
.word	{font-size:11pt;line-height:25px;color:#505050}
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
	<div class="related"  style="background-image: url('img/macbg.png')">
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
	<div class="related"align="center" >
	<h3 align="center">隨機挑選</h3>
	或許可以參考這些產品
	<?
	$randrow=randslect($menuname);
	$i=0;
	while($randrow[name][$i]!=""){
		echo "<img border=\"0\" src=\"img/line.gif\" width=\"180\" height=\"29\"><BR><a href=\"?menuname=$menuname&productname=".$randrow[name][$i]."\"><img border=\"0\" src=\"productpic/".$randrow[pic][$i]."\" width=\"120\" height=\"120\"><BR><font  color=\"#005599\">".$randrow[name][$i]."</font></a><BR>";
		$i++;}
	?>

	<BR>
	</div>
<!--左邊選單-->
</td>
<td valign="top">
<!--右邊選單-->
<div class="related" style="width:760px;">
	<h3 align="center"> 產品資訊</h3>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="300"><div class="imgbord " style=" width: 300px; height:300px;">
		<img border="0" src="productpic/<?= $propic;?>" width="300" height="300"></div></td>
		<td  valign="top">
		<div align="center" style="margin-left:20px;height:50px;width:400px;background-image : url(http://buy.yahoo.com.tw/res/layout/v5/bg_trace.gif?v1);background-repeat : repeat-x;background-position : bottom;"><b><font size="6"><?= $name;?></font></b></div><BR><BR>
		<BR><span><?= $prolo;?></span>	</td>
	</tr>
	<tr>
		<td colspan="2"><HR><?= $memo;?></td>
	</tr>
</table>


<BR>
</div>
<!--右邊選單-->
</td></tr>
</table>

</div>
<?
$runtime->stop();
echo "<BR><B><p align='center'>頁面執行時間: ".$runtime->spent()." 毫秒</p></b>";?>
<?php include 'footer.htm'; ?>



</body>

</html>