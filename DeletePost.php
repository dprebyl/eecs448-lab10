<!DOCTYPE html>
<html class="h-100">
	<head>
		<meta charset="utf-8">
		<title>Delete Post - EECS 448 Lab 10</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!--Bootstrap styles-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body class="h-100 d-flex flex-column">
		<nav class="navbar navbar-expand navbar-dark bg-danger border-bottom" style="flex-shrink: none">
			<a class="navbar-brand" href="index.html">EECS 448 Lab 10 Admin</a>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="AdminHome.html">4: AdminHome</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="ViewUsers.php">5: ViewUsers</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="ViewUserPosts.html">6: ViewUserPosts</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="DeletePost.html">7: DeletePost</a>
				</li>
			</ul>
		</nav>
		<div class="container" style="flex: 1 0 auto">
			<h1 class="mt-3">EECS 448 Lab 10 - Delete Post</h1>
			<?php
				$mysqli = new mysqli("mysql.eecs.ku.edu", "drakeprebyl", "aeNg7ech", "drakeprebyl");
				if (!$mysqli->connect_errno) {
					foreach ($_POST as $id => $value) {
						$query = $mysqli->prepare("DELETE FROM Posts WHERE post_id = ?");
						$query->bind_param("s", $id);
						$query->execute();
						echo "<span class='text-success'>Post ID $id deleted</span><br>";
					}
				}
				$mysqli->close();
			?>

		</div>
		<footer class="mt-2 py-2 border-top text-center" style="flex-shrink: none">
			&copy; 2020 Drake Prebyl
		</footer>
	</body>
</html>