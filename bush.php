<?php
$users = [
    "KU/STAFF/114/20" => "staff114",
    "KU/STAFF/113/20" => "staff113",
    "KU/STAFF/112/20" => "staff112",
    "KU/STAFF/111/20" => "staff111",
    "KU/STAFF/110/20" => "staff110",
    "KU/STAFF/109/20" => "staff109",
    "KU/STAFF/108/20" => "staff108",
    "KU/STAFF/107/20" => "staff107",
    "KU/STAFF/106/20" => "staff106",
    "KU/STAFF/105/20" => "staff105",
    "KU/STAFF/104/20" => "staff104",
    "KU/STAFF/103/20" => "staff103",
    "KU/STAFF/102/20" => "staff102",
    "KU/STAFF/101/20" => "staff101",
    "KU/STAFF/100/20" => "staff100"
];

foreach ($users as $username => $password) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    echo "$username, $password, $hashedPassword <br>";
}
?>
