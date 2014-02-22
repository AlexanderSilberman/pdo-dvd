<?php
require __DIR__ . '/vendor/autoload.php';
use Symfony\Component\HttpFoundation\Session\Session;



$session=new Session();
$session->start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body bgcolor="#000000">

<div style="background-color:#993333;font:20px;font:Arial, Helvetica, sans-serif;padding:10px;width:200px;border:#FFFFFF dashed thin;margin:50px">
<?php foreach ($session->getFlashBag()->get('statusMessage', array()) as $message) {
  echo '<div class="flash-warning">'.$message.'</div>'; }?>
<form method="post" action="login-process.php">
  <strong>Username:</strong> <input name="username" type="text"><br /> <br />

<strong>Password:</strong> <input name="password" type="text"><br />
<input type="submit" value="Log In">

</form>
</div>
</body>
</html>