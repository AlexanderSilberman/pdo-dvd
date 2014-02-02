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
WHERE title LIKE ?
ORDER BY title ASC
";
//echo $sql;
$statement = $pdo->prepare($sql);
if(!$statement){
	echo "hi";
	print_r($dbh->errorInfo());	
}

$like = '%'.$title.'%';
$statement->bindParam(1, $like);


$statement->execute();

if(!$statement){
	echo "hi";
	print_r($dbh->errorInfo());	
}

$dvds=$statement->fetchAll(PDO::FETCH_OBJ);

//var_dump($dvds);

?>

You searched for '<?php echo $title ?>':

<?php
if(!$dvds){
	echo "No results found <a href='search.php'>BACK </a><br>";
}
?>

<table border="1"><strong>
<tr><td>Title</td><td>Rating</td><td>Genre</td><td>Format</td> </tr></strong>
<?php foreach($dvds as $dvd) : ?>
<tr> 
<td><?php echo $dvd->title ?> </td>
<td><?php echo $dvd->rating ?> </td>
<td><?php echo $dvd->genre ?> </td>
<td><?php echo $dvd->format ?> </td>

</tr>

<?php endforeach; ; ?>
</table>