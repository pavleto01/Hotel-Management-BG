<?php
include ('view/header.php');	

$room_number = $room_type = $room_price = $room_status = '';

$errors = array('room_number'=>'','room_type'=>'','room_price'=>'','room_status'=>'');

if(isset($_POST['submit'])){

	if(empty($_POST['room_number'])){
			$errors['room_number'] = "A room number is required <br/>";
		} else {
			$room_number = $_POST['room_number'];
		}

	if(empty($_POST['room_type'])){
			$errors['room_type'] = "A room type is required <br/>";
		} else {
			$room_type = $_POST['room_type'];
		}

	if(empty($_POST['room_price'])){
			$errors['room_price'] = "A price is required <br/>";
		} else {
			$room_price = $_POST['room_price'];
		}



	
	if(array_filter($errors)){
			
		} else{

			$room_number  = mysqli_real_escape_string($conn, $_POST['room_number']);
			$room_type  = mysqli_real_escape_string($conn, $_POST['room_type']);
			$room_price  = mysqli_real_escape_string($conn, $_POST['room_price']);
			$room_status  = "FREE";

			$sql = "INSERT INTO room(room_number, room_type, room_price,room_status) VALUES ('$room_number', '$room_type','$room_price','$room_status')";

			

			if(mysqli_query($conn, $sql)){
				header('Location: showrooms.php');
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
	<br>
	<div class="center">
		<form method="POST">
			<input type="submit" name="type" value = "Създай нов вид стая" class = "btn brand z-deth-0">
		</form>
	<br>
	<?php 

		if(isset($_POST['type'])){
			?>
			<form method="POST">
				<input type = "text" name = "type" value = "<?php echo htmlspecialchars($type) ?>">
				<input type="submit" name="add" value = "Създай" class = "btn brand z-deth-0">
			</form>
			
			<?php

			if(isset($_POST['add'])){
				$type  = mysqli_real_escape_string($conn, $_POST['type']);
				$sql = "INSERT INTO room_type(type) VALUES ('$type')";
				if(mysqli_query($conn, $sql)){
					header("Refresh:0");
				} else {
					echo 'query error: '. mysqli_error($conn);
				}
			}
		}

	 ?>
	 </div>
<table class="centertable2">
						<div class="alert alert-success">
							<h2 style="text-align:center; ">Добави стая</h2>
						</div>
						
					<form method="POST">
					<tr>
  					<th> Номер на стая:
  					<br>
  					<input type = "text" name = "room_number" value = "<?php echo htmlspecialchars($room_number) ?>">
  					<div class = "red-text"> <?php echo $errors['room_number']; ?> </div>
  					</th>
  					</tr>
  					<tr>
  					<th> Вид на стаята: 
  						<br>
  					<select name="room_type" class="form-control">
   							<option value=0>--Избери вид--</option>
      						<?php

      							$query = "SELECT * FROM room_type";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_type'];?>> <?php echo $row['type']; ?> </option>
      				<?php } ?>
   							</select>
  					<div class = "red-text"> <?php echo $errors['room_type']; ?> </div>
  					</th>
  					</tr>

  					<tr>
  					<th> Цена на стая:
  					<br>
  					<input type = "text" name = "room_price" value = "<?php echo htmlspecialchars($room_price) ?>">
  					<div class = "red-text"> <?php echo $errors['room_price']; ?> </div>
  					</th>
  					</tr>

					<tr>
  						<th>
   					<div class="center">
  						<input type="submit" name="submit" value = "ДОБАВИ" class = "btn brand z-deth-0">
					</div>
				</th>
				</tr>
  				</form>
  			</table>
</body>
</html>