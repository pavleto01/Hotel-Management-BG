<?php
include ('view/header.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
* {
  box-sizing: border-box;
}
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
.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 10px;
}

.row::after {
  
  clear: both;
  display: table;
}

.table{
margin-left: auto;
margin-right: auto;
width: 70%;
border-collapse: collapse;
}



.table3{
margin-left: auto;
margin-right: auto;
width: 70%;
border-collapse: collapse;
}


 th, td {
border-style:solid;
border-color: #96D4D4;
}

</style>
</head>
<body>
<br>

<table class="table">
        <thead>
            <tr style="height:50px">
                <th style="text-align:center;background-color: #D6EEEE">Номер на стая</th>
                <th style="text-align:center;background-color: #D6EEEE">Клиент</th>
                <th style="text-align:center;background-color: #D6EEEE">Служител</th>
                <th style="text-align:center;background-color: #D6EEEE">Стая</th>
                <th style="text-align:center;background-color: #D6EEEE">Цена</th>
            </tr>
        </thead>
        <tbody>

    <?php
        if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT reservation.id_reservation,reservation.date_in, reservation.date_out, reservation.res_client, reservation.res_agent, reservation.res_room, room.room_status, room.room_number,room.id_room, room.room_price, room_type.type, client.id_client, client.client_fname, client.client_lname, agent.id_agent, agent.agent_name, agent_pos.position FROM reservation JOIN room ON reservation.res_room = room.id_room JOIN room_type ON room.room_type = room_type.id_type JOIN client ON reservation.res_client = client.id_client JOIN agent ON reservation.res_agent = agent.id_agent JOIN agent_pos ON agent.agent_position = agent_pos.id_pos WHERE reservation.id_reservation = $id";
        $query=mysqli_query($conn,$sql)or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){
        ?>
            <tr>
                <td style="text-align:center; "><?php echo $row['room_number'] ?></td>
                <td style="text-align:center; "><?php echo $row['client_fname']." ".$row['client_lname'] ?></td>
                <td style="text-align:center; "><?php echo $row['agent_name']."-".$row['position'] ?></td>
                <td style="text-align:center; "><?php echo $row['room_number']."-".$row['type'] ?></td>
                <td style="text-align:center; "><?php echo $row['room_price'] ?></td>
        </tr>  
            <?php } } ?>     
        </tbody>
    </table>

<table class="table3">
<form method="POST">
<?php 
$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT reservation.id_reservation,reservation.date_in, reservation.date_out, reservation.res_client, reservation.res_agent, reservation.res_room, room.room_status, room.room_number,room.id_room, client.id_client, client.client_fname, client.client_lname, agent.id_agent, agent.agent_name, agent.agent_position FROM reservation JOIN room ON reservation.res_room = room.id_room JOIN client ON reservation.res_client = client.id_client JOIN agent ON reservation.res_agent = agent.id_agent WHERE reservation.id_reservation = $id";
        $query=mysqli_query($conn,$sql)or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){ 
            $id_room = $row['id_room'];
            ?>
<tr>
    <th> 
    <h4>Дата на настаняване: <?php echo $row['date_in']; ?>
    <br>
    <form method="POST">
    <input type="datetime-local" id="date_in" name="date_in">
     </h4>
     <input type="submit" name="updatedatein" value="Промени">
     <br><br>
     </form>
    </th>
</tr>

<tr>
    <th> 
    <h4>Дата на напускане: <?php echo $row['date_out']; ?>
    <br>
    <form method="POST">
    <input type="datetime-local" id="date_out" name="date_out">
     </h4>
    <input type="submit" name="updatedateout" value="Промени">
    <br><br>
</form>
    </th>
</tr>



</form>
</table>
<?php } 

if(isset($_POST['updatedatein'])){
    $date_in = $_POST['date_in'];

    $sql1 = "UPDATE reservation set  date_in = '$date_in' where id_reservation = $id";
    
    
    if(mysqli_query($conn, $sql1))
    {
        mysqli_close($conn); 
          ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
}

if(isset($_POST['updatedateout'])){
    $date_out = $_POST['date_out'];

    $sql2 = "UPDATE reservation set  date_out = '$date_out' where id_reservation = $id";
    
    
    if(mysqli_query($conn, $sql2))
    {
        mysqli_close($conn); 
         ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
}

if(isset($_POST['updatestatus'])){
    $room_status = $_POST['room_status'];
    
    $sql3 = "UPDATE room set  room_status = '$room_status' where id_room= $id_room";
    
    
    if(mysqli_query($conn, $sql3))
    {
        mysqli_close($conn); 
          ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php 
        exit;
    }
    else
    {
        echo mysqli_error($conn);
    }       
}


 ?>

</body>
	
</html>