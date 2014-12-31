<!-- register.php -->
<?php
if($_POST['register_submit']) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$errors = array();

	// password check
	if($password != $password2) {
		$errors[] = "no password match";
	}

	// check first name
	if(empty($first_name)) {
		$errors[] = "no first name";
	}
	// check email
	if(empty($email)) {
		$errors[] = "no email";
	}
	// check username
	if(empty($username)) {
		$errors[] = "no username";
	}
	// match passwords
	if(empty($password)) {
		$errors[] = "no password";
	}

	$DB = new DB;

	// query
	$DB->query('SELECT username FROM users WHERE username = :username');
	$DB->bind(':username', $username);

	// execute
	$DB->exceute();
	if($DB->orwCount() > 0) {
		$error[] = "Nope, username taken";
	}

	// check eamil is in use
	$DB->query('SELECT username FROM users WHERE email = :email');
	$DB->bind(':email', $email);

	// execute
	$DB->exceute();
	if($DB->orwCount() > 0) {
		$error[] = "Nope, email taken";
	}

	if(empty($errors)) {
		//encrypt password
		$enc_password = md5($password);
	}

	// query
	$DB->query('INSERT INTO users (first_name,last_name,username,password
		VALUES(:first_name,:last_name,:email,:username,:password)');

	// bind values
	$DB->bind(':first_name', $first_name);
	$DB->bind(':last_name', $last_name); 
	$DB->bind(':email', $email);
	$DB->bind(':username', $username);
	$DB->bind(':password', $enc_password);

	// execute
	$DB->execute();	
		
	// if row was inserted
	if($DB->lastInsertId()) {
		echo '<p class="msg">Registered! Login</p>';
	}
	else {
		echo '<p class="error">Sorry wrong</p>';
	}
}
?>

<h3>Register</h3>
<p>Plase use form below</p>
<?php
?>