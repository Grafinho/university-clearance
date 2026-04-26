<?php

$users = [
    "LIB/101/2024" => "ADMINLIB",
    "FIN/102/2024" => "ADMINFIN",
    "ENG/103/2024" => "ADMINENGINE",
    "SCI/104/2024" => "ADMINSCI",
    "LAW/105/2024" => "ADMINLAW",
    "ART/106/2024" => "ADMINART",
    "ICT/107/2024" => "ADMINICT",
    "MAT/108/2025" => "ADMINMAT",
    "STA/109/2025" => "ADMINSTA",
    "BUS/110/2025" => "ADMINBUS",
    "ADM/111/2025" => "ADMINADM",
    "ENV/112/2025" => "ADMINENV",
    "PHY/113/2025" => "ADMINPHY",
    "CHE/114/2025" => "ADMINCHE",
    "ECO/115/2025" => "ADMINECO"
];

foreach ($users as $username => $pwd) {
    $hash = password_hash($pwd, PASSWORD_DEFAULT);
    echo "UPDATE non_students SET password = '$hash' WHERE username = '$username';<br>";
}

?>