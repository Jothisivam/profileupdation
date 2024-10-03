<?php
session_start();
include "db_connect.php"; 

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['username']; 

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $fileTmpPath = $_FILES['profile_image']['tmp_name'];
        $fileName = $_FILES['profile_image']['name'];
        $uploadFileDir = 'assets/img/';
        $dest_path = $uploadFileDir . $fileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $stmt = $db->prepare("UPDATE company_profiles SET photo = :photo WHERE company_id = :company_id");
            $stmt->execute([
                'photo' => $dest_path,
                'company_id' => $user_id
            ]);

            $response['newImagePath'] = $dest_path; 
        } else {
            $response['error'] = 'Error moving the uploaded file.';
        }
    }

    $fullName = $_POST['fullName'];
    $dob = $_POST['dob'];
    $job = $_POST['job'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $db->prepare("UPDATE company_profiles SET 
        fullname = :fullname, 
        dob = :dob, 
        job_role = :job_role,
        state_id = :state_id,
        district_id = :district_id,
        address = :address,
        postal_code = :postal_code,
        phone_number = :phone_number,
        email = :email
        WHERE company_id = :company_id");

    $stmt->execute([
        'fullname' => $fullName,
        'dob' => $dob,
        'job_role' => $job,
        'state_id' => $state,
        'district_id' => $district,
        'address' => $address,
        'postal_code' => $postcode,
        'phone_number' => $phone,
        'email' => $email,
        'company_id' => $user_id
    ]);

    $response['success'] = true;
}
echo json_encode($response);
?>
