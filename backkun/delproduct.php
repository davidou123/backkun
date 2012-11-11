<?
require_once("SQLconnection.php");
$menuname=$_GET['menuname'];
$productname=$_GET['productname'];

    $link = create_connection();
	$sql = "DELETE FROM $menuname WHERE name ='$productname'";  
	$result = mysql_query($sql); // 執行SQL指令

?>

<html>
<script>
alert('<?=$productname;?> 刪除完成');
</script>
<meta http-equiv="refresh" content="0; url=Management.php?menuname=<?=$menuname?>" />

</html>