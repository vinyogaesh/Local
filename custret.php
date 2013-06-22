<?php
include_once 'conf.vinoth';
//$del=$_POST['delname'];
mysql_query("UPDATE custdetail SET deleted='N' where custno='".$_REQUEST['retname']."'");
mysql_close($con);
echo"<script language='javascript'>
  alert('Customer Retrived Sucessfully ....' )
 window.location = 'retcust.php';
  </script>";
  ?>