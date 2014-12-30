<?php include 'config.php';?>
<?php include 'classes/DB.php'; ?>
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
                  </div>
               </div> <!-- .well -->
            </div> <!-- span -->
            
            <div class="span9">
               <!-- MAIN -->
                    <?php 
            if($_GET['page'] == 'welcome' || $_GET['page'] == "") {
            	include 'pages/welcome.php';
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
