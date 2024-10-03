<?php
session_start();
include "db_connect.php";

if (isset($_POST['username']) && isset($_POST['joiningdate'])) {  
    $username = $_POST['username'];
    $joiningdate = $_POST['joiningdate']; 
} else {
    $response['error'] = 'Missing required fields';
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

$stmt = $db->prepare("SELECT * FROM company_profiles WHERE company_id = :username AND joining_date = :joiningdate");
$stmt->execute([
    'username' => $username,
    'joiningdate' => $joiningdate
]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

    

    if (!$user) {
        $response['error'] = 'Incorrect username or Joining Date';
    } else {
                $_SESSION['username'] = $user['company_id'];
                
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

                $response['success'] = true;
                $response['redirect'] = 'users-profile.php';
                echo json_encode($response);
                exit();
    }

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
