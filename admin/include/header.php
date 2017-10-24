<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if (!isset($_SESSION['userSession'])) {
    header("Location: index.php");
    exit();
}
?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="favicon.ico">

      <title>Admin</title>

      <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/font-awesome.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="css/jquery.tag-editor.css">

    </head>

    <body>

      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="#menu-toggle" class="navbar-brand" id="menu-toggle"><i class="fa fa-bars "></i></a>
            <a class="navbar-brand" href="./dashboard.php">Admin</a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-circle "></i>
                <?php echo ucfirst($_SESSION['userSession']['username']); ?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="logout.php?logout">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
     <div id="wrapper">

          <!-- Sidebar -->
         <?php include('sidebar.php'); ?>
          <!-- /#sidebar-wrapper -->


          <!-- Page Content -->
          <div id="page-content-wrapper">