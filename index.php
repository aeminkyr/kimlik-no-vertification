<!DOCTYPE html>
<html>
<head>
	<title>identity verifier</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand" href="#">Turkey Republic Identity Verifier</a>
	</nav>
	<div class="container mt-2">
		<div class="row">
			<div class="col-md-3">
				<form method="post" action="check.php">
					<input type="text" class="form-control mb-1" name="name" placeholder="name" required>
					<input type="text" class="form-control mb-1" name="lastname" placeholder="lastname" required>
					<input type="text" class="form-control mb-1" name="birthyear" placeholder="birthyear (ex: 1998)" required>
					<input type="text" class="form-control mb-1 " name="ssn" placeholder="kimlik no" required>
					<button type="submit" class="btn btn-light float-right">Check </button>
				</form>
			</div>
			<div class="col">
				<?php session_start();
				if(isset($_SESSION['info'])){
					if ($_SESSION['info']==true) {
						echo "<h4>Congratulations you are a citizen of the Republic Of Turkey!</h4>";
						unset($_SESSION['info']);
					} elseif($_SESSION['info']==false){
						echo "<h4>You have to work a lot, sorry you are not a citizen...</h4>";
						unset($_SESSION['info']);
					}
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>