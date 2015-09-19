<?php
include "../config.php";
include "../classes/DB.php";

$db = new DB($dbname, $user, $pass);

$q = $_GET['q'];

$sql = "SELECT * FROM population WHERE location LIKE '{$q}%' ORDER BY population DESC LIMIT 10";

$data = $db->fetch($sql);

header('Content-Type: application/json');
echo json_encode($data);
