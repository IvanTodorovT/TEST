<?php

require_once 'handler.php';

$errors = [];

if (!empty($_POST)){
	
	
	$username = isset($_POST ['username']) ? $_POST ['username'] : '' ;
	$password = isset($_POST ['password']) ? $_POST ['password'] : '' ;
	

if (!validateUserName($username)){
	$errors[] = 'Invalid username!';
}

if (!validatePass($password)){
	$errors[] = 'Your password must contain at least 6 characters and at least 1 number!';
}



if (empty($errors)){
	
$getAll = $connection -> query ('SELECT * FROM users');
	
while ($single = $getAll->fetch()) {
	if ($single['username'] == $username && $single ['password'] == $password){
		header('Location profile.html');
	}
	$errors[2] = 'Invalid username or password!';
}
	
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

