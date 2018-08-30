<link rel="stylesheet" href="../css/style.css">
<br/><br/><center>

<?php

$conn = mysqli_connect("localhost:3306","root","","finaldb") or die ("could not connect database");

// require_once("db.php");
$username = $_POST['username'];
$username = filter_var($username, FILTER_SANITIZE_STRING);
$password = $_POST['password'];
$password = filter_var($password, FILTER_SANITIZE_STRING);
$login=mysqli_num_rows(mysqli_query($conn, "SELECT * from `auth` where `username`='$username' and `password`='$password'"));
if($login!=0)
{
	echo "<h1>Welcome Back, ".$username.".<h1> <h2>Login was successful!</h2><br/>";

	?>

	<!-- Display table data. -->
	<table border="1" cellpadding="2" cellspacing="2">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Phone</th>
		</tr>

		<?php
		$result = mysqli_query($conn, "SELECT * FROM auth WHERE `username` = '$username'");

	/*
		userID INT
		username varchar(60),
	   password varchar(60),
	   firstName varchar(60),
	   lastName varchar(60),
	   email varchar(60),
	   phone varchar(60)
	*/ 

   while($query_data = mysqli_fetch_row($result)) {
   	echo "<tr>";
   	echo "<td>",$query_data[3], "</td>",
   	"<td>",$query_data[4], "</td>",
   	"<td>",$query_data[5], "</td>",
   	"<td>",$query_data[6], "</td>";
   	echo "</tr>";
   }
   ?>

	</table>
	<br/><a href="../home.html"><button>Back to Home</button></a>
</center>

	<!-- Clean up. -->
	<?php

	mysqli_free_result($result);
	mysqli_close($conn);
} // end if ($login!=0)
else
{
	echo "Incorrect username and/or password.";
	echo mysqli_error($conn);
}

?>