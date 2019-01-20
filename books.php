<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$name = "%";
$isbn = "%";
$author = "%";
if (isset($_POST['name'])) {
	$name .= $_POST['name']."%";
}
if (isset($_POST['isbn'])) {
	$isbn .= $_POST['isbn']."%";
}
if (isset($_POST['author'])) {
	$author .= $_POST['author']."%";
}
$pdo = new PDO("mysql:host=localhost;dbname=global; charset=utf8", "soleinikov", "neto1895");
$sql = "SELECT * FROM books WHERE name like :name AND isbn like :isbn AND author like :author";
$stmt = $pdo->prepare($sql);
$stmt->execute(["name"=>$name,"isbn"=>$isbn,"author"=>$author]);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
 <html lang="ru">
 <head>
 	<meta charset="UTF-8">
 	<title>books</title>
 	 <style>
 		table {border-collapse: collapse; margin: 15px 15px; text-align: center;}
 		thead {background: #eee;}
 	</style>
 </head>
 <body>
 	<form action="" method="POST">
 		<input type="text" placeholder="ISBN" name="isbn">
 		<input type="text" placeholder="Название книги" name="name">
 		<input type="text" placeholder="Автор книги" name="author">
 		<input type="submit">
 	</form>
	<table cellpadding="10px" border="1px solid black">
		<thead>
			<th>Название</th>
			<th>Автор</th>
			<th>Год</th>
			<th>Жанр</th>
			<th>ISBN</th>
		</thead>
<?php foreach ($books as $row) { ?>
		<tr>
			<td><?=$row['name'] ?></td>
			<td><?=$row['author'] ?></td>
			<td><?=$row['year'] ?></td>
			<td><?=$row['genre'] ?></td>
			<td><?=$row['isbn'] ?></td>
		</tr>
			<?php } ?>
	</table>


 </body>
 </html
