<?
$menuname=$_GET['menuname'];
require_once("SQLconnection.php");
require_once("function.php");

$msg="";

function slectmenu(){
	$link = create_connection();//
	$sql = "select bigmenu from menu group by bigmenu";  
	$result = mysql_query($sql); // 執行SQL指令
	if (mysql_num_rows($result) != 0) 
	{
		$bignum=mysql_num_rows($result);
		while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) {$slectmenu.="<option  value='". $rows["bigmenu"]."'>". $rows["bigmenu"]."</option> "; }
	}
	mysql_free_result($result);
	return $slectmenu;
}

if(isset($_POST["slectbigmenu"]) &&isset($_POST["name"])){//新增資料----------------------

$link = create_connection();
$sql="INSERT INTO `menu` (`bigmenu`,`name`,`menulink`)VALUES ('".$_POST['slectbigmenu']."',  '".$_POST['name']."',  '".$_POST['menulink']."')";

 if(mysql_query($sql)){$msg.= "ok";} else $msg.="寫入錯誤錯誤!，可能資料庫已經有該筆同名資料<br>";
 
if($_POST["newtable"]=="newtable"){
	$creatsql.="CREATE TABLE  `".$_POST["menulink"]."` (";
	$creatsql.=" `pic` VARCHAR( 100 )   NOT NULL COMMENT  '產品圖片' ,";
	$creatsql.=" `name` VARCHAR( 30 )   NOT NULL COMMENT  '名稱' ,";

for($i=0;$i<$_POST["rownum"];$i++)
	{$creatsql.=" `".$_POST["en$i"]."` VARCHAR( 100 )  NOT NULL COMMENT  '".$_POST["ch$i"]."' ,";}
	
	$creatsql.=" `memo` TEXT   NOT NULL COMMENT  '備註'";
	$creatsql.=") ENGINE = MYISAM ;";
mysql_query($creatsql);
	$creatsql2="ALTER TABLE  `qwer` ADD UNIQUE (`name`)";
mysql_query($creatsql2);

}
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


li {list-style-type: none;line-height: 1.5;}

.input{color:#6C6C6C;height:30;font-size:14pt;}
.fixed{float:left; width:150px; text-align:right;margin-left: 100px;letter-spacing: 1pt;}


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
.tips {
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	color: black;
	border: 1px solid #0C0;
	padding: 8px;
	margin: 15px 10px;
}
</style>
<!-- TinyMCE -->
<script type="text/javascript" src="js/tinymcec/jscripts/tiny_mce.js"></script>
<script type="text/javascript" src="js/tinymcec/tinymac.js"></script>
<!-- /TinyMCE -->
<!-- 選單註解 -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="tooltip.js"></script> 
<link rel="stylesheet" href="css/admin.css" type="text/css" />
<!-- 選單註解 -->
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
<BR>

<?php include 'adminmenu.htm'; ?><BR>
<table border="0" width="1000" cellspacing="0" cellpadding="0">
	<tr><td  valign="top">
<!--左邊選單-->
	<div class="related">
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
<span class="location" ><img border="0" src="img/location.jpg" width="25" height="25"style="vertical-align: middle">目前位置：後端管理 > <B>新增管理選單</b></span><BR>
<?=$msg?>
<form method="post" action ="">
<div class="tips"><B>新增分類</b><br>
<span style="margin-left:33;">來為你的左邊選單，新增一個大的樹狀選單分類。也就是有 <img border='0' src='img/folder_2.gif' width='13' height='16'>  這個小圖的分類。</span></div>
<BR>
<div style="margin-left: 100px;background-color:#D9ECFF;padding: 10px;width:540;">
		請輸入新分類： <input type="text" name="slectbigmenu" size="20" style=" background: transparent url(img/folder_2.jpg)no-repeat;    border: #fff solid 2px;padding-left: 20px;background-color:#fff;">
<INPUT TYPE="hidden" NAME="name" VALUE="#">
<INPUT TYPE="hidden" NAME="menulink" VALUE="#">
		<input type="submit" value="新增子選單" name="Bd"style="margin-left: 70px;" ></div>
		<BR>
</form>
<form method="post"  action ="">
<div class="tips">
<b>新增子選單</b><BR>
<span style="margin-left:33;">選擇一個分類來新增裡面的子選單，選單所有欄位均需中英文對照。</span></div>
<BR>
		<table border="0" width="781" cellpadding="0" cellspacing="0" style="margin-left: 10px;">
		<tr  style="margin: 0px;">
			<td class="pad2"  bgcolor="#D9ECFF">請選擇分類&nbsp; <br>
</td>
			<td rowspan="2">
			<img border="0" src="img/arrow.jpg" width="56" height="49"></td>
			<td bgcolor="#C1E0FF"class="pad2">選單名稱</td>
			<td bgcolor="#C1E0FF"class="pad2"><input type="text" name="name" size="15"></td>
			<td rowspan="2">
			<img border="0" src="img/arrow.jpg" width="56" height="49"></td>
			<td bgcolor="#C1E0FF"class="pad2" rowspan="2" align="left">欄位中文名稱&nbsp;&nbsp;英文名稱<br>
			&nbsp;1.<input type="text" name="puc" size="15"disabled="disabled" value="圖"> <input type="text" name="puc0" size="10"disabled="disabled" value="pic">&nbsp;<br>
			&nbsp;2.<input type="text" name="puc" size="15"disabled="disabled" value="名稱"> <input type="text" name="puc0" size="10"disabled="disabled" value="name">&nbsp;<br>
			&nbsp;3.<input type="text" name="puc" size="15"disabled="disabled" value="備註"> <input type="text" name="puc0" size="10"disabled="disabled" value="memo">&nbsp;<br>

			<div id=slect></div><BR></td>
		</tr>
		<tr>
			<td class="pad2"  bgcolor="#D9ECFF">
			<select size="1" name="slectbigmenu" style="font-weight: bold;font-size:12pt;margin-left:15px;width:120px;height:30px;">
			<option>請選擇分類</option>
			<?=slectmenu();?>
			</select>　</td>
			<td bgcolor="#C1E0FF"class="pad2">英文名稱<BR>欄 位 數<BR></td>
			<td bgcolor="#C1E0FF"class="pad2"style="text-align: left;"><input type="text" name="menulink" size="15"><br>
			<select size="1" name="menu" class="slelect" style="width:100px;height:25px;">
					<option value="0">請選擇</option>			
					<option value="1">1欄</option>
					<option value="2">2欄</option>
					<option value="3">3欄</option>
					<option value="4">4欄</option>
					<option value="5">5欄</option>
					<option value="6">6欄</option>
			</select>
	</td>
		</tr>
	</table>
		<BR>
	<INPUT TYPE="hidden" NAME="newtable" VALUE="newtable">
		<input type="submit" value="新增子選單" name="B1" style="margin-left: 570px;">
</form>
<BR>
</div>
<!--右邊選單-->
</td></tr>
</table>
<?php include 'footer.htm'; ?>
</div>



<script language="JavaScript">
$('.slelect').change(function(){
var num=Number($(this).val())
var str="";
for( i=0;i<num;i++){
str=str+'&nbsp;'+(i+3)+'.<input type="text" name="ch'+i+'" size="15"> <input type="text" name="en'+i+'" size="10"><br>'
}
str=str+'<input type="hidden" name="rownum" value="'+i+'" size="15">';
document.getElementById("slect").innerHTML=str;
});
</script>
</body>

</html>