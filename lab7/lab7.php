<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lab 7</title>

    <!-- Bootstrap core CSS -->
    <link
      href="bootstrap3_defaultTheme/dist/css/bootstrap.css"
      rel="stylesheet"
    />

    <!-- Custom styles for this template -->
    <link href="css/lab7.css" rel="stylesheet" />
  </head>

  <body>
    <?php
    include "lab7-data.php";
    $servers = array('Server 1', 'Server 2', 'Server 3', 'Server 4', 'Server 5');
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div id="login">
            <div class="page-header">
              <h2>Login</h2>
            </div>
            <form role="form">

              <div class="form-group<?php if(empty($email)){echo ' has-error';}else{echo '';}?>">
                <label for="exampleInputEmail1">Email address</label>
                <?php
                echo '<input type = "email" class="form-control"
                name="email"
                value="' .$email. '">';
                ?>

                <p class="help-block"><?php if(empty($email)){echo ' Enter an Email';}else{echo '';}?></p>
              </div>
              <div class="form-group<?php if(empty($password)){echo ' has-error';}else{echo ' ';}?>">
                <label for="exampleInputPassword1">Password</label>
                <?php
                echo '<input
                type="password"
                class="form-control"
                name="password"
                value="' . $password . '"/>'
                ?>
                <p class="help-block"><?php if(empty($email) && empty($password)){echo 'Email and password not found';}else if(empty($password)){echo 'Password not found';}else{echo '';}?></p>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Server</label>
                <select name="server" class="form-control">
                  <!--Replace the following elements with PHP-->
                  <?php
                  for($i = 0; $i < count($servers);$i++){
                    echo '<option value = " >' . $i . '">' . $servers[$i] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
    <!-- end container -->

    <!-- Bootstrap core JavaScript
 ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
    <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>
  </body>
</html>
