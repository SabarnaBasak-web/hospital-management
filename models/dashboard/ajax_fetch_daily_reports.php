<?php
session_start();
require_once __DIR__ . '/../connection_string.php';
$branch_code = $_GET['branchCode'];

// daily patient blood test 
$sql = "SELECT COUNT(*) AS total_count FROM patient_blood_test pbt WHERE DATE(pbt.report_provided) = CURDATE() AND branch_code = ?";
$stmt = $dbcon->prepare($sql);
$stmt->bind_param("s", $branch_code);
$stmt->execute();
$report_provided_result = $stmt->get_result();
$report_provided_row = $report_provided_result->fetch_assoc();

// daily total amount received
$sql1 = "SELECT COALESCE(SUM(pbt.amount_paid), 0) AS total_amount FROM patient_blood_test pbt WHERE DATE(pbt.created_date) = CURDATE() AND branch_code = ?";
$stmt = $dbcon->prepare($sql1);
$stmt->bind_param("s", $branch_code);
$stmt->execute();
$total_amount_result = $stmt->get_result();
$total_amount_row = $total_amount_result->fetch_assoc();

// daily blood test count
$sql1 = "SELECT COUNT(*) AS total_count FROM patient_blood_test pbt WHERE DATE(pbt.created_date) = CURDATE() AND branch_code = ?";
$stmt = $dbcon->prepare($sql1);
$stmt->bind_param("s", $branch_code);
$stmt->execute();
$total_amount_result = $stmt->get_result();
$total_test_count = $total_amount_result->fetch_assoc();

// Monthly (current month)
$curr_year = date("Y");
$curr_month = date("m");

// monthly patient blood test (reports provided in current month)
$sql1 = "SELECT COUNT(*) AS total_count FROM patient_blood_test pbt WHERE YEAR(pbt.report_provided) = ? AND MONTH(pbt.report_provided) = ? AND branch_code = ?";
$stmt = $dbcon->prepare($sql1);
$stmt->bind_param("sss", $curr_year, $curr_month, $branch_code);
$stmt->execute();
$monthly_report_result = $stmt->get_result();
$monthly_report_row = $monthly_report_result->fetch_assoc();

// monthly total amount received
$sql1 = "SELECT COALESCE(SUM(pbt.amount_paid), 0) AS total_amount FROM patient_blood_test pbt WHERE YEAR(pbt.created_date) = ? AND MONTH(pbt.created_date) = ? AND branch_code = ?";
$stmt = $dbcon->prepare($sql1);
$stmt->bind_param("sss", $curr_year, $curr_month, $branch_code);
$stmt->execute();
$monthly_amount_result = $stmt->get_result();
$monthly_amount_row = $monthly_amount_result->fetch_assoc();

// monthly blood test count
$sql1 = "SELECT COUNT(*) AS total_count FROM patient_blood_test pbt WHERE YEAR(pbt.created_date) = ? AND MONTH(pbt.created_date) = ? AND branch_code = ?";
$stmt = $dbcon->prepare($sql1);
$stmt->bind_param("sss", $curr_year, $curr_month, $branch_code);
$stmt->execute();
$monthly_tests_result = $stmt->get_result();
$monthly_tests_row = $monthly_tests_result->fetch_assoc();

echo json_encode([
    "reportProvided"        => $report_provided_row['total_count'],
    "totalAmountReceived"   => $total_amount_row['total_amount'],
    "bloodTestCount"        => $total_test_count['total_count'],
    "monthlyReportProvided" => $monthly_report_row['total_count'],
    "monthlyAmountReceived" => $monthly_amount_row['total_amount'],
    "monthlyBloodTestCount" => $monthly_tests_row['total_count'],
]);

mysqli_close($dbcon);
