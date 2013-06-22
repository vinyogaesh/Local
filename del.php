<?php
include_once 'conf.vinoth';
mysql_query("UPDATE user SET deleted='Y' where id='".$_REQUEST['delname']."'");
mysql_close($con);

echo"<script language='javascript'>
 alert('User Deleted Sucessfully  ' )
 window.location = 'deluser.php';
  </script>";
  ?>