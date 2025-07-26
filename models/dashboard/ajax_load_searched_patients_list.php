<?php
session_start();
require_once __DIR__ . '/../connection_string.php';
require_once __DIR__ . '/./query_helper.php';
require_once __DIR__ . '/../../constants/constants.php';

$all_blood_tests = getAllBloodTests();

$searched_string = $_GET['searchedString'];
$all_patients_list = getAllPatientsEntriesByTicketNumber($searched_string);
$is_super_admin = UserRole::isSuperAdmin();


if (count($all_patients_list) == 0) {
    echo "<tr><td class='datatable-empty' colspan='13'>No records found</td></tr>";
} else {
    foreach ($all_patients_list as $field => $field_value) {
        $admin_table_details = $is_super_admin ? "<td>" . $field_value['payment'] . "</td>" : "";
        $payment_status_icon = "<td>" . ($field_value['amount_due'] == '0' && $is_super_admin ? "<i class=\"fa-solid fa-check success statusIcon\"></i>" : "<i class=\"fa-solid fa-xmark pending statusIcon\"></i>") . "</td>";
        $action_btn = $field_value['amount_due'] != '0' ? "<td class=\"text-center\"><button class=\"btn edit-icon\"><i class=\"fa-solid fa-pen\" data-bs-toggle=\"modal\" data-bs-target=\"#editPatientBloodTest\" data-id=\"" . $field_value['id'] . "\" ></i></button></td>" : "<td></td>";
        echo "<tr>
        <td>" . $field_value['id'] . "</td>
        <td>" . $field_value['ticket_number'] . "</td>
        <td>" . $field_value['test_name'] . "</td>
        <td>" . $field_value['category'] . "</td>
        <td>" . $field_value['price'] . "</td>
        <td>" . $field_value['amount_paid'] . "</td>
        <td>" . $field_value['amount_due'] . "</td>
        <td>" . $field_value['discount'] . "</td>
        <td>" . $field_value['status'] . "</td>
        <td>" . $field_value['payment_mode'] . "</td>
        $admin_table_details
        $payment_status_icon
        $action_btn
        </tr>";
    }
}
