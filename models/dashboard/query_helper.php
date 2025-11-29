<?php
require_once __DIR__ . '/../connection_string.php';

function getCurrentUserDetails()
{
    global $dbcon;

    $curr_user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM user u JOIN user_role u_role ON u.user_type = u_role.id WHERE u.id= {$curr_user_id}";

    $result = mysqli_query($dbcon, $sql);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows == 0) return [];
    $row = mysqli_fetch_assoc($result);

    return $row;
}


function getUserRoles()
{
    global $dbcon;

    $sql = "SELECT * FROM user_role";

    $result = mysqli_query($dbcon, $sql);
    $all_roles = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_roles;
}


function getBloodDepartments()
{
    global $dbcon;

    $sql = "SELECT * FROM blood_department";

    $result = mysqli_query($dbcon, $sql);
    $all_blood_departments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_blood_departments;
}


function getAllBloodTests()
{
    global $dbcon;

    $sql = "SELECT bt.*, bd.name as department_name,bd.id as department_id FROM blood_tests bt JOIN blood_department bd on bd.id = bt.department_id";

    $result = mysqli_query($dbcon, $sql);
    $all_blood_tests = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_blood_tests;
}

function getAllBloodTestsByTestName($searched_string)
{
    global $dbcon;


    $sql = "SELECT bt.*, bd.name as department_name,bd.id as department_id FROM blood_tests bt JOIN blood_department bd on bd.id = bt.department_id WHERE bt.test_name LIKE '%$searched_string%'";

    $result = mysqli_query($dbcon, $sql);
    $all_blood_tests = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_blood_tests;
}

function getAllStaff()
{
    global $dbcon;


    $sql = "SELECT u.id as id, u.name, u.phone_number, ur.role_name, ur.id as role_id, ul.username, u.status FROM user u 
    INNER JOIN user_login ul ON u.id = ul.user_id 
    INNER JOIN user_role ur ON u.user_type = ur.id ORDER BY u.name ASC";

    $result = mysqli_query($dbcon, $sql);
    $all_staff = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_staff;
}

function getAllPatientsEntries()
{
    global $dbcon;

    $sql = "SELECT pbt.*, bt.id AS blood_id, bt.test_name, bt.test_code,bt.code, bt.price_rate,bt.sale_rate, bt.payment FROM patient_blood_test pbt INNER JOIN blood_tests bt on pbt.blood_test_id = bt.id ORDER BY pbt.created_date DESC";
    $result = mysqli_query($dbcon, $sql);

    $all_patient_entries = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_patient_entries;
}

function getAllPatientsEntriesByTicketNumber($searched_string)
{
    global $dbcon;

    $sql = "SELECT pbt.*, bt.id AS blood_id, bt.test_name, bt.test_code,bt.code, bt.price_rate,bt.sale_rate, bt.payment FROM patient_blood_test pbt INNER JOIN blood_tests bt on pbt.blood_test_id = bt.id WHERE pbt.ticket_number LIKE '%$searched_string%' ORDER BY pbt.created_date DESC";
    $result = mysqli_query($dbcon, $sql);

    $all_patient_entries = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $all_patient_entries;
}


function getAllPatientEntriesForCurrentMonth()
{
    global $dbcon;

    $curr_year = date("Y");
    $curr_month = date("m");

    $sql = "SELECT COUNT(*) as total_count 
            FROM patient_blood_test pbt 
            WHERE YEAR(pbt.created_date) = ? 
            AND MONTH(pbt.created_date) = ?";

    $stmt = $dbcon->prepare($sql);
    $stmt->bind_param("ss", $curr_year, $curr_month);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row['total_count'];
}

function getCompletedTestsForCurrentMonth()
{
    global $dbcon;

    $curr_year = date("Y");
    $curr_month = date("m");

    $sql = "SELECT COUNT(*) as total_count 
            FROM patient_blood_test pbt 
            WHERE pbt.status = 'completed' 
            AND pbt.amount_due = 0
            AND YEAR(pbt.modified_date) = ? 
            AND MONTH(pbt.modified_date) = ?";

    $stmt = $dbcon->prepare($sql);
    $stmt->bind_param("ss", $curr_year, $curr_month);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row['total_count'];
}

function getPendingTestsForCurrentMonth()
{
    global $dbcon;

    $curr_year = date("Y");
    $curr_month = date("m");

    $sql = "SELECT COUNT(*) as total_count 
            FROM patient_blood_test pbt 
            WHERE pbt.status = 'pending' 
            AND pbt.amount_due > 0
            AND ((YEAR(pbt.created_date) = ? AND MONTH(pbt.created_date) = ?)
            OR (YEAR(pbt.modified_date) = ? AND MONTH(pbt.modified_date) = ?))";

    $stmt = $dbcon->prepare($sql);
    $stmt->bind_param("ssss", $curr_year, $curr_month, $curr_year, $curr_month);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row['total_count'];
}



function getDailyBloodTestCount()
{
    global $dbcon;
    $sql = "SELECT COUNT(*) AS total_count, branch_code FROM patient_blood_test pbt WHERE DATE(pbt.created_date) = CURDATE() GROUP BY branch_code";
    $stmt = $dbcon->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = [
            'branch_code' => $row['branch_code'],
            'total_count' => $row['total_count']
        ];
    }
    $stmt->close();
    return json_encode($rows);
}



function getDailyAmountReceived()
{
    global $dbcon;
    $sql = "SELECT SUM(pbt.amount_paid) AS total_amount, branch_code FROM patient_blood_test pbt WHERE DATE(pbt.created_date) = CURDATE() GROUP BY branch_code";
    $stmt = $dbcon->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = [
            'branch_code' => $row['branch_code'],
            'total_amount' => $row['total_amount']
        ];
    }
    $stmt->close();

    return json_encode($rows);
}

function getDailyReportProvided()
{
    global $dbcon;
    $sql = "SELECT count(*) AS total_count, branch_code FROM patient_blood_test pbt WHERE DATE(pbt.report_provided) = CURDATE() GROUP BY branch_code";
    $stmt = $dbcon->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = [
            'branch_code' => $row['branch_code'],
            'total_count' => $row['total_count']
        ];
    }
    $stmt->close();

    return json_encode($rows);
}
