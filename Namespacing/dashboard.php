<?php

require __DIR__ . '/vendor/autoload.php';
require_once 'db.php';

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

use Carbon\Carbon;

$request = Request::createFromGlobals();

use ITP\SongQuery\SongQuery as Query;


date_default_timezone_set('UTC');

$session=new Session();
$session->start();
if($session->get('loggedin')=='no'){
	$response = new RedirectResponse('login.php');
	return $response->send();
}

foreach ($session->getFlashBag()->get('statusMessage', array()) as $message) {
    echo '<div class="flash-warning">'.$message.'</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    
   <style>
   		.infobox{
			background-color:#933;
			border:#FFFFFF thin dashed;
			padding:20px;
			font-family:Arial, Helvetica, sans-serif;
			font-weight:300;
		}
   
   </style>
</head>
<body bgcolor="#000000">
<div style="width:800px;margin:auto">
<div style="float:right">
<?php

echo "<div class='infobox'>";
echo "Username: " . $session->get('user');
echo '<br />';
echo "Password: " . $session->get('email'). "<br />";
$dt= Carbon::createFromTimeStamp($session->get('date'));
$dif=$dt->diffInMinutes(Carbon::now());
printf("Last Login: " . Carbon::now()->subMinutes($dif)->diffForHumans());

echo '<br /><a href="logout.php">Logout</a>';
echo "</div>";

$songQuery = new ITP\Songs\SongQuery($pdo);
$songs = $songQuery
    ->withArtist()
    ->withGenre()
    ->orderBy('title')
    ->all();
//var_dump($songs);


?>
</div>
<br /> <br /><br />
<div>
<table border="2px" style="background-color:#FFF">
<?php foreach ($songs as $song) : ?>
	<tr><td style="color:#00F"> <?php echo $song["title"]; ?> </td><td style="color:#396"> <?php echo $song["artist_name"]; ?> </td><td style="color:#F00"> <?php echo $song["genre"]; ?></td>
    <td style="color:#60F"><?php echo $song["price"]; ?>  </td></tr>
	<?php endforeach; ?>

</table>
</div>
</div>
</body>
</html>