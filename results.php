<?php

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$pass = 'ttrojan';

$title=$_GET['title']; //$_REQUEST[‘artist’]

$pdo= new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

$sql = "
SELECT title, rating, genre, format
FROM dvd_titles
INNER JOIN ratings ON dvd_titles.rating_id=ratings.id
INNER JOIN genres ON dvd_titles.genre_id=genres.id
INNER JOIN formats ON dvd_titles.format_id=formats.id
WHERE title= ?
ORDER BY title DESC
";

$statement = $pdo->prepare($sql);

$like = '%'.$title.'%';
$statement->bindParam(1, $like);

$statement->execute();
$dvds=$statement->fetchAll(PDO::FETCH_OBJ);

//var_dump($songs);

?>
You searched for '<?php $title ?>':

<?php foreach($dvds as $dvd) : ?>

<h3>
 <?php echo $dvd->title ?>
</h3>
<p> Rating: <?php echo $dvd->rating ?> </p>
<p> Genre: <?php echo $dvd->genre ?> </p>
<p> Format: <?php echo $dvd->format ?> </p>

<?php endforeach; ; ?>>