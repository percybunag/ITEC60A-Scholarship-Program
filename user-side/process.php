<?php
// Function to insert data into database
function insertData($user_data) {
    include 'db_connection.php';

    $conn->begin_transaction();

    try {
        $estatus = $_POST['educationalstatus'];
        $gwa = $_POST['gwa'];
        $schoolname = $_POST['schoolname'];

        $sql = "INSERT INTO application_info (application_type, user_id, applicant_gwa, applicant_school, applicant_level) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $application_type = 'gov';
        $stmt->bind_param("sisss", $application_type, $user_data['user_id'], $gwa, $schoolname, $estatus);

        $stmt->execute();
        $conn->commit();

        $stmt->close();
    } catch (Exception $e) {
        $conn->rollback();
        echo "Failed to insert data: " . $e->getMessage();
    }

    $conn->close();
}

if (isset($_POST['submit'])) {
    insertData($user_data);
}
?>
