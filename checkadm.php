<?php


function chkadm()
{
	if($_SESSION['utype']=='2')
{
	 header('Location: dashboard.php');
}
elseif($_SESSION['utype']=='5')
{
	 header('Location: dashboard.php');
}
	
}
function checkadm()
{
	if($_SESSION['utype']=='2')
{
	 header('Location: dashboard.php');
}
elseif($_SESSION['utype']=='5')
{
	 header('Location: dashboard.php');
}
}
?>