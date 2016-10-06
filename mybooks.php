<?php
	session_start();
	if(!$_SESSION["login"])
	{
		header( 'Location: loginP.php' ) ;
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
					My Reserved books
				</div>
				<img class="img3" src="book.png" style="width:130px;height:110px">
				<br><br>
				<hr>
					<?php
					
					$con = mysqli_connect("localhost","root","","assignment");
					
					if(mysqli_connect_errno($con))
					{
						echo "failed to connect" .mysqli_connect_error();
					}
					else
					{
						
							$user =$_SESSION["login"];
							
							$sql ="select books.ISBN, books.BookTitle , Books.Author, Books.edition, Books.Year from books INNER join reservation on books.ISBN = reservation.ISBN where (Username = '$user')" ;
							
							$i=0;
							for($i=0;$i<=5;$i++)
							{	
								if(isset( $_POST[$i]))
									{
										$book = $_POST[$i];
										
										$sqlinsert="DELETE FROM reservation WHERE ISBN = '$book'";
										
										
										if($con->query($sqlinsert) === TRUE){
											
										}else{
											echo "Error: " . $sql . "<br>" . $con->error;
										}
										
										$sqlupdate="UPDATE books SET Reserved='n' WHERE  ISBN = '$book';";
										
										if($con->query($sqlupdate) === TRUE){
											
										}else{
											echo "Error: " . $sql . "<br>" . $con->error;
										}
									}
							}
							if(isset( $_POST['unres']))
							{
								$book = $_POST['unres'];
								$i++;
								$sqlinsert="DELETE FROM reservation WHERE ISBN = '$book'";
								
								if($con->query($sqlinsert) === TRUE){
									echo "New record created successfully";
								}else{
									echo "Error: " . $sql . "<br>" . $con->error;
								}
								
								$sqlupdate="UPDATE books SET Reserved='n' WHERE  ISBN = '$book';";
								
								if($con->query($sqlupdate) === TRUE){
									echo "New record created successfully";
								}else{
									echo "Error: " . $sql . "<br>" . $con->error;
								}
							}
								
							$result = $con->query($sql);
							if($result->num_rows>0)	
							{
								
								
								echo "<i>select a book that you want to unreserve</i> <hr>";
								$rows = $result->num_rows;
						
							$numrec=5;
							
							$totpage=ceil($rows/$numrec);
								if(isset($_GET["page"]))
								{
									$page=$_GET["page"];
								}
								else
								{
									$page=1;
								}
								
								$self=$_SERVER['PHP_SELF'];
								if($page != 1)
								{
									echo "<a href ='$self?page=1'>First</a> ";
									$prev = $page-1;
									echo " <a href ='$self?page=$prev'>Prev</a>";
								}
								echo " ". $page . " of ". $totpage . " ";
								if($page!=$totpage)
								{
									$next = $page+1;
									echo "<a href ='$self?page=$next'>Next</a> ";
									echo " <a href ='$self?page=$totpage'>Last</a>";
								}
								
								$offset = ($page-1) * $numrec;
								$sql .= "limit $offset, $numrec";
								$result = $con->query($sql);
								echo "<form  method='post'   align='center' > <table  align='center' > ";
								echo "<tr align='left'> <th> Title </th> <th> Author</th></tr>";
								
								$c=0;
								while($row = mysqli_fetch_array($result))
								{
									$ISBN=$row['ISBN'];
									
									echo "<tr align='left'> <td> " .$row['BookTitle']. "</td>  <td>" .$row['Author'].  "</td> <td> <input type='checkbox' value='$ISBN' name='$c'> </td> </tr>"  ;
									$c++;
								}
								echo" </table> <input type='submit' id='button'value='Unreserve'> </form>";
								
							}
							else{
								echo $user ." has no books reserved";
							}	
					}
					
					mysqli_close($con);
					
					
				?>
			
				<hr>
			
				<br>
				<br>
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