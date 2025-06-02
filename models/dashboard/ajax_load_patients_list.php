<?php
session_start();
require_once __DIR__ . '/../connection_string.php';
require_once __DIR__ . '/./query_helper.php';
$all_blood_tests = getAllBloodTests();
$all_patients_list = getAllPatientsEntries();

foreach ($all_patients_list as $field => $field_value) {
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
        <td class=\"text-center\"><button class=\"btn\"><i class=\"fa-solid fa-pen\"></i></button></td>
    </tr>";
}
