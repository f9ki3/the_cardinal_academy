<?php
include 'session_login.php';
include '../db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Attendance Records</title>
    <?php include 'header.php' ?>
    <style>
        .rounded-circle:hover{
            background-color:rgb(240, 249, 255) !important;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-row bg-light">
        <?php include 'navigation.php' ?>

        <div class="content flex-grow-1">
            <?php include 'nav_top.php' ?>

            <div class="container my-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="container my-4">
                            <div class="row mb-3">
                                <div class="col-12 col-md-5">
                                    <h4>My Profile</h4>
                                    <p>You may now view or update your information here.</p>
                                </div>

                            </div>


                            </div> 
                            <?php
                                $alert_message = '';
                                $alert_type = '';

                                if (isset($_GET['success'])) {
                                    switch ($_GET['success']) {
                                        case 'archived':
                                            $alert_message = 'The class has been archived.';
                                            $alert_type = 'danger';
                                            break;
                                        case 'unarchived':
                                            $alert_message = 'The class has been successfully restored.';
                                            $alert_type = 'success';
                                            break;
                                        case '2':
                                            $alert_message = 'Change password successfully.';
                                            $alert_type = 'success';
                                            break;
                                        case 'updated':
                                            $alert_message = 'The information has been updated.';
                                            $alert_type = 'success';
                                            break;
                                        case '5':
                                            $alert_message = 'The class has been deleted.';
                                            $alert_type = 'danger';
                                            break;
                                    }
                                }
                            ?>
                            
                            <?php if (!empty($alert_message)): ?>
                                <div class="alert alert-<?= $alert_type; ?> rounded rounded-4 alert-dismissible fade show" role="alert">
                                    <?= $alert_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <?php include 'profile_info.php'?>
                        
                            </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>