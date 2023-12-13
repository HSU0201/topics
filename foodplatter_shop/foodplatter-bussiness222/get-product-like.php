<?php
require_once("../foodplatter_connect.php");

// LIKE 可以用來篩選出部分符合條件的字串
$sql="SELECT * FROM food_list WHERE name LIKE '%Ja%'";

$result = $conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);

var_dump($rows);//把name中有Ja的找出來
$conn->close();