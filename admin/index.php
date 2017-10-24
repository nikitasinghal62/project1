<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['userSession'])!="") {
  header("Location: dashboard.php");
  exit;
}
    if (isset($_POST['btn-login'])) {
    
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        
        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);
        
        $result = mysqli_query($conn,"SELECT * FROM tb_login WHERE username='$username' ");
       
        $row=mysqli_fetch_assoc($result);
        $count=mysqli_num_rows($result); // if username/password are correct returns must be 1 row
        
        if ( $password==$row['password'] && $count==1) {
            $_SESSION['userSession'] = $row;        
            header("Location: dashboard.php");
        } else {
            $msg = "<div class='alert alert-danger'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
            </div>";
        }
       mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

  

    

    <!-- Custom Fonts -->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-signin" method="post" id="login-form">
                        <?php
                  if(isset($msg)){
                   echo $msg;
                  }
                  ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg btn-block" name="btn-login" id="btn-login">
                                Sign In
                                </button> 

                                </div>
                             <!--    <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

   

</body>

</html>
