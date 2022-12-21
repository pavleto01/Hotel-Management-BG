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
	<title>Резервации</title>
</head>
<body>
	<br><br>
		<div class = "center">
	<form method="post">
			<label >Търси по служител</label>
			<input type="text" name="agent">
			<input type="submit" name="bydate" value = "Търси">
			<br><br><input type="submit" name="topfive" value = "Топ 5 служителя">
			<br><br><input type="submit" name="mostres" value = "Най-резервирани стаи">
			<br><br><input type="submit" name="all" value = "Всички резервации">
			</form>	
		</div>

		<br><br>
	
		<?php

		if(isset($_POST['bydate'])){
			$str = $_POST["agent"];
			$sql = "SELECT reservation.id_reservation,reservation.date_in, reservation.date_out, reservation.res_client, reservation.res_agent, reservation.res_room, room.room_status, room.room_number,room.id_room, client.id_client, client.client_fname, client.client_lname, agent.id_agent, agent.agent_name, agent.agent_position,agent_pos.position FROM reservation JOIN room ON reservation.res_room = room.id_room JOIN client ON reservation.res_client = client.id_client JOIN agent ON reservation.res_agent = agent.id_agent JOIN agent_pos ON agent.agent_position = agent_pos.id_pos WHERE agent.agent_name LIKE '%$str%' ORDER BY reservation.date_in desc";
			$query=mysqli_query($conn,$sql)or die(mysqli_error());
			while($row=mysqli_fetch_array($query)){
				$id_room = $row['id_room'];
			?>
			<table>

		<thead>
			<tr style="height:50px">
				<th style="text-align:center;width:18%;">Дата на настаняване</th>
				<th style="text-align:center;width:18%;">Дата на напускане</th>
				<th style="text-align:center;width:19%;">Клиент</th>
				<th style="text-align:center;width:19%;">Служител</th>
				<th style="text-align:center;width:6%;">Стая</th>
				<th style="text-align:center;width:10%;">Статус</th>
				<th style="text-align:center;width:10%;">Детайли</th>
			</tr>
		</thead>
		<tbody>
			<tr>
					<td style="text-align:center; "><?php echo $row['date_in'] ?></td>
					<td style="text-align:center; "><?php echo $row['date_out'] ?></td>
					<td style="text-align:center; "><?php echo $row['client_fname']." ".$row['client_lname'] ?></td>
					<td style="text-align:center; "><?php echo $row['agent_name']."-".$row['position'] ?></td>
					<td style="text-align:center; "><?php echo $row['room_number'] ?></td>
					<td style="text-align:center; "> <?php

					if($row['date_out']>$date && $row['date_in']<$date){
						$sql1 = "UPDATE room SET room_status = 'OCCUPIED' where id_room = '$id_room'";
						if(mysqli_query($conn, $sql1)){
						} else {
							echo 'query error: '. mysqli_error($conn);
						}
						?>
						<p style="color:green">ЗАЕТА</p>
						<?php
					}else {
						
						$sql1 = "UPDATE room SET room_status = 'FREE' where id_room = '$id_room'";
						if(mysqli_query($conn, $sql1)){
						} else {
							echo 'query error: '. mysqli_error($conn);
						}
					?>
					<p style="color:red">СВОБОДНА</p>
				<?php }
			?> </td>
			<td style="text-align:center; "><a  href="showdetails.php?id=<?php echo $row['id_reservation']; ?>">ПОКАЖИ</a></td>			
		</tr>
	<?php  }  ?>				 
</tbody>
</table>

<?php  
		}

		if(isset($_POST['topfive'])){
			$str = $_POST["agent"];
			$sql = "SELECT agent.agent_name,agent.agent_position,agent_pos.position, COUNT(agent.id_agent) AS `reservations` FROM reservation JOIN agent ON reservation.res_agent = agent.id_agent JOIN agent_pos ON agent.agent_position = agent_pos.id_pos GROUP BY agent.agent_name ORDER BY reservations DESC limit 5;";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
			while($row=mysqli_fetch_array($query)){
			?>
			<table>

		<thead>
			<tr style="height:50px">
				<th style="text-align:center;">Име на служител</th>
				<th style="text-align:center;">Брой резервации</th>
			</tr>
		</thead>
		<tbody>
			<tr>
					<td style="text-align:center; width:50%;"><?php echo $row['agent_name']."-".$row['position'] ?></td>
					<td style="text-align:center; width:50%;"><?php echo $row['reservations'] ?></td>
		</tr>
	<?php  }  ?>				 
</tbody>
</table>

<?php  
		}
 
			if(isset($_POST['mostres'])){
			$str = $_POST["agent"];
			$sql = "SELECT room.room_number,room.room_type,room.room_price,room_type.type, COUNT(room.room_number) AS `reservations` FROM reservation JOIN room ON reservation.res_room = room.id_room JOIN room_type ON room.room_type = room_type.id_type GROUP BY room.room_number ORDER BY reservations DESC ";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
			while($row=mysqli_fetch_array($query)){
			?>
			<table>

		<thead>
			<tr style="height:50px">
				<th style="text-align:center;width:25%;">Номер на стая</th>
				<th style="text-align:center;width:25%;">Вид на стая</th>
				<th style="text-align:center;width:25%;">Цена</th>
				<th style="text-align:center;width:25%;">Брой резервации</th>
			</tr>
		</thead>
		<tbody>
			<tr>
					<td style="text-align:center;"><?php echo $row['room_number'] ?></td>
					<td style="text-align:center;"><?php echo $row['type'] ?></td>
					<td style="text-align:center;"><?php echo $row['room_price'] ?></td>
					<td style="text-align:center;"><?php echo $row['reservations'] ?></td>
		</tr>
	<?php  }  ?>				 
</tbody>
</table>

<?php  
		}

		if(!isset($_POST['mostres']) && !isset($_POST['topfive']) && !isset($_POST['bydate'])){
			$str = $_POST["agent"];
			$sql = "SELECT reservation.id_reservation,reservation.date_in, reservation.date_out, reservation.res_client, reservation.res_agent, reservation.res_room, room.room_status, room.room_number,room.id_room, client.id_client, client.client_fname, client.client_lname, agent.id_agent, agent.agent_name, agent.agent_position,agent_pos.position FROM reservation JOIN room ON reservation.res_room = room.id_room JOIN client ON reservation.res_client = client.id_client JOIN agent ON reservation.res_agent = agent.id_agent JOIN agent_pos ON agent.agent_position = agent_pos.id_pos ORDER BY reservation.date_in asc";
			$query=mysqli_query($conn,$sql)or die(mysqli_error());
			while($row=mysqli_fetch_array($query)){
				$id_room = $row['id_room'];
			?>
			<table>

		<thead>
			<tr style="height:50px">
				<th style="text-align:center;width:18%;">Дата на настаняване</th>
				<th style="text-align:center;width:18%;">Дата на напускане</th>
				<th style="text-align:center;width:19%;">Клиент</th>
				<th style="text-align:center;width:19%;">Служител</th>
				<th style="text-align:center;width:6%;">Стая</th>
				<th style="text-align:center;width:10%;">Статус</th>
				<th style="text-align:center;width:10%;">Детайли</th>
			</tr>
		</thead>
		<tbody>
			<tr>
					<td style="text-align:center; width:15%;"><?php echo $row['date_in'] ?></td>
					<td style="text-align:center; width:15%;"><?php echo $row['date_out'] ?></td>
					<td style="text-align:center; width:12%;"><?php echo $row['client_fname']." ".$row['client_lname'] ?></td>
					<td style="text-align:center; width:18%;"><?php echo $row['agent_name']."-".$row['position'] ?></td>
					<td style="text-align:center; width:5%;"><?php echo $row['room_number'] ?></td>
					<td style="text-align:center; width:10%;"> <?php

					if($row['date_out']>$date && $row['date_in']<$date){
						$sql1 = "UPDATE room SET room_status = 'OCCUPIED' where id_room = '$id_room'";
						if(mysqli_query($conn, $sql1)){
						} else {
							echo 'query error: '. mysqli_error($conn);
						}
						?>
						<p style="color:green">ЗАЕТА</p>
						<?php
					}else {
						
						$sql1 = "UPDATE room SET room_status = 'FREE' where id_room = '$id_room'";
						if(mysqli_query($conn, $sql1)){
						} else {
							echo 'query error: '. mysqli_error($conn);
						}
					?>
					<p style="color:red">СВОБОДНА</p>
				<?php }
			?> </td>
			<td style="text-align:center; width:10%;"><a  href="showdetails.php?id=<?php echo $row['id_reservation']; ?>">ПОКАЖИ</a></td>	
			<td style="text-align:center; "><a href="delres.php?delete_id=<?php echo $row['id_reservation']; ?>">ИЗТРИЙ</a></td>		
		</tr>
	<?php  }  ?>				 
</tbody>
</table>

<?php  
		}
		if(isset($_POST['all'])){
			?>
		<script type="text/javascript">
			window.location.href = window.location.href;
		</script>
		<?php 
		}
			
				?>
				

</body>
<br>
</html>