<!DOCTYPE html>
<html class="h-100">
	<head>
		<meta charset="utf-8">
		<title>Create Posts - EECS 448 Lab 10</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!--Bootstrap styles-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		
	</head>
	<body class="h-100 d-flex flex-column">
		<nav class="navbar navbar-expand navbar-dark bg-dark border-bottom" style="flex-shrink: none">
			<a class="navbar-brand" href="index.html">EECS 448 Lab 10</a>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="CreateUser.html">2: CreateUser</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="CreatePosts.html">3: CreatePosts</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="AdminHome.html">4-7: Admin</a>
				</li>
			</ul>
		</nav>
		<div class="container" style="flex: 1 0 auto">
			<h1 class="mt-3">Create Posts</h1>
			<?php
				ini_set('display_errors', 1);
				ini_set('display_startup_errors', 1);
				error_reporting(E_ALL);
				mysqli_report(MYSQLI_REPORT_ALL);
			
				$user_id = $_POST["user_id"];
				$content = $_POST["content"];
				if ($content == "") error("Post cannot be blank");
				else {
					$mysqli = new mysqli("mysql.eecs.ku.edu", "drakeprebyl", "aeNg7ech", "drakeprebyl");
					if ($mysqli->connect_errno) error("Database connection failed: " . $mysqli->connect_error);
					else {
						$query = $mysqli->prepare("SELECT COUNT(*) FROM Users WHERE user_id = ?");
						$query->bind_param("s", $user_id);
						$query->execute();
						$query->bind_result($count);
						$query->fetch();
						$query->close();
						if ($count < 1) error("User ID does not exist");
						else {
							$query = $mysqli->prepare("INSERT INTO Posts (author_id, content) VALUES (?, ?)");
							$query->bind_param("ss", $user_id, $content);
							$query->execute();
							$query->close();
							?>
								<span class="text-success">Post created</span>
							<?php
						}
					}
					$mysqli->close();
				}
				
				function error($msg) {
					?>
					<form method="GET" action="CreatePosts.html">
						<span class="text-danger">Error: <?=$msg?></span>
						<input type="submit" class="btn btn-primary" value="Try again">
					</form>
					<?php
				}
			?>
		</div>
		<footer class="mt-2 py-2 border-top text-center" style="flex-shrink: none">
			&copy; 2020 Drake Prebyl
		</footer>
	</body>
</html>