<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
include('includes/header.php');

if (isset($_GET['delete'])){
    if ($stm = $connect->prepare('DELETE FROM users where id = ?')){

        $stm->bind_param('i',  $_GET['delete']);
        $stm->execute();
        
        set_message("A user " . $_GET['delete'] . " has beed deleted");
        header('Location: users.php');

        $stm->close();
        die();

    } 
    
    else {
        echo 'Could not prepare statement!';
    }

}

if ($stm = $connect->prepare('SELECT * FROM users')){

    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows >0){
        

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h1 class="display-6">Dashboard</h1>
            <a href="users.php">Users management </a>
            <table class="table table-striped table-hover">

                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Delete</th>

                  </tr>


                  <?php while($record = mysqli_fetch_assoc($result)){  ?>

                  <tr>
                      <td><?php echo $record['id']; ?></td>
                      <td><?php echo $record['username']; ?></td>
                      <td><?php echo $record['email']; ?></td>
                      <td>

                        <a href="users.php?delete=<?php echo $record['id']; ?>">Delete</a>
                      </td>
                 </tr>
        
        
                  <?php } ?> 

             </table>

             <a href="users_add.php"> Add new user</a>
       
        </div>
    </div>
</div>


<?php

  }
  
  else 
  {
    echo '<center><h3>No users found. <a href="users_add.php">Add User</a></h3></center>';
  }

  $stm->close();

} 

else
{
  echo 'Could not prepare statement!';
}


include('includes/footer.php');

?>