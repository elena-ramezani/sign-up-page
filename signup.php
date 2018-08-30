<link rel="stylesheet" href="../css/style.css"> <br/><br/><br/><center>
<?php

$conn = mysqli_connect("localhost:3306","root","","finaldb") or die ("could not connect database");

$firstname = $_POST['firstname'];
$firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
$lastname = $_POST['lastname'];
$lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$phone = $_POST['phone'];
$phone = filter_var($phone, FILTER_SANITIZE_STRING);

$username = $_POST['username'];
$username = filter_var($username, FILTER_SANITIZE_STRING);
$password = $_POST['password'];
$password = filter_var($password, FILTER_SANITIZE_STRING);
// no hash for simplicity

$result = mysqli_query($conn, "SELECT * FROM `auth` WHERE `username` = '$username'");
$numRecords = 0;
if ($result!=false)
{
	$numRecords=mysqli_num_rows($result);
	// echo "<br/>login: ".$numRecords."<br/>";
}
else
{
	$error = mysqli_error($conn);
	//echo "error: ".$error ."<br/>";
	$result = 0;
}

if ($numRecords!=0)
{
	echo "A user already exists with that username.";
}
else
{
	$q=mysqli_query($conn, "INSERT INTO `auth` (`username`,`password`,`firstname`,`lastname`, `email`, `phone`) values ('$username','$password', '$firstname'
		, '$lastname', '$email','$phone')");
	$error = mysqli_error($conn);
	if($q)
	{
		echo "<h3>Success. You are now Registered.</h3><br/>";
		showTable();
	}
	else
	{
		$error = mysqli_error($conn);
		echo "error: ".$error ."<br/>";
		echo "failed to register.";
	}
}

/* function showTable */
function showTable(){
    // connection to mySql
	$conn = mysqli_connect("localhost:3306","root","","finaldb") or die ("could not connect database");

	if(! $conn) {
		die("Sql connection failed " . mysql_error() . "</body></html>");
	} else {
		$query = "SELECT * FROM auth ORDER BY username";
		$result = $conn->query($query);
		?>
		<div style='width:1150px; background-color: forestgreen;'>
			<table style='width:100%'>
				<caption>List of users</caption>
				<th>ID</th>
				<th>Username</th>
				<th>Password</th>

				<?php
				while($row = $result->fetch_assoc()) {
					print("<tr>");
					print("<td>$row[userid]</td>");
					print("<td>$row[username]</td>");
					print("<td>$row[password]</td>");
					print("</tr>");
				}
				?>
			</table>
		</div>
		<br/><a href="../home.html"><button>Back to Home</button></a>
</center>
		<?php
	}
}  // end function showTable
?>