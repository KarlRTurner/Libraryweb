<?php
session_start();
if(!isset($_SESSION['login']))
{
	$_SESSION['login']=0;
	$_SESSION["fail"]=0;
}


?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylish.css">
	</head>
	
	<title>
		The Library
	</title>
	
	<body>
		<div id="head" align="center">
			The Library
			
		</div>
		<div id="subhead" align="center">
			Books

		</div>
		<p>
		<div id="nav" align="center">
			<a href="loginP.php">Login</a>
			<a href="reg.php">Register</a>
			<a href="ReserveWeb.php">Search </a>
			<a href="mybooks.php">myBooks</a>
		</div>
		
		
		<div id="com">
			<div id="block" align="center">
				<div id="text1">
					Login
				</div>
				<img class="img3" src="book.png" style="width:130px;height:110px">
				<br><br><br>
				
				
					<font size="3">
					<?php
						if(isset($_SESSION["login"]))
						{
							if($_SESSION["fail"]==-1)
							{
								echo "<font size='3' color='red'>";
								echo "Username or password is incorrect";
								echo "</font>";
								//session_destroy();
							}
							if(($_SESSION["login"]==-1) || $_SESSION["login"]=='0' )
							{
								
								echo "<form action='login.php' method='post'  align='center' >
								Username<br/>
								<input type='text' size='21' placeholder='Username' name='username'><br/>
								Password<br/>
								<input type='password' size='21' placeholder='Password' name='password'><p>
								<input type='submit' id='button' value='Log In'>
								</form>
								</font>";
							}
							else
							{
								echo "Welcome " .$_SESSION['login'];
								echo"<form action='logout.php' method='post'  align='center' >
								<input type='submit' value='Logout'> ";
							}
						}
					?>
					<hr/>
				
			
				<br/>
				<br/>
				<a href="http://www.twitter.com"><img src="twitter.png"style="width:50px;height:42px;border:0"></a>
				<a href="http://www.facebook.com"><img src="facebook.png"style="width:50px;height:50px;border:0"></a>
			
			
			</div>
		</div>
		<footer>
			<div id="address" align="right">
				69 Seacrest<br>
				Wicklow Town,<br>
				Wicklow,<br>
				Ireland<br>
				Tel. 109 409
			</div>
			<div id="media" align="center">
				<a href="http://www.twitter.com"><img src="OC0b7CM.png"style="width:50px;height:42px;border:0"></a>
				<a href="http://www.facebook.com"><img src="xb2hkQs.png"style="width:50px;height:50px;border:0"></a>
			</div>
		</footer>
		
	</body>
</html>