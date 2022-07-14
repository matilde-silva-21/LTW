<!DOCTYPE html>
<html lang="en-US">

<head>
	<title>Super Legit News</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet">
	<link href="layout.css" rel="stylesheet">
	<link href="responsive.css" rel="stylesheet">
	<link href="comments.css" rel="stylesheet">
	<link href="forms.css" rel="stylesheet">
</head>

<body>
	<header>
		<h1><a href="index.php">Super Legit News</a></h1>
		<h2><a href="index.php">Where fake news are born!</a></h2>
		<div id="signup">
			<a href="register.html">Register</a>
			<a href="login.html">Login</a>
		</div>
	</header>
	<nav id="menu">
		<!-- just for the hamburguer menu in responsive layout -->
		<input type="checkbox" id="hamburger">
		<label class="hamburger" for="hamburger"></label>

		<ul>
			<li><a href="index.php">Local</a></li>
			<li><a href="index.php">World</a></li>
			<li><a href="index.php">Politics</a></li>
			<li><a href="index.php">Sports</a></li>
			<li><a href="index.php">Science</a></li>
			<li><a href="index.php">Weather</a></li>
		</ul>
	</nav>



	<aside id="related">

		<article>
			<h1><a href="#">Duis arcu purus</a></h1>
			<p>Etiam mattis convallis orci eu malesuada. Donec odio ex, facilisis ac blandit vel, placerat ut lorem. Ut id sodales purus. Sed ut ex sit amet nisi ultricies malesuada. Phasellus magna diam, molestie nec quam a, suscipit finibus dui. Phasellus a.</p>
		</article>
		<article>
			<h1><a href="#">Sed efficitur interdum</a></h1>
			<p>Integer massa enim, porttitor vitae iaculis id, consequat a tellus. Aliquam sed nibh fringilla, pulvinar neque eu, varius erat. Nam id ornare nunc. Pellentesque varius ipsum vitae lacus ultricies, a dapibus turpis tristique. Sed vehicula tincidunt justo, vitae varius arcu.</p>
		</article>
		<article>
			<h1><a href="#">Vestibulum congue blandit</a></h1>
			<p>Proin lectus felis, fringilla nec magna ut, vestibulum volutpat elit. Suspendisse in quam sed tellus fringilla luctus quis non sem. Aenean varius molestie justo, nec tincidunt massa congue vel. Sed tincidunt interdum laoreet. Vivamus vel odio bibendum, tempus metus vel.</p>

		</article>


	</aside>

	<section id="news">
		<?php
		$db = new PDO('sqlite:news.db');
		$stmt = $db->prepare('SELECT news.*, users.*, COUNT(comments.id) AS comments
		FROM news JOIN
			 users USING (username) LEFT JOIN
			 comments ON comments.news_id = news.id
		GROUP BY news.id, users.username
		ORDER BY published DESC');
		$stmt->execute();
		$articles = $stmt->fetchAll();
		$counter = 0;
		foreach ($articles as $article) {
			echo '<article>';
			echo '<header>';
			echo '<h1><a href="item.html">' . $article['title'] . '</a></h1>';
			echo '</header>';
			switch ($counter) {
				case 0:
					echo '<img src="https://picsum.photos/600/300?business" alt="">';
					break;
				case 1:
					echo '<img src="https://picsum.photos/600/300?city" alt="">';
					break;

				case 2:
					echo '<img src="https://picsum.photos/600/300?nature" alt="">';
					break;
				case 3:
					echo '<img src="https://picsum.photos/600/300?transport" alt="">';
					break;
				
			}
			echo '<p>' . $article['introduction'] . '</p>';
			echo '<footer>';
			echo '<span class="author">' . $article['name'] . '</span>';
			$tags = explode(",", $article['tags']);
			echo '<span class="tags">';
			foreach ($tags as $tag) {
				echo '<a href="index.php">#' . $tag . '</a>';
				echo ' ';
			}
			echo '</span>';
			echo '<span class="date">'; 
			$date = date('F j', $article['published']);
			echo $date;
			echo '<a class="comments" href="item.html#comments">'. $article['comments'] .'</a>';
			echo '</span>';
			echo '</footer>';
			echo '</article>';
			$counter++;
		}
		?>
	</section>
	<footer>
		<p>&copy; Fake News, 2022</p>
	</footer>
</body>

</html>