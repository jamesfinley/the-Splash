<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>one Crimson Splash: the work of James Finley</title>
		<link rel="stylesheet" href="resources/css/style.css" />
		<script type="text/javascript" src="resources/javascript/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="resources/javascript/portfolio.js"></script>
	</head>
	<body>
		<header>
			<h1>one Crimson Splash: the work of James Finley</h1>
			<h2>a graduate of the Illinois Institute of Art</h2>
		</header>
		<section id="site">
			<section id="content_window">
				<ul id="portfolio">
					<?php foreach ($projects as $category):?>
						<li class="header"><h2><?=$category['categoryName']?></h2></li>
						<?php foreach ($category['items'] as $project):?>
							<li class="item">
								<img src="resources/portfolio/<?=$project['data']['Small Image (300px x 169px)']?>" alt="<?=$project['data']['Project Name']?>" title="<?=$project['data']['Project Name']?>" />
								<span class="type_of_work"><?=$project['data']['Project Type (languages, what was done, etc.)']?></span>
								<span class="large_image" data="<?=$project['data']['Large Image (720px x 406px)']?>"></span>
								<span class="description" data="<?=$project['data']['Project Description']?>"></span>
								<span class="style" data="<?=$project['data']['Window Style (dark or light)']?>"></span>
							</li>
						<?php endforeach; ?>
					<?php endforeach; ?>
					<li class="clear"></li>
				</ul>
			</section>
			<footer>
				<section id="bio">
					<h3>Who is James Finley</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</section>
				<section id="social">
					<h3>Social</h3>
					<h4>Twitter:</h4>
					<a href="http://twitter.com/thefinley">http://twitter.com/thefinley</a>
					<h4>Facebook:</h4>
					<a href="http://facebook.com/jamesfinley">http://facebook.com/jamesfinley</a>
				</section>
				<section id="contact">
					<h3>Contact</h3>
					<h4>Email:</h4>
					<a href="mailto:jamesfinley@gmail.com">jamesfinley@gmail.com</a>
				</section>
			</footer>
		</section>
	</body>
</html>