<?php
include_once 'conf.vinoth';
mysql_query("UPDATE system SET deleted='Y' where id='".$_REQUEST['delname']."'");
mysql_close($con);

echo"<script language='javascript'>
 alert('Compliant Deleted Sucessfully  ' )
 window.location = 'delinv.php';
  </script>";
  ?>