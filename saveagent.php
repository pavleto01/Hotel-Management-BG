<?php
include ('config/db_connect.php');

$id_agent = $_POST['id_agent'];
$agent_name = $_POST['agent_name'];
$agent_position = $_POST['agent_position'];
$agent_phone = $_POST['agent_phone'];
$N = count($id_agent);
for($i=0; $i < $N; $i++)
{
	$sql = "UPDATE agent SET agent_name='$agent_name[$i]', agent_position='$agent_position[$i]', agent_phone='$agent_phone[$i]' where id_agent='$id_agent[$i]'" or die(mysqli_error());
	$result = mysqli_query($conn, $sql);

}

header('Location: showagents.php');
?>
  		

