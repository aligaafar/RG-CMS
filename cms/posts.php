<?php
include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure2();

include('includes/header.php');

$isGaafar = ($_SESSION['email'] === 'gaafar@mail.com');


if (isset($_GET['delete'])) {
    $postId = $_GET['delete'];
    $authorId = getPostAuthorId($postId);
    
    if ($isGaafar || $authorId === $_SESSION['id']) { 
        if ($stm = $connect->prepare('DELETE FROM posts WHERE id = ?')) {
            $stm->bind_param('i', $postId);
            $stm->execute();

            set_message("Post with ID " . $postId . " has been deleted.");
            header('Location: posts.php');
            $stm->close();
            die();
        } else {
            echo 'Could not prepare statement!';
        }
    } else {
        set_message("You are not authorized to delete this post.");
        header('Location: posts.php');
        die();
    }
}


if (isset($_GET['edit'])) {
    $postId = $_GET['edit'];
    $authorId = getPostAuthorId($postId);
    
    if ($isGaafar || $authorId === $_SESSION['id']) {
        
        header('Location: edit_post.php?id=' . $postId);
        die();
    } else {
        set_message("You are not authorized to edit this post.");
        header('Location: posts.php');
        die();
    }
}

function getPostAuthorUsername($postId) {
    global $connect;
    if ($stm = $connect->prepare('SELECT users.username FROM posts INNER JOIN users ON posts.author = users.id WHERE posts.id = ?')) {
        $stm->bind_param('i', $postId);
        $stm->execute();
        $result = $stm->get_result();
        if ($result->num_rows === 1) {
            $record = $result->fetch_assoc();
            return $record['username'];
        }
    }
    return null;
}

function getPostAuthorId($postId) {
    global $connect;
    if ($stm = $connect->prepare('SELECT author FROM posts WHERE id = ?')) {
        $stm->bind_param('i', $postId);
        $stm->execute();
        $result = $stm->get_result();
        if ($result->num_rows === 1) {
            $record = $result->fetch_assoc();
            return $record['author'];
        }
    }
    return null;
}


if ($stm = $connect->prepare('SELECT posts.id, posts.title, posts.content, users.username FROM posts INNER JOIN users ON posts.author = users.id')) {

    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows > 0) {
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="display-6">New feeds</h1>

            <table class="table table-striped table-hover">
                <tr>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                <?php while($record = mysqli_fetch_assoc($result)){ ?>
                <tr>
                    <td><?php echo $record['username']; ?></td>
                    <td><?php echo $record['title']; ?></td>
                    <td><?php echo $record['content']; ?></td>
                    <td>
                        <?php if ($_SESSION['username'] === $record['username'] || $isGaafar) { ?>
                            <div class="btn-group" style="margin-bottom: 10px;">
                            <a href="posts.php?delete=<?php echo $record['id']; ?>" class="btn btn-danger">Delete</a>
                            <br>
                            <a href="posts.php?edit=<?php echo $record['id']; ?>" class="btn btn-primary">Edit</a>
                            <div>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>

            <a href="posts_add.php" class="btn btn-success">Add new post</a>
        </div>
    </div>
</div>

<br>

<?php

    } 
    
    else {
        echo '<center><h3>No posts found. <a href="posts_add.php">Add Post</a></h3></center>';
    }
    
    $stm->close();

} 

else {
    echo 'Could not prepare statement!';
}

?>

</body>
</html>
