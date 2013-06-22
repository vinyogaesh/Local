<?php
include_once 'conf.vinoth';
mysql_query("UPDATE user SET block='N' where id='".$_REQUEST['unblkname']."'");
mysql_close($con);

echo"<script language='javascript'>
 alert('User Activetd Sucessfully  ' )
 window.location = 'blockeduser.php';
  </script>";
  ?>