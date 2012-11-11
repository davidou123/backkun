<?
$menuname=$_GET['menuname'];
$productname=$_GET['productname'];
require_once("SQLconnection.php");
require_once("function.php");

$msg="";
function updatedata($menuname,$productname){
    $link = create_connection();
	$sql = "SELECT * FROM  $menuname where name='$productname'";  
	$result = mysql_query($sql); // 執行SQL指令
if (mysql_num_rows($result) != 0) 
{
  while ($rows[] = mysql_fetch_array($result, MYSQL_BOTH)) {
	 }
}
return $rows;
  mysql_free_result($result);
  }
  $rowsdata=updatedata($menuname,$productname);
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
  $toplo.="<dd><span class=fixed>&nbsp; </span><img border=\"0\" src=\"productpic/".$rowsdata[0][pic]."\" width=\"117\" height=\"100\"style=\"vertical-align: middle\"><BR></dd>";
for($i=0;$i<$cloummum;$i++){
	
	if($cloum[$i]=="pic")
	{	$toplo.="<dd><span class=fixed><B>".$chname[$cloum[$i]]."：</B></span><input type = \"file\" name=\"pic\" size=\"30\" ><input type=\"hidden\" name=\"oldpic\" size=\"20\" value='".$rowsdata[0][$cloum[$i]]."'>"."<br></dd>";
	}
	else if($cloum[$i]=="memo")
	{	$toplo.="<dd><span class=fixed><B>".$chname[$cloum[$i]]."：</B></span><BR><BR><textarea  name=\"".$cloum[$i]."\" cols=\"74\" rows=\"37\">$cloum[$i]</textarea>"."<br></dd>";
	}else{
	$toplo.="<dd><span class=fixed><B>".$chname[$cloum[$i]]."：</B></span> <input type=\"text\" name=\"".$cloum[$i]."\" size=\"20\" value='".$rowsdata[0][$cloum[$i]]."'>"."<br></dd>";}
	}
	$toplo.="<span class=fixed>&nbsp; </span><input type=\"submit\" value=\"送出\" name=\"B1\">";

}	// 抓欄位	------------------------------------------------------------------------------------------------

if($_POST["name"]!=""){//新增資料----------------------
	if ($_FILES[pic][size]!=0) {
		$filename=iconv("UTF-8", "big5",$_FILES[pic][name]);
		if(file_exists("productpic/$filename")) {$rand=rand(0,100000);$filename=$rand.$filename;$_FILES[pic][name]=$rand.$_FILES[pic][name];}
		if(copy($pic,"productpic/$filename"))
			{
			$_POST[oldpic]=iconv("UTF-8", "big5",$_POST[oldpic]);
			$delpic="productpic/".$_POST[oldpic];
			unlink($delpic);
			$sql="UPDATE  `$menuname` set pic='".$_FILES[pic][name]."'";
		}else{
				$msg.= "<font face='arial' size='2'> $name 檔案上傳失敗 ,也可能是檔案太大 請使用 back 按鍵再試一次<BR>";
				$sql="UPDATE  `$menuname` set pic='".$_POST[oldpic]."'";
		}

 	}
	else{$sql="UPDATE  `$menuname` set pic='".$_POST[oldpic]."'";}

 for($i=1;$i<$cloummum;$i++){
  $sql.=",".$cloum[$i]."='".$_POST[$cloum[$i]]."' ";
 }//新增資料----------------------
 $sql.="WHERE name='$productname'";
 if(mysql_query($sql)){$reurl=true;
 } else $msg.="寫入錯誤錯誤!，可能資料庫已經有該筆同名資料<br>";
 }
?>


<link rel="shortcut icon" href="img/ico.ico" />
<link rel="icon" href="img/ico.ico" type="image/x-icon" />
<html>

<head>
<?if($reurl){
echo "<meta http-equiv=\"refresh\" content=\"0; url=product.php?menuname=$menuname&productname=$productname\" />";
}?>
<meta http-equiv="Content-Language" content="zh-tw">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>廣力查詢系統</title>

<link rel="stylesheet" href="css/index.css" type="text/css" />	
<!-- 選單註解 -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="tooltip.js"></script> 
<link rel="stylesheet" href="admin.css" type="text/css" />
<!-- 選單註解 -->
<style type="text/css">

li {list-style-type: none;line-height: 1.5;}

.input{color:#6C6C6C;height:30;font-size:14pt;}
.fixed{float:left; width:150px; text-align:right;margin-left: 100px;letter-spacing: 1pt;}

input {
    color: #333;}
input:hover
    {
    background-color: #FFFFCC;
    color: inherit;
    border: 1px solid #E9CB38;}
input:focus {
    background-color: #F4FAFF;
    color: #333;
    border: #139EE8 solid 1px;
    outline: 1px solid #139EE8;
    border-outline: 5px;
}
dd {
	width:500px;
	padding: 0 0 1em 0em;
}
</style>
<!-- TinyMCE -->
<script type="text/javascript" src="js/tinymcec/jscripts/tiny_mce.js"></script>
<script type="text/javascript" src="js/tinymcec/tinymac.js"></script>
<!-- /TinyMCE -->

</head>

<body>
<div id='topDock'>
	<a class="right" href="http://www.kunlex.com.tw" target="_blank" style="font-size: 9pt;"><B>廣力電腦</b></a>
		<a class="right" style="font-size: 9pt;"><B>查詢首頁|| </b></a>
</div>

<div align="center">
<BR><BR>
<form method="POST" action="">

	<img border="0" src="img/search.jpg" width="214" height="70"style="vertical-align: middle">
	<input type="text" class="input" size="50" value="搜尋產品"onfocus="if(this.value=='搜尋產品')this.value=''" onblur="if(this.value=='')this.value='搜尋產品'"><input type="submit" value="搜尋" name="B1">
</form>
<BR>
<?php include 'adminmenu.htm'; ?><BR>
<table border="0" width="1000" cellspacing="0" cellpadding="0">
	<tr><td  valign="top">
<!--左邊選單-->
	<div class="related"  style="background-image: url('img/macbg.png')">
	<h3 align="center">左邊選單</h3>
	<ul class="rltimg">

		請選擇一個分類來新增<BR><BR>
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
<div class="related" style="width:780px;">
	<h3 align="center"> 產品資訊</h3>

<form method="post" enctype="multipart/form-data" action ="">

		<?=$toplo?>
		<BR><?=$msg?>
</form>

<BR>
</div>
<!--右邊選單-->
</td></tr>
</table>
<?php include 'footer.htm'; ?>
</div>




</body>

</html>