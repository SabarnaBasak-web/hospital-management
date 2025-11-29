<?php
session_start();
require_once __DIR__ . '/../connection_string.php';
$branch_code = $_GET['branchCode'];

// daily report provided count, total amount received, and blood test count
$sql = "SELECT 
    COUNT(CASE WHEN DATE(pbt.report_provided) = CURDATE() THEN 1 END) AS report_provided_count,
    COALESCE(SUM(CASE WHEN DATE(pbt.modified_date) = CURDATE() THEN pbt.amount_paid ELSE 0 END), 0) AS total_amount,
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
    COALESCE(SUM(CASE WHEN YEAR(pbt.modified_date) = ? AND MONTH(pbt.modified_date) = ? THEN pbt.amount_paid ELSE 0 END), 0) AS monthly_total_amount,
    COUNT(CASE WHEN YEAR(pbt.created_date) = ? AND MONTH(pbt.created_date) = ? THEN 1 END) AS monthly_test_count
FROM patient_blood_test pbt 
WHERE branch_code = ?";
$stmt = $dbcon->prepare($sql1);
$stmt->bind_param("sssssss", $curr_year, $curr_month, $curr_year, $curr_month, $curr_year, $curr_month, $branch_code);
$stmt->execute();
$monthly_result = $stmt->get_result();
$monthly_row = $monthly_result->fetch_assoc();

echo json_encode([
    "reportProvided"        => $daily_row['report_provided_count'],
    "totalAmountReceived"   => $daily_row['total_amount'],
    "bloodTestCount"        => $daily_row['test_count'],
    "monthlyReportProvided" => $monthly_row['monthly_report_count'],
    "monthlyAmountReceived" => $monthly_row['monthly_total_amount'],
    "monthlyBloodTestCount" => $monthly_row['monthly_test_count'],
]);

mysqli_close($dbcon);
