<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

secure();

function isAdminUser() {
    return isset($_SESSION['email']) && $_SESSION['email'] === 'gaafar@mail.com';
}

if (!isAdminUser()) {
    header('Location: access_denied.php');
    exit();
}

include('includes/header.php');

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <h1 class="display-4" style="margin-left:13px">Dashboard</h1>
            <a href="users.php">Users Management</a> | 
            <a href="posts.php">Posts Management</a>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>