<?
header("Content-type: text/html; charset=utf-8");
echo $_POST['menuname']."<BR>";
//print_r( $_POST['delproduct']);
$i=0;
while($_POST['delproduct'][$i])
{echo $i.$_POST['delproduct'][$i]."已被刪除<BR>";
$i++;}
?>