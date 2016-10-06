
		<?php
			
			session_start();

				
			$_SESSION['login'] =0;
			$con = mysqli_connect("localhost","root","","assignment");
			$in=0;
			
			if(mysqli_connect_errno($con))
			{
				echo "failed to connect" .mysqli_connect_error();
			}
			else
			{
				if(isset($_POST['username']))
				{
					$username = $_POST['username'];
					$pass = $_POST['password'];
					
					$sql ="select * from users where username ='$username' AND password= '$pass'";
					
					$result = $con->query($sql);
					
					if($result)
					{
						if($result->num_rows>0)	
						{
							$_SESSION['login'] =$username;
							echo 'yeysy yeasd' ;
							if($_SESSION['login'] == $username)
							{
								echo 'login successful';
							}
							$_SESSION['fail']=0;
						}
						else{
								$_SESSION['fail']=-1;
							}
						
					}
				}
			
					echo $_SESSION['login'];
				
				
				
			}
			mysqli_close($con);
			header( 'Location: loginP.php' ) ;
			
			
		?>