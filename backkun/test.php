<?php
$menuname="power"; //$_GET['menuname'];

require_once("SQLconnection.php");
require_once("function.php");

if(!$menuname){$toplo="�Х����ܤ@�����";}else{
 $chname= chtranslate($menuname);  	//��줤�^�ഫ
	// �����---------------------------------------------------------------------------------
    $link = create_connection();
	$sql = "SHOW COLUMNS FROM $menuname";   //$sql = "SELECT * FROM  bulletin WHERE reference=-1"; 
	$result = mysql_query($sql); // ����SQL���O
	$cloummum= mysql_num_rows($result); //����
if (mysql_num_rows($result) != 0) {
  while ($rows = mysql_fetch_array($result, MYSQL_BOTH)) $cloum[]=$rows[0];
  }
  mysql_free_result($result);
  
for($i=0;$i<$cloummum;$i++){
if($cloum[$i]!="memo")	$toplo=$toplo. "<td class=\"pad\" width=\"10%\"><B>".$chname[$cloum[$i]]."</B></td>";
	}
	// �����	------------------------------------------------------------------------------------------------


	//�C���~���
	$sql = "SELECT * FROM  $menuname";  
	$result = mysql_query($sql); // ����SQL���O
if (mysql_num_rows($result) != 0) 
{
  while ($rows[] = mysql_fetch_array($result, MYSQL_BOTH)) {

	 }
}
  mysql_free_result($result);
  	//�C���~���
	}
	print_r($rows);
?>