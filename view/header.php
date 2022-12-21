<?php

	error_reporting(E_ALL ^ E_WARNING);
	date_default_timezone_set("Europe/Sofia");
  $date = date('Y-m-d H:i:s ', time());
	include ('config/db_connect.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 5px 5px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

.header-left {
  float: left;
}
.center {
border: 0px white;
text-align: center;
}
.centertable {
  margin-left: auto;
  margin-right: auto;
  width: 70%;
  border:2px dodgerblue solid;
  border-collapse: collapse;
}

.centertable2 {
  margin-left: auto;
  margin-right: auto;
  width: 30%;
 
}

.centerfooter {
  margin-left: auto;
  margin-right: auto;
  width: 8em;
}
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
</head>
<body>

<div class="header">
  <div class = "header-left">
  <a href="index.php">Хотел</a>
</div>
  <div class="header-right">
    <a class="active" href="index.php">Начална страница</a>
    <a href="addreservation.php">Добави резервация</a>
    <a href="showclients.php">Клиенти</a>
    <a href="addclient.php">Добави клиент</a>
    <a href="showagents.php">Служители</a>
    <a href="addagent.php">Добави служител</a>
    <a href="showrooms.php">Стаи</a>
    <a href="addroom.php">Добави стая</a>
  </div>
</div>


</body>
</html>
