<?php
session_start();

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
					Register
				</div>
				<img class="img3" src="book.png" style="width:130px;height:110px">
				<br><br><br>
				
				<font size="3">
					<?php
						if(($_SESSION["login"]==-1) || $_SESSION["login"]=='0' )
						{	
							echo "<div align='left'><i>&nbsp&nbsp&nbsp&nbsp* required </i></div>";
							if(isset($_SESSION['err']) )
							{
								if($_SESSION['err']>0)
								{
									echo "<font size='3' color='red'>";
									for($i=0;$i<$_SESSION['err'];$i++)
									{
										echo $_SESSION['errors'][$i];
									}
									echo "</font>";
									$_SESSION['err']=0;
								}
							}
							
							echo "<form action='register.php' method='post'  align='center' >
								Username<br/>
								<input type='text'  placeholder='Username' name='username'>*<br/>
								Password<br/>
								<input type='password'  placeholder='Password' name='password'>*<br>
								Confirm Password<br/>
								<input type='password' placeholder='Confirm Password' name='passw2'>*<br>
								Firstname<br/>
								<input type='text'  placeholder='Username' name='firstname'>*<br/>
								Surname<br/>
								<input type='text'  placeholder='Surname' name='surname'>*<br/>
								Address Line 1<br/>
								<input type='text'  placeholder='Address' name='address1'>*<br/>
								Address Line 2<br/>
								<input type='text'  placeholder='Address' name='address2'>*<br/>
								City<br/>
								<input type='text'  placeholder='city' name='city'>*<br/>
								Phone<br/>
								<input type='text'  placeholder='Phone' name='phone'>*<br/>
								Mobile<br/>
								<input type='text'  placeholder='Mobile' name='mobile'>*<p/>
								<input type='submit' id='button' value='Register' align='center'>
							</form>";
						}
						else
						{
							echo "you are currently logged in as " .$_SESSION['login'] . " <br/>you must log out to register";
								echo"<form action='logout.php' method='post'  align='center' >
								<input type='submit' value='Logout'> ";
						}
							
					?>
				</font>
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