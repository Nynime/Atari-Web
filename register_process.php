<?php
header('Content-Type: application/json');

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];
    $dateOfBirth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert registration logic here (e.g., saving to database)

    // For demonstration, we'll assume registration is always successful
    $response['success'] = true;
    $response['user'] = array(
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'phone_number' => $phoneNumber,
        'date_of_birth' => $dateOfBirth,
        'gender' => $gender,
        'username' => $username
    );
}

echo json_encode($response);

