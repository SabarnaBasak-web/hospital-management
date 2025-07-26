<?php
session_start();
require_once __DIR__ . '/../connection_string.php';
require_once __DIR__ . '/./query_helper.php';

$searched_string = $_GET['searchedString'];

$all_blood_tests = getAllBloodTestsByTestName($searched_string);

if (count($all_blood_tests) == 0) {
    echo "<tr><td class='datatable-empty' colspan='9'>No records found</td></tr>";
} else {
    foreach ($all_blood_tests as $field => $field_value) {
        echo "<tr>
        <td>" . $field_value['id'] . "</td>
        <td>" . $field_value['test_name'] . "</td>
        <td>" . $field_value['test_code'] . "</td>
        <td>" . $field_value['code'] . "</td>
        <td>" . $field_value['department_name'] . "</td>
        <td>" . $field_value['price_rate'] . "</td>
        <td>" . $field_value['sale_rate'] . "</td>
        <td>" . $field_value['payment'] . "</td>
        <td class=\"text-center\"><button class=\"btn edit-BloodTest\" data-bs-toggle=\"modal\" data-bs-target=\"#editBloodTest\" data-id=\"" . $field_value['id'] . "\"><i class=\"fa-solid fa-pen\"></i></button></td>
        </tr>";
    }
}
