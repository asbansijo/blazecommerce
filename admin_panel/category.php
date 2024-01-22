<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "navbar.html";
require_once "sidebar.html";
include "../connection.php";

if (isset($_POST['add-category']) && (isset($_FILES['category_image']))) {

    $categoryName = $_POST['category-name'];

    $imageName = $_FILES['category_image']['name'];
    $imageSize = $_FILES['category_image']['size'];
    $tmp_name = $_FILES['category_image']['tmp_name'];
    $error = $_FILES['category_image']['error'];

    if ($error === 0) {
        if ($imageSize > 1250000) {
            $_SESSION['status'] = "File is Too Big.";
        } 
        else {
           $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
           $imageActExt = strtolower($imageExt);

           $allowedExts = array("jpeg","png","jpg");
           if(in_array($imageActExt, $allowedExts)){
            $newImageName = uniqid();
            $newImageName .='.'.$imageActExt;
            $image_path = '../images/'.$newImageName;
            move_uploaded_file($tmp_name, $image_path);
             
            $stmt = "INSERT INTO category (category_name, category_image) VALUES ('$categoryName', '$image_path')";
            $result = $conn->query($stmt);
           }
        } 
    }
}

// Read - Fetch Categories
$sql = "SELECT * FROM category ORDER BY Id ASC";
$result = mysqli_query($conn, $sql);

// Edit Category
if (isset($_POST['edit-Category'])) {
    $categoryId = $_POST['edit-category-id'];
    $editCatName = $_POST['category-name'];

    // Check if the file input exists and if it's an acceptable file
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK) {
        $imageSize = $_FILES['category_image']['size'];

        if ($imageSize > 2250000) {
            $_SESSION['status'] = "File is Too Big.";
        } else {
            $imageExt = pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION);
            $imageActExt = strtolower($imageExt);
            $allowedExts = array("jpeg", "png", "jpg");

            if (in_array($imageActExt, $allowedExts)) {
                $newImageName = uniqid() . '.' . $imageActExt;
                $image_path = '../images/' . $newImageName;

                if (move_uploaded_file($_FILES['category_image']['tmp_name'], $image_path)) {
                    $stmt = $conn->prepare("UPDATE category SET category_name = ?, category_image = ? WHERE Id = ?");
                    $stmt->bind_param("ssi", $editCatName, $image_path, $categoryId);

                    if ($stmt->execute()) {
                        $_SESSION['status'] = "Category updated successfully";
                        echo "addsuccess";
                    } else {
                        $_SESSION['status'] = "Error updating category: " . $stmt->error;
                        error_log("Error updating category: " . $stmt->error);
                        echo "error";
                    }
                    // $stmt->execute();

                    $stmt->close();
                } else {
                    $_SESSION['status'] = "Error uploading the file.";
                    echo "error";
                }
            } else {
                $_SESSION['status'] = "Invalid file format. Allowed formats: JPEG, PNG, JPG.";
                echo "error";
            }
        }
    }
} else {
    echo "error";
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Cookie&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>
    <header>

        <!-- <div id="header"></div> -->

    </header>
    <main>
        <!-- side-bar -->
        <div id="side-bar"></div>
        <section class="dash-panel">
            <div class="dash-container">
                <div class="dashboard">
                    <h1 class="dash-head">Categories</h1>
                    <div class="add-category"><button id="adprobtn">Add Category<span class="material-symbols-outlined">
                                add
                            </span></button></div>
                    <!-- Add Category Modal -->
                    <div class="modal" id="my-modal">
                        <div class="bg-blur"></div>
                        <div class="category-modal">
                            <h2>ADD CATEGORY</h2>
                            <span class="close">&times;</span>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="left">
                                    <div class="upload-img-container" id="add-preview">
                                        <label id="img-upload-lable" for="img-input">
                                            <span class="material-symbols-outlined add-photo">
                                                add_a_photo
                                            </span>
                                            <p>Upload an Image</p>
                                        </label>
                                    </div>
                                    <input type="file" name="category_image" id="img-input">
                                </div>
                                <div class="right">
                                    <input type="text" name="category-name" placeholder="Category Name">
                                    <button class="add" type="submit" name="add-category">ADD</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Edit Category Modal -->
                    <div class="modal" id="edit-modal">
                           <div class="bg-blur"></div>
                           <div class="category-edit-modal">
                               <h2>EDIT CATEGORY</h2>
                               <span class="edit-close">&times;</span>
                               <form action="" method="POST" enctype="multipart/form-data">
                                   <div class="left">
                                       <div class="upload-img-container" id="edit-preview">
                                           <label id="edit-img-upload-label" for="edit-img-input">
                                               <span class="material-symbols-outlined add-photo">
                                                   add_a_photo
                                               </span>
                                               <p>Upload an Image</p>
                                           </label>
                                           <img src="" alt="Category Image" id="edit-cat-image" class="edit-cat-image">
                                       </div>
                                       <input type="file" name="category_image" id="edit-img-input">
                                   </div>
                                   <div class="right">
                                       <input type="text" name="category-name" placeholder="Category Name" id="edit-cat-name">
                                       
                                       <input type="hidden" name="edit-category-id" id="edit-category-id" value="">
                                       <button class="add" type="submit" name="edit-Category" id="edit-Category">EDIT</button>
                                   </div>
                               </form>
                           </div>
                    </div>

                    <!-- Category Table -->
                    <div class="dtl-table categories">
                        <div class="category-tab">
                            <?php
                                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                foreach ($rows as $row) {
                            ?>
                            <div class="category-cards" id="delete_id<?php echo $row['Id']; ?>">
                                <div class="card-inner-container">
                                    <div class="img-container"><img src="../images/<?= $row['category_image']?>" alt="">
                                    </div>
                                    <div class="card-head">
                                        <h3><?php echo $row['category_name']?></h3>
                                    </div>
                                    <div class="card-status">
                                        <p id="session-status">
                                            <?php if($row['category_status'] == '1'){
                                            echo 'ACTIVE';
                                        }
                                        else{
                                            echo 'INACTIVE';
                                        }
                                        ?>
                                        </p>
                                        <div class="cat-toggle">
                                            <input type="checkbox" name="category-checkbox"
                                                id="cat-active-<?php echo $row['Id']; ?>"
                                                <?php if ($row['category_status'] == '1') echo 'checked'; ?>
                                                onchange="toggleStatus('<?php echo $row['Id']; ?>')">
                                        </div>
                                    </div>
                                    <div class="edit-category">
                                        <button name="edit-cat" type="button" class="edit-cat-btn" 
                                             data-category-id="<?php echo $row['Id']; ?>"
                                             data-category-img="<?= $row['category_image'] ?>"
                                             data-category-name="<?= $row['category_name'] ?>">
                                             EDIT
                                        </button>
                                    </div>
                                    <div class="dlt-category">
                                        <form method="POST">
                                            <input type="hidden" name="category-id" value="<?= $row['Id'] ?>">
                                            <button id="delete-category" name="delete-category" type="submit"
                                                onclick="deleteCategory(<?php echo $row['Id']; ?>)">DELETE</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- delete Category with Ajax -->
    <script type="text/javascript">
        function deleteCategory(categoryId) {
            if (confirm('Are you sure you want to delete this category?')) {
                $(document).ready(function () {
                    $.ajax({
                        // URL for the action file
                        url: 'delete.php',
                        // HTTP method
                        type: 'POST',
                        // Data to be sent
                        data: {
                            delete_id: categoryId,
                            action: "delete"
                        },
                        success: function (response) {
                            if (response === 'success') {
                                alert("Data Deleted Successfully");
                                $("#delete_id" + categoryId)
                                    .remove(); // Remove the deleted category container
                            }
                        }
                    });
                });
            }
        }

        //category status
function toggleStatus(categoryId) {
    $.ajax({
        url: "update-status.php",
        type: "post",
        data: {
            categoryId: categoryId
        },
        success: function (result) {
            console.log("AJAX Response:", result);

            if (result == '1') {
                alert("Category is now ACTIVE");
                $('#cat-active-' + categoryId).prop('checked', true); // Check it
            } else if (result == '0') {
                alert("Category is now INACTIVE");
                $('#cat-active-' + categoryId).prop('checked', false); // Uncheck it
            }
        }
    });
}
    </script>

    <script>
        // Displaying Modal 

        document.addEventListener("DOMContentLoaded", function () {
            var modal = document.querySelector("#my-modal");
            var myBtn = document.querySelector("#adprobtn");
            myBtn.onclick = function () {
                modal.classList.add("visible");
            };

            var span = document.querySelector(".close");
            span.onclick = function () {
                modal.classList.remove("visible");
            };

            window.addEventListener("click", function (event) {
                if (event.target == modal) {
                    modal.classList.remove("visible");
                }
            });
        });
        
        $(document).ready(function () {
        var editModal = $("#edit-modal");

        // Edit Category with Ajax
        $(".edit-cat-btn").click(function () {
            var categoryId = $(this).data("category-id");
            var categoryImg = $(this).data("category-img");
            var categoryTitle = $(this).data("category-name");

            editModal.find("#edit-category-id").val(categoryId);
            editModal.find("#edit-cat-name").val(categoryTitle);
            editModal.find("#edit-cat-image").attr("src", "../images/" + categoryImg);

            editModal.show();
        });

        editModal.find(".edit-close").click(function () {
            editModal.hide();
        });

        $(window).click(function (event) {
            if (event.target === editModal[0]) {
                editModal.hide();
            }
        });
    });


        // category modal image preview

        document.addEventListener("DOMContentLoaded", function () {
            function handleFileInputChange(event, imagePreview) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.addEventListener('load', function () {
                        const image = new Image();

                        image.src = this.result;
                        image.addEventListener('load', function () {
                            const ratio = Math.min(
                                imagePreview.clientWidth / this.width,
                                imagePreview.clientHeight / this.height
                            );
                            this.width *= ratio;
                            this.height *= ratio;
                        });

                        // Clear previous images
                        while (imagePreview.firstChild) {
                            imagePreview.removeChild(imagePreview.firstChild);
                        }

                        imagePreview.appendChild(image);
                    });

                    reader.readAsDataURL(file);
                }
            }

            var imageUploadAdd = document.getElementById("img-input");
            var imageUploadEdit = document.getElementById("edit-img-input");
            var imagePreviewAdd = document.querySelector(".upload-img-container#add-preview");
            var imagePreviewEdit = document.querySelector(".upload-img-container#edit-preview");

            imageUploadAdd.addEventListener("change", function (event) {
                handleFileInputChange(event, imagePreviewAdd);
            });

            imageUploadEdit.addEventListener("change", function (event) {
                handleFileInputChange(event, imagePreviewEdit);
            });
        });
    </script>


    <script src="../script.js"></script>

</body>

</html>