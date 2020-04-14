<?php

	include('config/db_connect.php');

	$title = $author = $genre = '';
	$errors = array('title' => '', 'author' => '', 'genre' => '');

	if(isset($_POST['submit'])){
		
		// check title
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

		// check author
		if(empty($_POST['author'])){
			$errors['author'] = 'A author is required';
		} else{
			$author = $_POST['author'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $author)){
				$errors['author'] = 'Author must be letters and spaces only';
			}
		}

		// check genre
		if(empty($_POST['genre'])){
			$errors['genre'] = 'A genre is required';
		} else{
			$genre = $_POST['genre'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $genre)){
				$errors['genre'] = 'Genre must be letters and spaces only';
			}
		}

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$author = mysqli_real_escape_string($conn, $_POST['author']);
			$genre = mysqli_real_escape_string($conn, $_POST['genre']);

			// create sql
			$sql = "INSERT INTO book(title,author,genre) VALUES('$title','$author','$genre')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
			
		}

	} // end POST check

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a Book</h4>
		<form class="white" action="add.php" method="POST">
			<label>Book Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>
			<label>Book Author</label>
			<input type="text" name="author" value="<?php echo htmlspecialchars($author) ?>">
			<div class="red-text"><?php echo $errors['author']; ?></div>
			<label>Book Genre</label>
			<input type="text" name="genre" value="<?php echo htmlspecialchars($genre) ?>">
			<div class="red-text"><?php echo $errors['genre']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>