<?php
 include'connection.php'; 
//session_destroy();
if(isset($_SESSION['user_email'])){
//$userid=$_SESSION['userno'];
//mysql_query("DELETE  FROM user_online WHERE  id='$userid'");
unset($_SESSION['user_email']);
unset($_SESSION['userid']);
unset($_SESSION['name']);

header ("location: 	index.php");

}
else{
header ("location: index.php");
//if(isset($_SESSION['doc'])){
//header ("location: doc_logout.php");}
}
?>
