<!DOCTYPE html>
<html>
	<body>

		<?php
			
			session_start();
			$_SESSION["login"] =0;
			$con = mysqli_connect("localhost","root","","assignment");
			$in=0;
			
			if(mysqli_connect_errno($con))
			{
				echo "failed to connect" .mysqli_connect_error();
			}
			else
			{
				
				$username = $_POST['username'];
				$pass = $_POST['password'];
				$pass2 = $_POST['passw2'];
				$name1 = $_POST['firstname'];
				$name2 = $_POST['surname'];
				$add1 = $_POST['address1'];
				$add2 = $_POST['address2'];
				$city = $_POST['city'];
				$phone = $_POST['phone'];
				$mob = $_POST['mobile'];
				
				$i=0;
				$error=array();
				$_SESSION['err']=$i;
				if(strlen($pass)!=6)
				{
					$error[$i]="password must be of length 6 <br/>";
					$i++;
				}
				if($username==NULL)
				{
					$error[$i]="you must enter a username<br/>";
					$i++;
				}
				if($name1==NULL)
				{
					$error[$i]="you must enter a firstname<br/>";
					$i++;
				}
				if($name2==NULL)
				{
					$error[$i]="you must enter a surname<br/>";
					$i++;
				}
				if($add1==NULL || $add2==NULL)
				{
					$error[$i]="you must enter an address<br/>";
					$i++;
				}
				if($city==NULL)
				{
					$error[$i]="you must enter a city<br/>";
					$i++;
				}
				if(strlen($phone)!=10 && !(ctype_digit($phone)))
				{
					$error[$i]="you must enter a valid phone number<br/>";
					$i++;
				}
				if(strlen($mob)!=10 && !(ctype_digit($mob)))
				{
					$error[$i]="you must enter a valid mobile number<br/>";
					$i++;
				}
				if( $pass !=$pass2)
				{
					$error[$i]="passwords don't match<br/>";
					$i++;
				}
				if($i==0)
				{
					$sql="INSERT INTO users VALUES ('$username','$pass','$name1','$name2','$add1','$add2','$city','$phone','$mob')";
					
					if($con->query($sql) === TRUE){
						echo "New record created successfully";
						$_SESSION["login"]=$username;
					}else{
						echo "Error: " . $sql . "<br>" . $con->error;
						$_SESSION["name"]=1;
					}
				}
				else{
					$_SESSION['errors']=$error;
					$_SESSION['err']=$i;
				}
			}
			mysqli_close($con);
			header( 'Location: reg.php' ) ;
		?>

	</body>
</html>