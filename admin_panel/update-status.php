<?php
session_start();
include "../connection.php";

if (isset($_POST['categoryId'])) {
    $categoryId = $_POST['categoryId'];

    // Fetch the current status from the database
    $sql = "SELECT category_status FROM category WHERE Id = $categoryId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $currentStatus = $row['category_status'];

        // Toggle the status
        $newStatus = ($currentStatus == '1') ? '0' : '1';

        // Update the status in the database
        $updateSql = "UPDATE category SET category_status = '$newStatus' WHERE Id = $categoryId";
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            echo $newStatus; // Return the new status to the JavaScript
            exit;
        } else {
            echo 'error';
            exit;
        }
    }
}

echo 'error';
exit;
?>
