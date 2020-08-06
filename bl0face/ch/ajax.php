<!-- 디비연결 -->
<?php
$servername = "localhost";
$username = "bioface1";
$password = "doubleii11!@";
$dbname = "bioface1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');

//Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

// echo "DB연결 성공 <br><br>";

// insert
$name = $_POST['name'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$wishtime = $_POST['wishtime'];
$part = $_POST['part'];
$date = date("Y-m-d H:i:s");

$sql = "INSERT INTO g5_write_ch(wr_name, wr_1, wr_2, wr_3, wr_4, wr_datetime) VALUES('".$name."','".$phone."','".$gender."','".$wishtime."','".$part."','".$date."')";

if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 ?>

