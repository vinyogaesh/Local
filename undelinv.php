<?php
include_once 'conf.vinoth';
mysql_query("UPDATE system SET deleted='N' where id='".$_REQUEST['undelname']."'");
mysql_close($con);

echo"<script language='javascript'>
 alert('Compliant Retrived Sucessfully  ' )
 window.location = 'deletedinv.php';
  </script>";
  ?>