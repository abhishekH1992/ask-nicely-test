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
        $accetedHeader = [
            'Company Name',
            'Employee Name',
            'Email Address',
            'Salary'
        ];

        if ($heading !== $accetedHeader) {
            fclose($file);
            $connection->close();
            echo json_encode(['status' => 'error', 'msg' => 'CSV column heading is not correct. It should be Company Name, Employee Name, Email Address, Salary and in same order.']);
            die();
        } else {
            $data = [];

            // Parse data from CSV file line by line        
            while ($row = fgetcsv($file)){
                if(validate($row)){
                    array_push($data, $row);
                } else {
                    $isValidationFailed = true;
                    exit;
                }
            }

            if($isValidationFailed){
                fclose($file);
                $connection->close();
                echo json_encode(['status' => 'error', 'msg' => 'Please make sure all the columns has value. Salary should be in number format and check email format.']);
                die();
            }
            $query = null;
            foreach($data as $d) {
                $query .= 'INSERT INTO employee (name, email, company_name, salary) VALUES ("'.$d[1].'", "'.$d[2].'", "'.$d[0].'", '.$d[3].');';
            }

            try {
                $connection->multi_query($query);
            } catch(Exception $e) {
                $connection->rollback();
                fclose($file);
                $connection->close();
                echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
                die();
            }

            fclose($file);
            echo json_encode(['status' => 'success', 'msg' => 'CSV uplaoded.']);
            $connection->close();
        }      
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Please upload csv file.']);
        die();
    }
}

function validate($row) {
    if(!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && filter_var($row[2], FILTER_VALIDATE_EMAIL) && !empty($row[3]) && (is_numeric($row[3]) || is_double($row[3]))) {
        return true;
    }
    return false;
}
?>