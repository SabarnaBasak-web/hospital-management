<?php
session_start();
require_once __DIR__ . '/../connection_string.php';
require_once __DIR__ . '/./query_helper.php';
require_once __DIR__ . '/../../constants/constants.php';

$all_blood_tests = getAllBloodTests();
$all_patients_list = getAllPatientsEntries();
$is_super_admin = UserRole::isSuperAdmin();


foreach ($all_patients_list as $field => $field_value) {
    $admin_table_details = $is_super_admin ? "<td>" . $field_value['payment'] . "</td>" : "";
    $payment_status_icon = "<td>" . ($field_value['amount_due'] == '0' && $is_super_admin ? "<i class=\"fa-solid fa-check success statusIcon\"></i>" : "<i class=\"fa-solid fa-xmark pending statusIcon\"></i>") . "</td>";
    $is_not_complete = $field_value['amount_due'] != '0' || $field_value['status'] == 'pending';
    $action_btn = $is_not_complete ? "<td class=\"text-center\"><button class=\"btn edit-icon\"><i class=\"fa-solid fa-pen\" data-bs-toggle=\"modal\" data-bs-target=\"#editPatientBloodTest\" data-id=\"" . $field_value['id'] . "\" ></i></button></td>" : "<td></td>";

    echo "<tr " . ($is_not_complete ? "class='table-danger'" : "") . ">
        <td>" . $field_value['id'] . "</td>
        <td>" . $field_value['ticket_number'] . "</td>
        <td>" . $field_value['test_name'] . "</td>
        <td>" . $field_value['price'] . "</td>
        <td>" . $field_value['total_amount_paid'] . "</td>
        <td>" . $field_value['amount_due'] . "</td>
        <td>" . $field_value['discount'] . "</td>
        <td>" . $field_value['status'] . "</td>
        <td>" . $field_value['payment_mode'] . "</td>
        $admin_table_details
        $payment_status_icon
        $action_btn
    </tr>";
}
