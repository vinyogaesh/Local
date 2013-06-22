<?php

/**
 * @author Vinoth
 * @copyright 2013
 */
 include'conf.vinoth';
include_once'checkadm.php';
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if(!isset($_SESSION['uname']))
{
	 header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    
    <!-- Created by Vinoth K S -->
    <meta charset="utf-8">
    <title>VASU ELECTRONICS || Namakkal</title>

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <link rel="stylesheet" href="style.css" media="screen">
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" media="screen" /><![endif]-->


    <script src="jquery.js"></script>
    <script src="script.js"></script>
    
<style>.art-content .art-postcontent-0 .layout-item-0 { padding-right: 10px;padding-left: 10px;  }
.ie7 .post .layout-cell {border:none !important; padding:0 !important; }
.ie6 .post .layout-cell {border:none !important; padding:0 !important; }

</style>
    
    
</head>
<body>
    
<div id="art-main">
    <div class="art-sheet clearfix">
<header class="art-header clearfix">
<div class="art-slidecontainerheader">
    <div class="art-slider-inner" style="">
<div class="art-slide-item art-slideheader0" style="">

</div>
<div class="art-slide-item art-slideheader1" style="">

</div>
<div class="art-slide-item art-slideheader2" style="">

</div>
<div class="art-slide-item art-slideheader3" style="">

</div>

    </div>
</div>
    <div class="art-shapes">
<h1 class="art-headline" data-left="1.41%">
    <a href="#">VASU ELECTRONICS</a>
</h1>
         </div>
           
                 
</header>
<nav class="art-nav clearfix">
    <ul class="art-hmenu"><li><a href="index.php"class="active">Home</a></li><li><a href="rcomp.php" >Register Compliant</a></li><li><a href="searchcomp.php" >Search Compliant</a></li><li><a href="cmpstatus.php">Status</a><li><a href="contact.php">Contact</a></li></ul> 
    </nav>
<div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content clearfix"><article class="art-post art-article">
                        <h3 align="left">Welcome Mr.<?php echo $_SESSION['uname']; ?></h3>
                                
                                                
                <div class="art-postcontent art-postcontent-0 clearfix">
                <div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >
    <h2 class="art-postheader"></h2>
  <table border="1" align="center">
<?php

 $aut=$_SESSION['utype'];
//echo $aut; 
 if ($aut=='10')
{?>
<tr><td><?php echo "<a href='accm.php'>Staff Management </a>"; ?></td>
<td><?php echo "<a href='custm.php'>Customer Management </a>"; ?></td>
<td><?php echo "<a href='invmgt.php'>Compliant Management </a>"; }?></td>
<td><?php echo "<a href='rcomp.php'>Register Compliant </a>"; ?></td>
<td><?php echo "<a href='crecust.php'>Create New Custmoer</a>";  ?></td>
<td><a href="searchcomp.php">Search compliant</a></td><td><a href="cmpprocess.php">Compliant Process</a></td><td><a href="comppay.php">Pay Cash</a></td><td><a href="feedview.php"></a></td><td><a href="logout.php">Logout</a></td></tr></table>
<br /><br /><BR />
<h2 align="center">Customers Feed Backs</h2>
<table width="773" height="77" border="2" align="center">
<tr><td width="112"><strong>Customer Name</strong></td><td width="129"><strong>Customer Mail</strong></td><td width="123"><strong>Message</strong></td><td width="87"><strong>To Department</strong></td><td width="103"><strong>Date of Register</strong></td><td width="60"><strong>Status</strong></td></tr>

<?php
if($_SESSION['utype']=='10')
{
$dept="Admin";
}
else if($_SESSION['utype']=='2')
{
$dept="Employee";
}
else if($_SESSION['utype']=='5')
{
$dept="Billing";
}
else
{
$dept="ALL";
}
$sql="select * from feed WHERE todepartment='$dept' or todepartment='ALL' and deleted='N'";

$ans=mysql_query($sql);
   while($row=mysql_fetch_array($ans))
{
	
	$name = $row['custname'];
	$mail=$row['custmail'];
   $custmessage=$row['custmessage'];
   $todept=$row['todepartment'];
   $dor=$row['dtime'];
   $status=$row['status'];
      ?>
<tr><td><?php echo $name; ?></td><td><?php echo $mail; ?></td><td><?php echo $custmessage; ?></td><td><?php echo $todept; ?></td><td><?php echo $dor; ?></td><td><?php if($status=="Accepted" || $status=="Finished")
{
echo"<font color='#009933'>". $status. "</font>";
}
else
{
	echo"<font color='#FF0000'>". $status. "</font>";
}

 ?></td></tr>

<?php }
mysql_close($con)
?>
</table>  </div>
</div>
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 50%" >
        </div><div class="art-layout-cell layout-item-0" style="width: 50%" >
        <br>
        <br>
        <br>
        
    </div>
    </div>
</div>
</div>
</article></div>
                    </div>
                </div>
            </div><footer class="art-footer clearfix">
<p><br></p>
<p>Copyright &copy; 2013. ViN SYSTEM'S</p>
</footer>
    </div>
    <p class="art-page-footer">
        <span id="art-footnote-links">Powered By <a href="http://www.vinsystem.in/" target="_blank">ViN SYSTEM</a>.</span>
    </p>
</div>
</body>
</html>
