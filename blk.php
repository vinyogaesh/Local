<?php
include_once 'conf.vinoth';
mysql_query("UPDATE user SET block='Y' where id='".$_REQUEST['blkname']."'");
mysql_close($con);

echo"<script language='javascript'>
 alert('User Blocked Sucessfully  ' )
 window.location = 'blockuser.php';
  </script>";
  ?>