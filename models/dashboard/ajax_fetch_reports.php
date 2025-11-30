<?php
session_start();
require_once __DIR__ . '/../connection_string.php';
$branch_code = $_GET['branchCode'];

// daily report provided count, total amount received, and blood test count
$sql = "SELECT 
    COUNT(CASE WHEN DATE(pbt.report_provided) = CURDATE() THEN 1 END) AS report_provided_count,
    COUNT(CASE WHEN DATE(pbt.created_date) = CURDATE() THEN 1 END) AS test_count
FROM patient_blood_test pbt 
WHERE branch_code = ?";
$stmt = $dbcon->prepare($sql);
$stmt->bind_param("s", $branch_code);
$stmt->execute();
$daily_result = $stmt->get_result();
$daily_row = $daily_result->fetch_assoc();

// Monthly (current month)
$curr_year = date("Y");
$curr_month = date("m");

// Combined monthly query: reports provided count, total amount received, and blood test count
$sql1 = "SELECT 
    COUNT(CASE WHEN YEAR(pbt.report_provided) = ? AND MONTH(pbt.report_provided) = ? THEN 1 END) AS monthly_report_count,
    COUNT(CASE WHEN YEAR(pbt.created_date) = ? AND MONTH(pbt.created_date) = ? THEN 1 END) AS monthly_test_count
FROM patient_blood_test pbt 
WHERE branch_code = ?";
$stmt = $dbcon->prepare($sql1);
$stmt->bind_param("sssss", $curr_year, $curr_month, $curr_year, $curr_month,  $branch_code);
$stmt->execute();
$monthly_result = $stmt->get_result();
$monthly_row = $monthly_result->fetch_assoc();


$sql2 = "SELECT SUM(p.amount) as monthly_total_amount 
         FROM payments p 
         INNER JOIN patient_blood_test pbt ON p.ticket_number = pbt.ticket_number 
         WHERE YEAR(p.created_date) = ? AND MONTH(p.created_date) = ? AND pbt.branch_code = ?";
$stmt = $dbcon->prepare($sql2);
$stmt->bind_param("sss", $curr_year, $curr_month, $branch_code);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$monthly_total_amount = $row['monthly_total_amount'] ?? 0;

$sql3 = "SELECT SUM(p.amount) as daily_total_amount 
         FROM payments p 
         INNER JOIN patient_blood_test pbt ON p.ticket_number = pbt.ticket_number 
         WHERE DATE(p.created_date) = CURDATE() AND pbt.branch_code = ?";
$stmt = $dbcon->prepare($sql3);
$stmt->bind_param("s", $branch_code);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$daily_total_amount = $row['daily_total_amount'] ?? 0;

echo json_encode([
    "reportProvided"        => $daily_row['report_provided_count'],
    "totalAmountReceived"   => $daily_total_amount,
    "bloodTestCount"        => $daily_row['test_count'],
    "monthlyReportProvided" => $monthly_row['monthly_report_count'],
    "monthlyAmountReceived" => $monthly_total_amount,
    "monthlyBloodTestCount" => $monthly_row['monthly_test_count'],
]);

mysqli_close($dbcon);
