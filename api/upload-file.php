<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );

    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)){
        // Open uploaded CSV file with read-only mode
        $file = fopen($_FILES['file']['tmp_name'], 'r');
        $isValidationFailed = false;

        // CSV column headers
        $heading = str_getcsv(trim(fgets($file)), ',', '"');
        $acceptedHeader = [
            'Company Name',
            'Employee Name',
            'Email Address',
            'Salary'
        ];

        if ($heading !== $acceptedHeader) {
            fclose($file);
            $connection->close();
            echo json_encode(['status' => 'error', 'msg' => 'CSV column heading is not correct. It should be Company Name, Employee Name, Email Address, Salary and in same order.']);
            die();
        } else {
            $data = [];

            $connection->query("SET AUTOCOMMIT=0");
            $connection->query("START TRANSACTION");

            // Parse data from CSV file line by line        
            while ($row = fgetcsv($file)){
                if(validate($row)){
                    try {
                        $query = 'INSERT INTO employee (name, email, company_name, salary) VALUES ("'.$row[1].'", "'.$row[2].'", "'.$row[0].'", '.$row[3].');';
                        $connection->query($query);
                    } catch(Exception $e) {
                        $connection->rollback();
                        fclose($file);
                        $connection->close();
                        echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
                        exit;
                        die();
                    }
                } else {
                    $connection->rollback();
                    fclose($file);
                    $connection->close();
                    echo json_encode(['status' => 'error', 'msg' => 'Please make sure all the columns has value. Salary should be in number format and check email format.']);
                    exit;
                    die();
                }
            }

            $connection->query("COMMIT");
            $connection->query("SET AUTOCOMMIT=1");

            fclose($file);
            $connection->close();
            echo json_encode(['status' => 'success', 'msg' => 'CSV uploaded.']);
        }      
    } else {
        $connection->close();
        echo json_encode(['status' => 'error', 'msg' => 'Please upload csv file.']);
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