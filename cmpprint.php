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
        
		$mobileno=$_GET['cno'];
		$result = mysql_query("SELECT * FROM system where cmpno='$mobileno'"); 
        $row = mysql_fetch_array($result);
		
		?>
		
<table border="0" align="center">
<tr><td>Compliant No :- </td><td><?php echo $row['cmpno']; ?></td></tr>
<tr></tr>
<tr><td>Customer Name :- </td><td><?php echo $row['custname']; ?></td></tr>
<tr></tr>
<tr><td>Customer Address :- </td><td><?php echo $row['custaddress']; ?></td></tr>
<tr></tr>
<tr><td>Customer Mobile :- </td><td><?php echo $row['custmobile']; ?></td></tr>
<tr></tr>
<tr><td>Customer E-Mail :- </td><td><?php echo $row['custmailid']; ?></td></tr>
<tr></tr>
<tr><td>Computer Type :- </td><td><?php echo $row['ctype']; ?></td></tr>
<tr></tr>
<tr><td>Computer Model :- </td><td><?php echo $row['cmodel']; ?></td></tr>
<tr></tr>
<tr><td>Configuration :- </td><td><?php echo $row['cconfiguration']; ?></td></tr>
<tr></tr>
<tr><td>Problem :- </td><td><?php echo $row['cproblem']; ?></td></tr>
<tr></tr>
<tr><td>Date of Regiter Compliant :- </td><td><?php echo $row['dtime']; ?></td></tr>
<tr></tr>
<tr><td>Status Compliant :- </td><td><?php echo $row['status']; ?></td></tr>

<tr></tr>
<?php
if($row['status']=="Ready" || $row['status']=="Deliverd")
{
	echo"<tr><td>Service Charge :-</td><td><b>".$row['servchar']."/-</b></td></tr>";
}?>
<tr></tr>
<?php
if($row['status']=="Deliverd")
{
	echo"<tr><td>Bill Status :-</td><td><b>".$row['paystat']."/-</b></td></tr>";
}?>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>

<tr></tr></table>
<br />
<br />
<br />

<table align="left">
<tr></tr>
<tr><td>Customer Sign</td> </tr>
</table>
<table align="right">
<tr><td>Authorized Signatory</td
></tr>
</table>
</div>
</div>
<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell layout-item-0" style="width: 50%" >
        </div><div class="art-layout-cell layout-item-0" style="width: 50%" >
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