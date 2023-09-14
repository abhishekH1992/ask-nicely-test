<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    try {
        $sql = "SELECT * FROM employee AS e LEFT JOIN company AS c ON c.user_id = e.id";
        $result = mysqli_query($conection, $sql);
        $data = [];
        if ($result) {
            while($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        echo json_encode(['status' => 'success', 'result' => $data]);
    } catch(Exception $e) {
        echo json_encode(['status' => 'error', 'result' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'result' => []]);
}
mysqli_close($conection);
?>