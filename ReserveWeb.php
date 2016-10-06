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
					Reserve books
				</div>
				<img class="img3" src="book.png" style="width:130px;height:110px">
				<br><br><br>
				<?php
					$con = mysqli_connect("localhost","root","","assignment");
					
					if(mysqli_connect_errno($con))
					{
						echo "failed to connect" .mysqli_connect_error();
					}
					else
					{
						$catsql ="select * from category" ;
						
						$catresult = $con->query($catsql);
						if(!(isset($_SESSION['selection'])))
						{
							$_SESSION['selection']=NULL;
							$_SESSION['search']=NULL;
							$_SESSION['cat']=NULL;
						}
						
						echo "<form method='get' align='center' >";
						echo "Search by author/title<br/>";
						echo"<input type='text' size='21' placeholder='search' name='search'><br/>";
						echo"<input type='radio' value='author' name='selection'><i> Author
							<input checked type='radio' value='title' name='selection'> Title <input type='radio' value='both' name='selection' > Both</i>";
							
						
						
						echo "<br/>or Category <br/> <select name ='cat'> <option value='0'> </option>";
						while($row = mysqli_fetch_array($catresult))
						{
							$cat=$row['Category'];
							echo "<option value='$cat'>" . $row['CategoryDesc'] . "</option>";
						}
						echo "</select> <p> <input type='submit'id='button' value='Search'> <form> <hr>";
						if(!(isset($_GET['search'])))
						{
							$_GET['search']=$_SESSION['search'];
							$_GET['selection']=$_SESSION['selection'];
							$_GET['cat']=$_SESSION['cat'];
						}
						
						if($_GET['search']!=NULL || $_GET['cat']!=NULL)
						{
							$_SESSION['search']=$_GET['search'];
							if(isset($_GET["page"]))
							{
								$page=$_GET["page"];
							}
							else
							{
								$page=1;
							}
							
							
							$_SESSION['cat']= $catse = $_GET['cat'];
							$_SESSION['search']=$search = $_GET['search'];
							$_SESSION['selection']=$_GET['selection'];
							$sql="select * from books where Reserved ='w'";
							if($search!=NULL)
							{
								if($_GET['selection']==='both')
								{
									$sql ="select * from books where ((BookTitle like '%$search%') OR (Author like '%$search%')) AND (Reserved ='n')";
								}else if($_GET['selection']==='title')
								{
									$sql ="select * from books where (BookTitle like '%$search%') AND (Reserved ='n')";
								}
								else if($_GET['selection']==='author')
								{
									$sql ="select * from books where  (Author like '%$search%') AND (Reserved ='n')";
								}
							}
							else if($catse!='0')
							{
								$sql ="select * from books where (Category='$catse' ) AND (Reserved='n')";
							}
							
							if(isset($sql))
							{
								reserve($sql,$con,$page);
							}
							else{
								echo"Search for books and reserve books heehem";
							}
						}
						else{
							echo"Search for books and reserve books";
						}
					}
					
					
						mysqli_close($con);
					
					
					function reserve($sql, $con, $page){
						
						$res =0;
						
						for($i=0;$i<=5;$i++)
						{	
							if(isset($_GET[$i]))
							{
								$user =$_SESSION["login"];
								$book = $_GET[$i];
									
								$sqlinsert="INSERT INTO reservation VALUES ('$book', '$user',CURRENT_TIMESTAMP)";
								if($con->query($sqlinsert) === TRUE){
									
								}else{
									echo "Error: " . $sqlinsert . "<br>" . $con->error;
								}
									
								$sqlupdate="UPDATE books SET Reserved='y' WHERE  ISBN = '$book';";
									
								if($con->query($sqlupdate) === TRUE){
									echo "Book Sucessfully reserved <br/>";
									$res =1;
								}
								else{
									echo "Error: " . $sqlupdate . "<br>" . $con->error;
								}
							}
						}
						/*if(isset($_GET["reserve"]))
						{
							echo "hewef";
							$book = $_GET['reserve'];
							$user =	$_SESSION["login"];
								
							$sqlinsert="INSERT INTO reservation VALUES ('$book', '$user,CURRENT_TIMESTAMP)";
							if($con->query($sqlinsert) === TRUE){
								
							}else{
								echo "Error: " . $sqlinsert . "<br>" . $con->error;
							}
								
							$sqlupdate="UPDATE books SET Reserved='y' WHERE  ISBN = '$book';";
								
							if($con->query($sqlupdate) === TRUE){
								echo "Book Sucessfully reserved <br/>";
								$res =1;
							}
							else{
								echo "Error: " . $sqlupdate . "<br>" . $con->error;
							}
						}*/
						
						$result = $con->query($sql);
						
						if($result->num_rows>0 && $res===0)	
						{
							$rows = $result->num_rows;
						
							$numrec=5;
							
							$totpage=ceil($rows/$numrec);
							
							
							$self=$_SERVER['PHP_SELF'];
							if($page != 1)
							{
								echo "<a href ='ReserveWeb.php?page=1'>First</a> ";
								$prev = $page-1;
								echo " <a href ='ReserveWeb.php?page=$prev'>Prev</a>";
							}
							echo " ". $page . " of ". $totpage . " ";
							if($page!=$totpage)
							{
								$next = $page+1;
								echo "<a href ='$self?page=$next'>Next</a> ";
								echo " <a href ='ReserveWeb.php?page=$totpage'>Last</a>";
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
							echo" </table> <input type='submit' id='button' value='Reserve'> </form>";
							
						}
						else
						{
							if($res==0)
							{
								echo"No books matched your search, Sorry";
							}
						}
						
					}
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