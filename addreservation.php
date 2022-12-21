<?php
include ('view/header.php');	

$date_in = $date_out = $res_client = $res_agent = $res_room= '';

$errors = array('res_client'=>'','res_agent'=>'','res_room'=>'');

if(isset($_POST['submit'])){
	if(empty($_POST['date_in'])){
			$errors['date_in'] = "A date in is required <br/>";
		} else {
			$date_in = $_POST['date_in'];
		}

	if(empty($_POST['date_out'])){
			$errors['date_out'] = "A date out is required <br/>";
		} else {
			$date_out = $_POST['date_out'];
		}

	if(empty($_POST['res_client'])){
			$errors['res_client'] = "A client is required <br/>";
		} else {
			$res_client = $_POST['res_client'];
		}

	if(empty($_POST['res_agent'])){
			$errors['res_agent'] = "An agent is required <br/>";
		} else {
			$res_agent = $_POST['res_agent'];
		}

	if(empty($_POST['res_room'])){
			$errors['res_room'] = "A room is required <br/>";
		} else {
			$res_room = $_POST['res_room'];
		}


	
	if(array_filter($errors)){
			
		} else{
			$date_in  = mysqli_real_escape_string($conn, $_POST['date_in']);
			$date_out  = mysqli_real_escape_string($conn, $_POST['date_out']);
			$res_client  = mysqli_real_escape_string($conn, $_POST['res_client']);
			$res_agent  = mysqli_real_escape_string($conn, $_POST['res_agent']);
			$res_room  = mysqli_real_escape_string($conn, $_POST['res_room']);
			$room = explode(',', $res_room);
			$idroom = $room[0];
			$bill = $room[1];

			$sql = "INSERT INTO reservation(date_in, date_out, res_client, res_agent, res_room) VALUES ('$date_in','$date_out','$res_client', '$res_agent','$idroom')";
			$sql2 = "UPDATE client set client_bill = client_bill + '$bill' where id_client = $res_client";

			

			if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
				$id = mysqli_insert_id($conn);
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
		}
		}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<table class="centertable2">
						<div class="alert alert-success">
							<h2 style="text-align:center; ">Добави резервация</h2>
						</div>
						
					<form method="POST">

						

					<tr>
  					<th>Клиент:
  					<br>
  						<select name="res_client" class="form-control">
   							<option value=0>--Избери клиент--</option>
      						<?php

      							$query = "SELECT * FROM client";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_client'];?>> <?php echo $row['client_fname']." ".$row['client_lname'] ?> </option>
      				<?php } ?>
   							</select>
  					<div class = "red-text"> <?php echo $errors['res_client']; ?> </div>
  					</th>
  					</tr>
  					<tr>
  					<th> Служител: 
  						<br>
  					<select name="res_agent" class="form-control">
   							<option value=0>--Избери служител--</option>
      						<?php

      							$query = "SELECT agent.id_agent,agent.agent_name,agent_pos.position FROM agent JOIN agent_pos ON agent.agent_position = agent_pos.id_pos";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_agent'];?>> <?php echo $row['agent_name']." - ".$row['position']."-".$row['id_agent'] ?> </option>
      				<?php } ?>
   							</select>
  					<div class = "red-text"> <?php echo $errors['res_agent']; ?> </div>
  					</th>
  					</tr>

  					<tr>
  					<th> Стая:
  					<br>
  					<select name="res_room" class="form-control">
   							<option value=0>--Избери стая--</option>
      						<?php

      							$query = "SELECT * FROM room WHERE room_status != 'OCCUPIED' ";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = "<?php echo $row['id_room'];?>,<?php echo $row['room_price'];?>"> <?php echo $row['room_number']." / ".$row['room_type']." / ".$row['room_price']."lv. / ".$row['room_status'] ?> </option>
      				<?php } ?>
   							</select>
  					<div class = "red-text"> <?php echo $errors['res_room']; ?> </div>
  					</th>
  					</tr>


  					<tr>
							<th>Дата на настаняване: <br>
								<input type="datetime-local" id="date_in" name="date_in">
								<div class = "red-text"> <?php echo $errors['date_in']; ?> </div>
							</th>
						</tr>

						<tr>
							<th>Дата на напускане:<br>
								<input type="datetime-local" id="date_out" name="date_out">
								<div class = "red-text"> <?php echo $errors['date_out']; ?> </div>
							</th>
						</tr>
					<tr>
  						<th>
  							<br>
   					<div class="center">
  						<input type="submit" name="submit" value = "ДОБАВИ" class = "btn brand z-deth-0">
					</div>
				</th>
				</tr>
  				</form>
  			</table>
</body>
</html>