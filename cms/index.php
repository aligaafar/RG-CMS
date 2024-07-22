<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

if(isset($_SESSION['id'])){
    header('Location: dashboard.php');
    die();
}

include('includes/header.php');

if (isset($_POST['email'])) {
    if ($stm = $connect->prepare('SELECT * FROM users WHERE email = ? AND password = ?')){

        $hashed = SHA1($_POST['password']);
        $stm->bind_param('ss', $_POST['email'], $hashed);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user){
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];

            set_message("You have succesfully logged in " . $_SESSION['username']);
            header('Location: posts.php');
            die();
        }

        $stm->close();

    } 
    
    else
    {
        echo 'Could not prepare statement.';
    }
}

?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="password" id="password"  name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>
           
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                Don't have an account? <a href="users_add.php"> Register Here</a>
                
            </form>
        </div>
    </div>
</div>


<?php get_message();?>

<?php include('includes/footer.php');?>