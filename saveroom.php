<?php
include ('config/db_connect.php');

$id_room = $_POST['id_room'];
$room_number = $_POST['room_number'];
$room_type = $_POST['room_type'];
$room_price= $_POST['room_price'];
$N = count($id_room);
for($i=0; $i < $N; $i++)
{
	$sql = "UPDATE room SET room_number='$room_number[$i]', room_type='$room_type[$i]', room_price='$room_price[$i]' where id_room='$id_room[$i]'" or die(mysqli_error());
	$result = mysqli_query($conn, $sql);

}
header('Location: showrooms.php');
?>
  		

