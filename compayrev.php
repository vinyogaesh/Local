<?php
include'conf.vinoth';
// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page

if (!isset($_SESSION['uname'])) {
        header('Location: index.php');
}

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
                                
                                                
                <div class="art-postcontent art-postcontent-0 clearfix">
                <div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 100%" >
 <?php include_once('conf.vinoth');
        
		$mobileno=$_POST['cmpno'];
		$result = mysql_query("SELECT * FROM system WHERE cmpno='$mobileno' and deleted='N'"); 
        $row = mysql_fetch_array($result);
				?>
		
<table border="0" align="center">
<form action="paycash.php" method="post">
<tr><td>Compliant No :- </td><td><input type="text" name="cmpno" value="<?php echo $row['cmpno']; ?>" /></td></tr>
<tr></tr>
<tr><td>Customer Name :- </td><td><input type="text" name="custname" value="<?php echo $row['custname']; ?>" disabled="disabled" /></td></tr>
<tr></tr>
<tr><td>Customer Address :- </td><td><input type="text" name="custaddress" value="<?php echo $row['custaddress']; ?>" disabled="disabled"/></td></tr>
<tr></tr>
<tr><td>Customer Mobile :- </td><td><input type="text" name="custmobile" value="<?php echo $row['custmobile']; ?>" disabled="disabled"/></td></tr>
<tr></tr>
<tr><td>Customer E-Mail :- </td><td><input type="text" name="custmailid" value="<?php echo $row['custmailid']; ?>"disabled="disabled"/></td></tr>
<tr></tr>
<tr><td>Computer Type :- </td><td><input type="text" name="ctype" value="<?php echo $row['ctype']; ?>"disabled="disabled" /></td></tr>
<tr></tr>
<tr><td>Computer Model :- </td><td><input type="text" name="cmodel" value="<?php echo $row['cmodel']; ?>"disabled="disabled" /></td></tr>
<tr></tr>
<tr><td>Configuration :- </td><td><input type="text" name="cconf" value="<?php echo $row['cconfiguration']; ?>" disabled="disabled"/></td></tr>
<tr></tr>
<tr><td>Problem :- </td><td><input type="text" name="cproblem" value="<?php echo $row['cproblem']; ?>" disabled="disabled"/></td></tr>
<tr></tr>
<tr><td>Date of Regiter Compliant :- </td><td><input type="text" name="cdtime" value="<?php echo $row['dtime']; ?>" disabled="disabled"/></td></tr>
<tr></tr>
<tr><td>Status Compliant :- </td><td><input type="text" name="cdtime" value="<?php echo $row['status']; ?>" disabled="disabled" /></td></tr>

<tr></tr>
<?php
if($row['status']=="Ready")
{
	echo"<tr><td>Service Charge (in INR RS):-</td><td><input type='text' name='servcharge' value='".$row['servchar']."' disabled='disabled' >/-</td></tr>";
}
else if($row['status']=="Failure")
{
	echo"<tr><td>Service Charge (in INR RS):-</td><td><input type='text' name='servcharge' value='No Need To Pay....' disabled='disabled' >/-</td></tr>";
}

?>
<tr></tr>
<?php
//if($row['status']=="Deliverd")
//{
	//echo"<tr><td>Bill Status :-</td><td><b>".$row['paystat']."/-</b></td></tr>";
//}?>

<tr></tr>
<?php
if($row['status']=="Deliverd")
{
	echo"<tr><td>Enter Amount To Pay:-</td><td><input type='text' name='servchar' value='Already Paid...' disabled='disabled'/></td></tr>";
}
else if($row['status']=="Failure")
{
	echo"<tr><td>Enter Amount To Pay:-</td><td><input type='text' name='servchar' value='No Need To Pay.....' disabled='disabled'/></td></tr>";

}

else
{
	echo"<tr><td>Enter Amount To Pay:-</td><td><input type='text' name='servchar' /></td></tr>";
echo"	<tr></tr>";
echo"<tr><td></td><td><input type='submit' name='pay' value='Pay Cash' /></td></tr>";

}?>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr><td><a href="comppay.php">Back</a></td></tr></form></table>
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