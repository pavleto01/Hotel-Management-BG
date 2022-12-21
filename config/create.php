<?php 
 $host= 'localhost';
 $dbUser= 'root';
 $dbPass= '';
 if(!$conn=mysqli_connect($host, $dbUser, $dbPass))
 {
 die('Не може да се осъществи връзка със сървъра.');
 }
 $sql = 'CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
';
 
 if ($queryResource=mysqli_query($conn,$sql)) 
 {
 echo "Базата данни е създадена. <br>";
 }
 else
 {
 echo "Грешка при създаване на базата данни: " . mysqli_error($conn);
 }
 if (!mysqli_select_db( $conn, 'hotel'))
 {
 die('Не може да се селектира базата от данни:'. mysqli_error($conn));
 }

$sql2 = 'CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `client_fname` varchar(255) NOT NULL,
  `client_lname` varchar(255) NOT NULL,
  `client_address` varchar(255) NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_bill` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';

$result = mysqli_query($conn,$sql2);
 if(!$result)
 die('Грешка при създаване на таблицата: ' . mysqli_error($conn));

$sql3 = 'CREATE TABLE `agent` (
  `id_agent` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_phone` varchar(255) NOT NULL,
  `agent_position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';

$result = mysqli_query($conn,$sql3);
 if(!$result)
 die('Грешка при създаване на таблицата: ' . mysqli_error($conn));

$sql4 = 'CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_type` int(255) NOT NULL,
  `room_price` varchar(255) NOT NULL,
  `room_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';

$result = mysqli_query($conn,$sql4);
 if(!$result)
 die('Грешка при създаване на таблицата: ' . mysqli_error($conn));

$sql5 = 'CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `res_client` int(11) NOT NULL,
  `res_agent` int(11) NOT NULL,
  `res_room` int(11) NOT NULL,
  `date_in` datetime NOT NULL,
  `date_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';

$result = mysqli_query($conn,$sql5);
 if(!$result)
 die('Грешка при създаване на таблицата: ' . mysqli_error($conn));

$sql12 = 'CREATE TABLE `agent_pos` (
  `id_pos` int(11) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';
$result = mysqli_query($conn,$sql12);
 if(!$result)
 die('Грешка при създаване на таблица: ' . mysqli_error($conn));

$sql13 = 'CREATE TABLE `room_type` (
  `id_type` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';
$result = mysqli_query($conn,$sql13);
 if(!$result)
 die('Грешка при създаване на таблица: ' . mysqli_error($conn));

$sql14 = ' ALTER TABLE `agent`
  ADD PRIMARY KEY (`id_agent`),
  ADD KEY `agent_position` (`agent_position`);  ';
$result = mysqli_query($conn,$sql14);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));

$sql15 = ' ALTER TABLE `agent_pos`
  ADD PRIMARY KEY (`id_pos`); ';
$result = mysqli_query($conn,$sql15);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));

$sql6 = 'ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`); ';
$result = mysqli_query($conn,$sql6);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));

$sql7 = 'ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `room` (`res_room`),
  ADD KEY `agent` (`res_agent`),
  ADD KEY `client` (`res_client`); ';
$result = mysqli_query($conn,$sql7);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));


$sql8 = 'ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `room_type` (`room_type`); ';
$result = mysqli_query($conn,$sql8);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));

$sql16 = 'ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id_type`); ';
$result = mysqli_query($conn,$sql16);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));


$sql17 = 'ALTER TABLE `agent`
  ADD CONSTRAINT `agent_position` FOREIGN KEY (`agent_position`) REFERENCES `agent_pos` (`id_pos`); ';
$result = mysqli_query($conn,$sql17);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));


$sql18 = 'ALTER TABLE `reservation`
  ADD CONSTRAINT `agent` FOREIGN KEY (`res_agent`) REFERENCES `agent` (`id_agent`),
  ADD CONSTRAINT `client` FOREIGN KEY (`res_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `room` FOREIGN KEY (`res_room`) REFERENCES `room` (`id_room`); ';
$result = mysqli_query($conn,$sql18);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));

$sql19 = 'ALTER TABLE `room`
  ADD CONSTRAINT `room_type` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`id_type`);';
$result = mysqli_query($conn,$sql19);
 if(!$result)
 die('Грешка при създаване на връзки: ' . mysqli_error($conn));


?>

