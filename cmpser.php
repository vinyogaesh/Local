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
 <table align="center">
<form action="cmpseradd.php" method="post">
<?php
$cmpnoo=$_POST['cmpno'];
$sql="select * from system WHERE cmpno='$cmpnoo' and updated='N'";
$ans=mysql_query($sql);
if(mysql_num_rows($ans) == 0) 
{ 
	
        echo "<h2 align='center'><font color='red'>Enter Correct Compliant No........</font></h2>"; 
		
   echo "<a href='cmpprocess.php'>Back</a>";
	//echo"Enter Correc Customer No........";
}
else
{
   while($row=mysql_fetch_array($ans))
{
	
	$ctype=$row['ctype'];
//	$name = $row['custname'];
	$cmodel=$row['cmodel'];
   $cconf=$row['cconfiguration'];
   $problem=$row['cproblem'];
   $dor=$row['dtime'];
   $status=$row['status'];
    
   ?>
<tr><td>Compliant No:-</td><td><input type="text" name="cmpno" value="<?php echo $cmpnoo ?> "  /></td></tr>
<tr><td>Computer Type:-</td><td><input type="text" name="ctype" value="<?php echo $ctype ?> " disabled="disabled"/></td></tr>
<tr><td>Computer Model:-</td><td><input type="text" name="cmodel" value="<?php echo $cmodel ?> " disabled="disabled"/></td></tr>
<tr><td>Computer Configuration:-</td><td><input type="text" name="cconf" value="<?php echo $cconf ?> " disabled="disabled"/></td></tr>
<tr><td>Computer Problem:-</td><td><input type="text" name="cproblem" value="<?php echo $problem ?> " disabled="disabled"/></td></tr>
<tr><td>Date of Compliant Register:-</td><td><input type="text" name="dtime" value="<?php echo $dor ?> "disabled="disabled" /></td></tr>
<?php } ?>

<tr><td>Status:-</td><td><select name="stat"><option value="">----Select----</option>
<option value="Ready">Ready</option>
<option value="Failure">Failure</option>
<option value="Processing">Processing</option></select>
</td></tr>
<tr><td>Notes:-</td><td><textarea name="note"></textarea></td></tr>
<tr><td>Service Charge(in INR RS):-</td><td><input type="text" name="servcharprice" /></td></tr>
<tr><td>Select Service Engineer Name:-</td><td>
<select name="servengname"><option value="<?php echo $_SESSION['uname']; ?>"><?php echo $_SESSION['uname']; ?></option></select></td></tr>
 <tr></tr>
<tr><td></td><td><input type="submit" name="upserpro" value="Update Compliant" /></td></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr></tr>
<tr><td><a href="dashboard.php">Back</a></td></tr>

</form></table>

<?php 
}
mysql_close($con)
?></div>
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