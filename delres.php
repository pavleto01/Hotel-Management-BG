<?php
include ('config/db_connect.php');    
if(isset($_REQUEST['delete_id'])){
    $id = $_REQUEST['delete_id'];
    $sql = "DELETE FROM `reservation` WHERE `id_reservation` = $id";
    if(mysqli_query($conn, $sql)){
                    header("Location: index.php");
                } else {
                    echo 'query error: '. mysqli_error($conn);
                }
}
?>