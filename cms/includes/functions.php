<?php 

function secure() {
    if(!isset($_SESSION['id'])){
        set_message("Please login as admin first to view this page.");
        header('Location: /cms');
        die();
    }
}

function secure2() {
    if(!isset($_SESSION['id'])){
        set_message("Please login first to view posts and new feeds.");
        header('Location: /cms');
        die();
    }
}

function set_message($message){
    {
        $_SESSION['message'] = $message;
    }
}

function get_message(){
    if(isset($_SESSION['message'])){
        echo '<br> <center> <p>'. $_SESSION['message'] . '</center> </p> <hr>';
        unset($_SESSION['message']);
    }
}

?>