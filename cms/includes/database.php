<?php 

$connect = mysqli_connect('localhost', 'cms', 'cms','cms');

if (mysqli_connect_errno()){
    exit('Database Connection Failed' . mysqli_connect_error());
}

?>