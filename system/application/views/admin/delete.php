<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>the Splash : Delete Project "<?=$projectName?>"</title>
		<script type="text/javascript" src="/admin_resources/javascript/jquery-1.3.2.min.js"></script>
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
				<h2>Delete Project "<?=$projectName?>"</h2>
				<div class="prompt">
					Are you sure that you want to delete project "<?=$projectName?>" and all related data?<br />
					<span class="note">This will not delete images associated with this project.</span>
					<ul>
						<li><a href="<?=site_url('admin/delete/'.$this->uri->segment(3).'/yes')?>">yes</a></li>
						<li><a href="<?=site_url('admin/view')?>">no</a></li>
					</ul>
				</div>
			</section>
		</section>
	</body>
</html>