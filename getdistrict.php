<?php
include 'db_connect.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['state_cd'])) {
        $selectedCategory = $_POST['state_cd'];
        $designationSql = $db->prepare("SELECT district_id, district_name
                                       FROM districts
                                       WHERE state_id = :for_cd
                                       ORDER BY district_name ASC");
        $designationSql->bindParam(':for_cd', $selectedCategory, PDO::PARAM_INT);
        $designationSql->execute();
        $designationData = $designationSql->fetchAll(PDO::FETCH_ASSOC);

        $options = "";
        foreach ($designationData as $designation) {
            $options .= "<option value='" . $designation['district_id'] . "'>" . $designation['district_name'] . "</option>";
        }
        echo $options;
    } else {
        echo "Invalid request";
    }
} else {
    echo "Invalid request method";
}
?>