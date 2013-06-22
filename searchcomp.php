<?php
include'conf.vinoth';
include_once'checkadm.php';
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if(!isset($_SESSION['uname']))
{
	 header('Location: index.php');
}
checkadm();
/**
 * @author Vinoth
 * @copyright 2012
 */
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    
    <!-- Created by Vinoth K S -->
    <meta charset="utf-8">
    <title>Vasu Electronics || Namakkal</title>

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
    <a href="#">Vasu Electronics</a>
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
                                <h2 class="art-postheader"></h2>
                                                
                <div class="art-postcontent art-postcontent-0 clearfix">
                <div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >
    <br>
    
        <body>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<table border="0" align="center">

<tr><td>Enter Compliant No:-</td><td><input type="text" name="cmpno" autocomplete="on"  /></td><td><input type="submit" name="searchcmp" value="Search" /></td></tr>
</table>
</form>
<?php
$cmpnumber=$_POST['cmpno'];?>
<table width="592" height="80" border="2" align="center">
<tr><td><strong>Compliant No</strong></td><td><strong>Customer Name</strong></td><td><strong>Customer Mobile</strong></td><td><strong>Problem</strong></td><td><strong>Date of Register</strong></td><td><strong>Status</strong></td></tr>

<?php
$sql="select * from system WHERE cmpno='$cmpnumber'";

$ans=mysql_query($sql);
   while($row=mysql_fetch_array($ans))
{
	
	$no=$row['custno'];
	$name = $row['custname'];
	$mobile=$row['custmobile'];
   $cmpno=$row['cmpno'];
   $problem=$row['cproblem'];
   $dor=$row['dtime'];
   $status=$row['status'];
   
   
   
   ?>
<tr><td><?php echo $cmpno;?></td><td><?php echo $name; ?></td><td><?php echo $mobile; ?></td><td><?php echo $problem; ?></td><td><?php echo $dor; ?></td><td><?php if($status=="Ready" || $status=="Deliverd")
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
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
</table>
<p align="center"><a href="dashboard.php">Back</a></p>
    </div>
    </div>
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
<p>Copyright © 2013. Vasu Electronics</p>
</footer>
    </div>
    <p class="art-page-footer">
        <span id="art-footnote-links">Powered By <a href="http://www.vinsystem.in/" target="_blank">ViN SYSTEM</a>.</span>
    </p>
</div>
</body>
</html>