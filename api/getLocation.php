<?php

include "../classes/DB.php";

$db = new DB('wallethub', 'wallethub', '$$P4$$W0rd!#');

$q = $_GET['q'];

$sql = "SELECT * FROM population WHERE location LIKE '{$q}%' LIMIT 10";

$data = $db->fetch($sql);

header('Content-Type: application/json');
echo json_encode($data);
