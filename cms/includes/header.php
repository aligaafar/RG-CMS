<?php

  if (isset($_SESSION['id']))
  {
    $signin_text = 'Sign Out';
  } 

  else 
  {
    $signin_text = 'Sign In';
  }

?>

<!DOCTYPE html>
<html>

<head>
<title>CMS</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="css/footer.css" />
</head>

<body>
   
  <nav class="navbar navbar-expand-lg" style="background-color: rgba(211, 211, 250, 0.2);">
    <div class="container-fluid">
  
    <a class="navbar-brand" href="#" style="color: blue;">
      <img src="https://scontent.fcai19-2.fna.fbcdn.net/v/t39.30808-6/313079332_482135850616010_8328365407576771098_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=a5f93a&_nc_ohc=YfLC7CBC9UwQ7kNvgFpE-0D&_nc_ht=scontent.fcai19-2.fna&oh=00_AYDczLKztv7eipqE-_jIO-bavQmv1KXEkwvltRxfuty9FA&oe=66A2A62E" alt="" style="max-width: 70px; height: 50px;">
    </a>

    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Admin Dashboard</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="posts.php">New Feeds</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php"><?php echo $signin_text ?></a>
        </li>

      </ul>

    </div>

  </div>
</nav>