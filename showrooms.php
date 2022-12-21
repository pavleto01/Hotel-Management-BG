<?php
include ('view/header.php');	

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
table{
   margin-left: auto;
  margin-right: auto;
  width: 70%;
  border-collapse: collapse;
}

th{
 	background-color: #D6EEEE;
}

 th, td {
 	border-style:solid;
  border-color: #96D4D4;
}

.button {
  background-color: dodgerblue;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
	<link rel="stylesheet" href="css/main.css">
	<title>Стаи</title>
</head>
<body>
<form action="editroom.php" method="post">
	<table>
		<div class="alert alert-success">
			<h2 style="text-align:center; ">Стаи</h2>
		</div>
		<thead>
			<tr style="height:50px">
				<th style="text-align:center;">Номер на стая</th>
				<th style="text-align:center;">Вид на стая</th>
				<th style="text-align:center;">Цена</th>
				<th style="text-align:center;">Статус</th>
				<th><button id = "update_btn" class="btn brand z-deth-0"  name="submit_mult" type="submit">
		Промени данни
	</button></th>
			</tr>
		</thead>
		<tbody>

		<?php 
		$sql = "SELECT room.id_room,room.room_number,room.room_type,room.room_price,room.room_status,room_type.type 
						FROM room JOIN room_type ON room.room_type = room_type.id_type";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		?>
			<tr style="height:30px">
				<td style="text-align:center; "><?php echo $row['room_number'] ?></td>
				<td style="text-align:center; "><?php echo $row['type'] ?></td>
				<td style="text-align:center; "><?php echo $row['room_price'] ?></td>
				<td style="text-align:center; "><?php echo $row['room_status'] ?></td>
				<td>
					<input name="selector[]" type="checkbox" value="<?php echo $row['id_room']; ?>">
				</td>			
		</tr>
		<?php  }  ?>				 
		</tbody>
	</table>
</form>
</body>
<br>
</html>