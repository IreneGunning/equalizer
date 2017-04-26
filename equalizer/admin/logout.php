<?php
 include'connection.php'; 
//session_destroy();
if(isset($_SESSION['admin_email'])){
//$userid=$_SESSION['userno'];
//mysql_query("DELETE  FROM user_online WHERE  id='$userid'");
unset($_SESSION['admin_email']);
unset($_SESSION['admin_id']);
header ("location: 	../index.php");

}
else{
header ("location: ../index.php");
//if(isset($_SESSION['doc'])){
//header ("location: doc_logout.php");}
}
?>
