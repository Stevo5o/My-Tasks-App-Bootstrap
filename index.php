<?php
// session start
session_start();

require 'config.php';
// database class
require 'classes/DB.php';

$database = new DB;

?>

<?php
// login
if (isset($_POST['login_submit'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];
   $enc_password = md5('$password');

   // query
   $database->query("SELECT * FROM users WHERE username = :username AND password = :password");
   $database->bind(':username', $username);
   $database->bind(':password', $enc_password);
   $rows = $database->resultset();
   $count = count($rows);
   if ($count > 0) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      $_SESSION['logged_in'] = 0;
   } else {
      $login_msg[] = 'Sorry, that login does not work';
   }
}

// log out
if(isset($POST['logout_submit'])) {
   if(isset($_SESSION['username']))
      unset ($_SESSION['username']);
   if(isset($_SESSION['password']))
      unset ($_SESSION['password']);
   if(isset($_SESSION['logged_in']))
      unset ($_SESSION['logged_in']);
   session_destroy();
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
      <title>SteJ Tasks</title>

      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <style>
         body {
            padding-top: 70px;
            /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
         }
      </style>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <!-- Navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#">SteJ Tasks</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <?php if(isset($_SESSION['logged_in'])) : ?>
               Hello, <?php echo $_SESSION['username']; ?>
               <?php endif; ?>
               <ul class="nav navbar-nav">
                  <li>
                     <a href="index.php">Home</a>
                  </li>
                  <li>
                     <a href="index.php?page=register">Register</a>
                  </li>
                  <li>
                     <a href="#">Add List</a>
                  </li>
                  <li>
                     <a href="#">Add Task</a>
                  </li>
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container -->
      </nav>

      <div class="container-fluid">
         <div class="row-fluid">
            <div class="span3">
               <div class="well side-nav">
                  <div style="margin:0 0 10px 10px;">
                     <!-- SIDEBAR -->
                     <h3>Login Form</h3>
                     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                        <?php if (!isset($_SESSION['logged_in'])) : ?>
                           <?php 
                           foreach ($login_msg as $msg) : ?>
                              <?php echo $msg . '<br>'; ?>
                           <?php endforeach; ?>
                           <label>Username: </label>
                           <input type="text" name="username" /><br />
                           <label>Password: </label>
                           <input type="password" name="password" /><br />
                           <input type="submit" value="login" name="login_submit" />
                        <?php else : ?>
                           <input type="submit" value="Logout" name="logout_submit" />
                        <?php endif; ?>
                     </form>
                  </div>
               </div> <!-- .well -->
            </div> <!-- span -->

            <div class="span9">
               <!-- MAIN -->
               <?php
               if (isset($_GET['page'])) {
                  if ($_GET['page'] == 'welcome' || $_GET['page'] == "") {
                     include 'pages/welcome.php';
                  } elseif ($_GET['page'] == 'list') {
                     include 'pages/list.php';
                  } elseif ($_GET['page'] == 'task') {
                     include 'pages/task.php';
                  } elseif ($_GET['page'] == 'new_task') {
                     include 'pages/new_task.php';
                  } elseif ($_GET['page'] == 'new_list') {
                     include 'pages/new_list.php';
                  } elseif ($_GET['page'] == 'edit_list') {
                     include 'pages/edit_list.php';
                  } elseif ($_GET['page'] == 'register') {
                     include 'pages/register.php';
                  }
               }
               ?>
            </div> <!-- span -->
         </div> <!-- row -->
         <!-- Page Content -->
         <div class="container">

            <div class="row">
               <div class="col-lg-12 text-center">
                  <h1>A Bootstrap Starter Template</h1>
                  <p class="lead">Complete with pre-defined file paths that you won't have to change!                   </p>
                  <p> Bootstrap v3.3.1 <br>
                     Query v2.1.3</p>

               </div>
            </div>
            <!-- /.row -->

            <!-- /.container -->
         </div> <!-- fluid-container -->
         <div id="footer">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 text-center">
                     <p class="muted credit">&copy; <a href="">StephCake</a></p>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <!-- jQuery Version 1.11.1 -->
      <script src="js/jquery.js"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>

   </body>

</html>
