<?php
$servername="localhost";
$uname="root";
$pword="";
$dbase="equalizer_db";

$con = new mysqli($servername,$uname,$pword,$dbase);
/*
if(!$con)
{
die "connection failed".mysqli_error;
}
*/
if(!isset($_SESSION)){
   session_start();
}
?>