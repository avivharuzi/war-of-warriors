<?php

require_once("connection/db.php");

if (isset($_POST["query"])) {
    $request = $_POST["query"];
    $sql = "SELECT * FROM war WHERE Name LIKE '%" . $request . "%'";
    
    $result = $conn->getFullData($sql);
    
    if ($result) {
        foreach ($result as $value) {
            $data[] = $value->Name;
        }
        echo json_encode($data);
    }
}

?>
