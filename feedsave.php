<?php

/**
 * @author Vinoth
 * @copyright 2013
 */
 include_once('conf.vinoth');
 $custname=$_POST['custname'];
 $custmail=$_POST['custmail'];
 $message=$_POST['message'];
 $to=$_POST['to'];

$sql = "INSERT INTO feed (custname,custmail, custmessage, todepartment, dtime, status, deleted) VALUES ( '$custname','$custmail','$message','$to',NOW(),'Created','N')";

$retval = mysql_query( $sql, $con );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "<script language='javascript'>alert('Thanks For your Valuable Feedback.');
</script>";
echo("<script type='text/javascript'>
                    window.setTimeout(function() {
                        location.href = 'feedbac.php';
                    }, 1000);
        </script>");


?>