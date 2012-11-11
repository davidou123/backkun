

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Full featured example</title>
<style>
body {font-family:Arial,Verdana; font-size: 12px;}
</style>

<!-- TinyMCE -->
<script type="text/javascript" src="jscripts/tiny_mce.js"></script>
<script type="text/javascript" src="tinymac.js"></script>
<!-- /TinyMCE -->

</head>
<body>

<form method="post" action="translate.php">
<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%">
11「這對農業和生計都形成莫大壓力。」她補充說，「氣候變遷讓降雨更難以預測。」

　　來自130國約2500位專家出席在斯德哥爾摩舉行的第20屆世界水資源週大會，納瑞恩是受邀專家之一。大會5日登場，預計11日閉幕。

　　巴基斯坦暴雨引發全國性洪災後，現在仍有800萬人仰賴救濟
	</textarea>
<input type="submit" value="送出" name="submit">
</form>
<script type="text/javascript">
if (document.location.protocol == 'file:') {
	alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
}
</script>
<?
$eee="<span style=\"background-color: #ffff00;\">123</span>";
   $showcontent = $_POST['elm1']; 
      $showcontent = str_replace('\"',"\"",$showcontent);  //把\"取代成" 
	  /*這邊''內的\"是要被取代掉的 要被取代成" 阿因為又會造成程式判斷錯誤 所以要多一個\來跳脫讓系統知道是"*/
   echo $showcontent;
   echo"<HR>";
   $eee = str_replace("\"","'",$eee);
   echo $eee;
   echo "結束";
   ?>
</body>
</html>
