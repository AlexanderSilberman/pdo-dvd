<?php

require __DIR__ . '/vendor/autoload.php';
require_once 'db.php';


use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

$request = Request::createFromGlobals();

use ITP\Authenticate\Auth as Auth;





date_default_timezone_set('UTC');

$session=new Session();
$session->start();
//If the person was logged in before and they come directly here send them to the dashboard
if($session->get('loggedin')=='yes' && $username=$request->request->get('username')==''){
	$response = new RedirectResponse('dashboard.php');
	return $response->send();
}

//If the person isn't logged in and tries to go directly to this page send them to the login page.
if(($session->get('loggedin')=='no' && $username=$request->request->get('username')=='') || ($session->get('loggedin')=='' && $username=$request->request->get('username')=='')){
	$response = new RedirectResponse('login.php');
	return $response->send();
}

//Get the username and password from login.php
$username=$request->request->get('username');
$password=$request->request->get('password');
$password=SHA1($password);


//Check if the username and password were valid.
$auth = new Auth($pdo);
$attempt=$auth->attempt($username, $password);
$email=$auth->getEmail();


//if valid information
if($attempt){
	//$date = new DateTime();
	
	$session->set('user',$username);
	$session->set('loggedin', 'yes');
	$session->set('email',$email);
	$session->set('date',date('U'));
	$session->getFlashBag()->set('statusMessage', 'You have successfully logged in!');
	$response = new RedirectResponse('dashboard.php');
	return $response->send();
	
}

//if not send back to login.php
else{
	$session->getFlashBag()->set('statusMessage', 'Invalid Credentials!');
	$response = new RedirectResponse('login.php');
	return $response->send();
}

?>