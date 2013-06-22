<?php
include_once 'conf.vinoth';
//$del=$_POST['delname'];
mysql_query("UPDATE custdetail SET deleted='Y' where custno='".$_REQUEST['delname']."'");
mysql_close($con);
echo"<script language='javascript'>
  alert('Customer Deleted Sucessfully  ' )
 window.location = 'delcust.php';
  </script>";
  ?>