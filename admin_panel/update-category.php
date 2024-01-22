<?php //update-category.php
session_start();

include "../connection.php";

// if (isset($_POST['edit-Category'])) {
//     $categoryId = $_POST['edit-category-id'];
//     $editCatName = $_POST['category-name'];

//     // Check if the file input exists and if it's an acceptable file
//     if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
//         $imageSize = $_FILES['category_image']['size'];

//         if ($imageSize > 1250000) {
//             $_SESSION['status'] = "File is Too Big.";
//         } else {
//             $imageExt = pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION);
//             $imageActExt = strtolower($imageExt);
//             $allowedExts = array("jpeg", "png", "jpg");

//             if (in_array($imageActExt, $allowedExts)) {
//                 $newImageName = uniqid() . '.' . $imageActExt;
//                 $image_path = '../images/' . $newImageName;

//                 if (move_uploaded_file($_FILES['category_image']['tmp_name'], $image_path)) {
//                     $stmt = $conn->prepare("UPDATE category SET category_name = ?, category_image = ? WHERE Id = ?");
//                     $stmt->bind_param("ssi", $editCatName, $image_path, $categoryId);

//                     if ($stmt->execute()) {
//                         $_SESSION['status'] = "Category updated successfully";
//                         echo "success";
//                     } else {
//                         $_SESSION['status'] = "Error updating category: " . $stmt->error;
//                         error_log("Error updating category: " . $stmt->error);
//                         echo "error";
//                     }
//                     // $stmt->execute();

//                     $stmt->close();
//                 } else {
//                     $_SESSION['status'] = "Error uploading the file.";
//                     echo "error";
//                 }
//             } else {
//                 $_SESSION['status'] = "Invalid file format. Allowed formats: JPEG, PNG, JPG.";
//                 echo "error";
//             }
//         }
//     }
// } else {

//     echo "error";
// }



?>