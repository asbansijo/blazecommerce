<?php


include "../connection.php";

$sql = "SELECT * FROM users ORDER BY Id ASC";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="../styles.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Cookie&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div id="header"></div>
    </header>
    <main>
        <!-- side-bar -->
        <div id="side-bar"></div>

        <section class="dash-panel">
            <div class="dash-container">
                <div class="dashboard">
                    <h1 class="dash-head">USERS</h1>
                    <div class="dtl-table user-chart">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>UserType</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                               while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['username']?></td>
                                    <td><?php echo $row['email']?></td>
                                    <td><?php echo $row['role']?></td>
                                    <td><button class="edit-user">Edit</button></td>
                                </tr>
                            <?php
                               }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>            
    </main>
    <script>
        $(function () {
            $("#header").load("navbar.html");
            $("#side-bar").load("sidebar.html");
        });
    </script>
    <script src="/script.js"></script>
</body>
</html>