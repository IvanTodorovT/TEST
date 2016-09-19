<?php

require_once 'handler.php';

$errors = [];

if (!empty($_POST)){
	
	$email = isset($_POST ['email']) ? $_POST ['email'] : '' ;
	$username = isset($_POST ['username']) ? $_POST ['username'] : '' ;
	$password = isset($_POST ['password']) ? $_POST ['password'] : '' ;
	$confirm = isset($_POST ['confirm']) ? $_POST ['confirm'] : '' ;
	$firstname = isset($_POST ['firstname']) ? $_POST ['firstname'] : '' ;
	$lastname = isset($_POST ['lastname']) ? $_POST ['lastname'] : '' ;
	

if (!validateUserName($username)){
	$errors[] = 'Invalid username!';
}

if (!validatePass($password)){
	$errors[] = 'Your password must contain at least 6 characters and at least 1 number!';
}

if (!validateMail($email)){
	$errors[] = 'You forgot to enter your email or you entered an invalid email format!';
}

if (!validateConfirm($password, $confirm)){
	$errors[] = 'Password do not match!';
}

if (!validateNames($firstname)){
	$errors[] = 'Forgot to enter first name / Only letters and white space allowed!';
}

if (!validateNames($lastname)){
	$errors[] = 'Forgot to enter last name / Only letters and white space allowed!';
}


if (empty($errors)){
	
	$prepare = $connection -> prepare ('INSERT INTO users(username,password,firstname,lastname,email) 
			VALUES (:username, :password, :firstname, :lastname, :email)');
	
	$prepare -> execute (array(
			':username' -> $username,
			':password' -> $password,
			':firstname' ->$firstname,
			':lastname' -> $lastname,
			':email' -> $email,
	));
	$id = $connection ->lastInsertId('id');
	
}
}

function validateUserName($username){
	if (empty($username)){
		return false;
	}
}


function validatePass($pass){
  if (strlen($pass <= '6') ){
        return false;
        }
        
        elseif (!preg_match("#[0-9]+#",$pass)) {
        	return false;
        }
}


function validateMail($email){
	
	if (empty($email)) {
		return false;
	} 	
		elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			return false;
		}
	}
	
	
function validateConfirm($password, $confim){
	if ($password != $confim){
		return false;
	}
}

function validateNames($name){
	
	if (empty($name)){
		return false;
	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			return false;
	}
}
