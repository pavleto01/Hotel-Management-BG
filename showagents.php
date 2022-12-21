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
	<title>Agents</title>
</head>
<body>

<form action="editagent.php" method="post">
	<table>
		<div class="alert alert-success">
			<h2 style="text-align:center; ">Служители</h2>
		</div>
		<thead>
			<tr style="height:50px">
				<th style="text-align:center;">Име на служител</th>
				<th style="text-align:center;">Позиция на служител</th>
				<th style="text-align:center;">Телефон на служител</th>
				<th><button id = "update_btn" class="btn brand z-deth-0"  name="submit_mult" type="submit">
		Промени данни
	</button></th>
			</tr>
		</thead>
		<tbody>

		<?php 
		$sql = "SELECT agent.id_agent,agent.agent_name,agent.agent_phone,agent_pos.position
						FROM agent JOIN agent_pos ON agent.agent_position = agent_pos.id_pos ";
		$query=mysqli_query($conn,$sql)or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		?>
			<tr style="height:30px">
				<td style="text-align:center; "><?php echo $row['agent_name'] ?></td>
				<td style="text-align:center; "><?php echo $row['position'] ?></td>
				<td style="text-align:center; "><?php echo $row['agent_phone'] ?></td>
				<td>
					<input name="selector[]" type="checkbox" value="<?php echo $row['id_agent']; ?>">
				</td>		
					
		</tr>
		<?php  }  ?>				 
		</tbody>
	</table>
</form>
</body>
<br>
</html>