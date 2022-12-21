<?php 
include ('view/header.php');
?>

<!DOCTYPE html>
<html>
<style>
	.button {
  background-color: dodgerblue;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.center-block {
  display: block;
  margin-right: auto;
  margin-left: auto;
}
</style>
<body>

<br>

<form class="form-horizontal" action="saveroom.php" method="post">    
<?php
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$sql = "SELECT * FROM room where id_room='$id[$i]'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result))
{ ?>
	<section class = "container" grey-text>
	<table class = "centertable2">

					<form class="white">
		
		<tr>
			<th style=" color:dodgerblue;"> Номер на стая:
  					<br>
		<input name="id_room[]" type="hidden" value="<?php echo  $row['id_room'] ?>" />
			<input name="room_number[]" type="text" style="font-weight:bold;" value="<?php echo $row['room_number'] ?>" />
		</th>
	</tr>

	
		
		<tr>
  					<th style=" color:dodgerblue;"> Цена на стая:
  					<br>
			<input name="room_price[]" type="text" style=" font-weight:bold;" value="<?php echo $row['room_price'] ?>" />
		</th>
	</tr>
			
			<tr>
			<th style=" color:dodgerblue;"> Вид на стаята:
  					<br>
			<select name="room_type[]" class="form-control">
   							<option value=0>--Избери вид--</option>
      						<?php

      							$query = "SELECT * FROM room_type";
      							$result = mysqli_query($conn, $query);
      							while($row = mysqli_fetch_array($result)){
      						?>
      					<option value = <?php echo $row['id_type'];?>> <?php echo $row['type']; ?> </option>
      				<?php } ?>
   							</select>
		</th>
	</tr>


</table>

	<br />	
<?php 
}
}
?>
<br><input type="submit" class="center-block" name="update" value="ПРОМЕНИ">
</form>
	<br>
<div class="center">
    <form action="showrooms.php">
        <input class="button" type="submit" name="return" value="НАЗАД">
    </form>
</div>
<br><br><br>
</body>
</html>