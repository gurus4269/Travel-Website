<?php
    session_start();
    $goods_id=$_GET["delete_no"];
    
    $link = mysqli_connect("localhost", "root", "root123456", "group_05") // 建立MySQL的資料庫連結
	or die("無法開啟MySQL資料庫連結!<br>");
						
	// 送出編碼的MySQL指令
	mysqli_query($link, 'SET CHARACTER SET utf8');
	mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

	$sql = "delete from goods where goods_id ='$goods_id' ";
    // echo $sql ;
    $result = mysqli_query($link, $sql)	;
    header('Location: input.php');
	
?>