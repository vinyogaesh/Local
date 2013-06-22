<?php
    session_start();
    include("conf.vinoth");
	//include_once("securecheck.php");

	
	$user=mysql_real_escape_string($_POST['uname']);
	$pass=mysql_real_escape_string(md5(md5(md5($_POST['pwd']))));//three times get hash

$logi=$_POST['log'];

if($logi=='admLogin')
{
	$ut='10';
//echo $ut;
}
else if($logi=='empLogin')
{
	$ut='2';
//echo $ut;
}
else if($logi=='blngLogin')
{
	$ut='5';
}
else
{
//	echo "Select Any One................";
}
if(!$logi)
{
	echo "Please Select Any One...............";?>
    
    <a href="index.php"></a>
    <?php
	
}
else
	{
		//Check if the user has already tried to login
    //If they have, set the variable $auth_tries to the value of the cookie and get the expire time
    if (isset($_COOKIE['time_limit'])) {
        $num_tries = $_COOKIE['auth_attempts'];
        $expire_time = $_COOKIE['time_limit'];
    } else { //If they haven't, create the cookie with a value of 1, since this is their first attempt
        setcookie('auth_attempts', 1,  time()+1200); //Cookie named 'auth_attempts' with a stored value of '1' that expires in 1200 seconds from now (20 minutes)
        setcookie('time_limit', time()+1200, time()+1200);  //Cookie named 'time_limit' that stores the expiration time of the first login attempt
        $num_tries = $_COOKIE['auth_attempts'];  //Value of 1
        $expire_time = $_COOKIE['time_limit']; //Timestamp of 20 minutes from now
    }
    
    //Check if the user has exceeded 5 login attempts in 20 minutes
    //If true, log the current timestamp in the DB and let the user know they are temporarily locked out
    if ($num_tries > 5) {
        $lockout_time = time() + 36000;  //Timestamp of 10 hour from now
        mysql_query("UPDATE user SET LOCKED = '$lockout_time' WHERE uname='$user'");
        die(print("You have failed to log in 5 times in 20 minutes!  You must wait an 10 hourS before attempting to log in again."));
    }
        
    if (isset($_POST['sub'])) {
        $user=mysql_real_escape_string($_POST['uname']);
$pass=mysql_real_escape_string(md5(md5(md5($_POST['pwd']))));
        $checklock = mysql_query("SELECT LOCKED FROM user");//check All User LOCKED Status if u need to check Purticular user then u can change (WHERE uname='$user') now Purticular user can change
		$checklock_result = mysql_result($checklock, 0);  //Returns the timestamp
		if ($checklock_result > time()) {  //If the time restriction is not over
            die(print("You must wait an 10 hour to attempt to log in again!")); 
        } else {
        $sql        = "SELECT * FROM user WHERE uname='$user' and pass='$pass' and utype='$ut' and deleted='N' and block='N'";
        $result     = mysql_query($sql);
		
        $count      = mysql_num_rows($result);
        if ($count == 1) {
            $_SESSION['login'] = "1";
			$_SESSION['uname']=$user;
			$_SESSION['utype']=$ut;
            //Force the cookies to expire, since they have logged in successfully
            setcookie('auth_attempts', '', time()-36000);
            setcookie('time_limit', '', time()-36000);
				
            header("Location:dashboard.php");
        }
		else
		{
		    
                    $num_tries++; //Increment $auth_tries to reflect the failed login attempt
                    setcookie('auth_attempts', $num_tries, $expire_time); //Update your 'auth_attempts' cookie
					//$_SESSION['error'] = "Incorrect username or password";
            header("location:index.php");
            echo("Usernam and Password is Wrong or User Blocked by Administrator");
                }
		}
        
    }
	}
?>