<?php
include ('view/header.php');	

$agent_name = $agent_position = $agent_phone = '';

$errors = array('agent_name'=>'','agent_position'=>'','agent_phone'=>'');

if(isset($_POST['submit'])){

	if(empty($_POST['agent_name'])){
			$errors['agent_name'] = "A name is required <br/>";
		} else {
			$agent_name = $_POST['agent_name'];
		}

	if(empty($_POST['agent_phone'])){
			$errors['agent_phone'] = "A phone is required <br/>";
		} else {
			$agent_phone = $_POST['agent_phone'];
		}

	if(empty($_POST['agent_position'])){
			$errors['agent_position'] = "A position is required <br/>";
		} else {
			$agent_position = $_POST['agent_position'];
		}


	
	if(array_filter($errors)){
			
		} else{

			$agent_name  = mysqli_real_escape_string($conn, $_POST['agent_name']);
			$agent_position  = mysqli_real_escape_string($conn, $_POST['agent_position']);
			$agent_phone  = mysqli_real_escape_string($conn, $_POST['agent_phone']);

			$sql = "INSERT INTO agent(agent_name, agent_position, agent_phone) VALUES ('$agent_name', '$agent_position','$agent_phone')";

			

			if(mysqli_query($conn, $sql)){
				header('Location: showagents.php');
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
			<input type="submit" name="pos" value = "Създай нова позиция" class = "btn brand z-deth-0">
		</form>
	<br>
	<?php 

		if(isset($_POST['pos'])){
			?>
			<form method="POST">
				<input type = "text" name = "pos" value = "<?php echo htmlspecialchars($pos) ?>">
				<input type="submit" name="add" value = "Създай" class = "btn brand z-deth-0">
			</form>
			
			<?php

			if(isset($_POST['add'])){
				$position  = mysqli_real_escape_string($conn, $_POST['pos']);
				$sql = "INSERT INTO agent_pos(position) VALUES ('$position')";
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
							<h2 style="text-align:center; ">Добави служител</h2>
						</div>
						
					<form method="POST">
					<tr>
  					<th> Име на служител:
  					<br>
  					<input type = "text" name = "agent_name" value = "<?php echo htmlspecialchars($agent_name) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_name']; ?> </div>
  					</th>
  					</tr>
  					<tr>
  					<th> Позиция на служител: 
  						<br>
  					<select name="agent_position" class="form-control">
   							<option value=0>--Избери позиция--</option>
      						<?php

      							$query = "SELECT * FROM agent_pos";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_pos'];?>> <?php echo $row['position'] ?> </option>
      				<?php } ?>
   							</select>
  					<div class = "red-text"> <?php echo $errors['agent_position']; ?> </div>
  					</th>
  					</tr>

  					<tr>
  					<th> Телефон на служител:
  					<br>
  					<input type = "text" name = "agent_phone" value = "<?php echo htmlspecialchars($agent_phone) ?>">
  					<div class = "red-text"> <?php echo $errors['agent_phone']; ?> </div>
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