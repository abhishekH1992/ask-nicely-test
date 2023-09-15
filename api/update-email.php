<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['id']) && !is_numeric($_POST['id'])){
        $connection->close();
        echo json_encode(['status' => 'error', 'msg' => 'Something went wrong. Please relaod the page.']);
        die();
    }

    if(!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $connection->close();
        echo json_encode(['status' => 'error', 'msg' => 'Email is required and it should be in correct format.']);
        die();
    }

    try {
        $sql = 'UPDATE employee SET email = "'.$_POST['email'].'" WHERE id = '.$_POST['id'].';';
        $connection->query($sql);
        echo json_encode(['status' => 'success', 'msg' => 'Email updated']);
        $connection->close();
        die();
    } catch(Exception $e) {
        echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
        $connection->close();
        die();
    }
} else {
    $connection->close();
    echo json_encode(['status' => 'error', 'msg' => 'Something went wrong. Please relaod the page.']);
    die();
}

function validate($row) {
    if(!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && filter_var($row[2], FILTER_VALIDATE_EMAIL) && !empty($row[3]) && (is_numeric($row[3]) || is_double($row[3]))) {
        return true;
    }
    return false;
}
?>