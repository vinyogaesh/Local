<?php
include_once 'conf.vinoth';
mysql_query("UPDATE user SET deleted='N' where id='".$_REQUEST['undelname']."'");
mysql_close($con);

echo"<script language='javascript'>
 alert('User Retrived Sucessfully  ' )
 window.location = 'deleteduser.php';
  </script>";
  ?>