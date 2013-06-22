<?php
include'conf.vinoth';
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page

if (!isset($_SESSION['uname'])) {
        header('Location: index.php');
}
?>
<?php

include_once'conf.vinoth';

$in=$_GET['txt'];
$msg="";
if(strlen($in)>0 and strlen($in) <20 ){
$t=mysql_query("select custno, custname from custdetail where custname like '$in%'");
while($nt=mysql_fetch_array($t)){
$msg.=$nt[custname]."->$nt[custno]<br>";
}
}
echo $msg;

?>