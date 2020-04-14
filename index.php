<?php 

	include('config/db_connect.php');

	// write query for all pizzas
	$sql = 'SELECT title, author, genre, bid FROM book ORDER BY created_at';

	// get the resbault set (set of rows)
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free the $result from memory (good practise)
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Books!</h4>

	<div class="container">
		<div class="row">

			<?php foreach($books as $book): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($book['title']); ?></h6>
							<h6><?php echo htmlspecialchars($book['author']); ?></h6>
							<h6><?php echo htmlspecialchars($book['genre']); ?></h6>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?bid=<?php echo $book['bid'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>