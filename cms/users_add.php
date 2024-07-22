<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $errors = [];

    
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } 

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } 
    
    elseif (strlen($password) <= 5) {
        $errors[] = "Password must be more than 5 characters.";
    }
 
    if (empty($errors)) {
        $hashed = sha1($password);
        if ($stm = $connect->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)')) {
            $stm->bind_param('sss', $username, $email, $hashed);
            $stm->execute();

            set_message("A new user " . $username . " has been added.");
            $stm->close();
            header('Location: index.php');
            exit();
        } 

        else 
        {
            echo 'Could not prepare statement!';
        }
    } 
     
    else {  
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
    }
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
           
            <form method="post">           
                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" required />
                    <label class="form-label" for="username">Username</label>
                </div>
                
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" required />
                    <label class="form-label" for="email">Email address</label>
                </div>

                
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" required />
                    <label class="form-label" for="password"></label>
                </div>

                
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                Already have an account ?
                <a href="index.php"> Sign In </a>
            </form>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
