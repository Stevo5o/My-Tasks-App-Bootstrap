<!-- register.php -->
<?php
if (isset($_POST['register_submit'])) {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $email = $_POST['email'];
   $username = $_POST['username'];
   $password = $_POST['password'];
   $password2 = $_POST['password2'];
   $errors = array();

   // password check
   if ($password != $password2) {
      $errors[] = "no password match";
   }

   // check first name
   if (empty($first_name)) {
      $errors[] = "no first name";
   }
   // check email
   if (empty($email)) {
      $errors[] = "no email";
   }
   // check username
   if (empty($username)) {
      $errors[] = "no username";
   }
   // match passwords
   if (empty($password)) {
      $errors[] = "no password";
   }

   $database = new DB;

   // query
   $database->query('SELECT username FROM users WHERE username = :username');
   $database->bind(':username', $username);

   // execute
   $database->execute();
   if ($database->rowCount() > 0) {
      $errors[] = "Nope, username taken";
   }

   // check eamil is in use
   $database->query('SELECT username FROM users WHERE email = :email');
   $database->bind(':email', $email);
   // execute
   $database->execute();
   if ($database->rowCount() > 0) {
      $errors[] = "Nope, email taken";
   }
   if (empty($errors)) {
      //encrypt password
      $enc_password = md5($password);

      // query
      $database->query('INSERT INTO users (first_name,last_name,email,username,password)
		VALUES(:first_name,:last_name,:email,:username,:password)');

      // bind values
      $database->bind(':first_name', $first_name);
      $database->bind(':last_name', $last_name);
      $database->bind(':email', $email);
      $database->bind(':username', $username);
      $database->bind(':password', $enc_password);

      // execute
      $database->execute();

      // if row was inserted
      if ($database->lastInsertId()) {
         echo '<p class="msg">Registered! Login</p>';
      } else {
         echo '<p class="error">Sorry wrong</p>';
      }
   }
}
?>
<h3>Register</h3>
<p>Please use form below</p>
<?php
if (!empty($errors)) {
   echo "<ul>";
   foreach ($errors as $error) {
      echo "<li class=\"error\">" . $error . "</li>";
   }

   echo "</ul>";
}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
   <label>First Name: </label>
   <input type="text" name="first_name" /><br />
   <label>Last Name: </label>
   <input type="text" name="last_name" value="" /><br>
   <label>Email: </label>
   <input type="email" name="email" value="" /><br />
   <label>Username: </label>
   <input type="text" name="username" value="" /><br />
   <label>Password: </label>
   <input type="password" name="password" value="" /><br />
   <label>Confirm Password: </label>
   <input type="password" name="password2" value=""/><br />
   <br>
   <input type="submit" value="Register" name="register_submit" />
</form>