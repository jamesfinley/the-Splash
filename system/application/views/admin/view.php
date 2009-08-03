<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>the Splash : View Projects</title>
		<script type="text/javascript" src="/resources/javascript/jquery-1.3.2.min.js"></script>
		<link rel="stylesheet" href="/admin_resources/css/style.css" />
	</head>
	<body>
		<section id="container">
			<header>
				<ul id="navigation">
					<li id="logo"><h1>the Splash</h1></li>
					<li id="add_project" class="nav_item"><a href="<?=site_url('admin')?>" class="selected">Add Project</a></li>
					<li id="view_projects" class="nav_item selected"><a href="<?=site_url('admin/view')?>">View Projects</a></li>
					<li id="system_nav">Welcome back, James! <a href="<?=site_url('admin/logout')?>">logout</a> <a href="<?=site_url('admin/settings')?>">manage settings</a></li>
				</ul>
				<br class="clear" />
			</header>
			<section id="site">
				<h2>View Projects</h2>
				<table cellspacing="0">
					<?php foreach($projects as $i=>$project): ?>
					<tr>
						<td class="projectName name"><strong>Project Name: </strong><?=$project[1]?></td>
						<td class="action"><a href="<?=site_url('admin/view/'.$i)?>">edit</a></td>
						<td class="action"><a href="<?=site_url('admin/delete/'.$i)?>">delete</a></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</section>
		</section>
	</body>
</html>