<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>the Splash : Delete Category "<?=$categoryName?>"</title>
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
					<li id="system_nav">Welcome back, James! <a href="<?=site_url('admin/logout')?>">logout</a> <a href="<?=site_url('admin/settings')?>" class="selected">manage settings</a></li>
				</ul>
				<br class="clear" />
			</header>
			<section id="site">
				<h2>Delete Category "<?=$categoryName?>"</h2>
				<div class="prompt">
					Are you sure that you want to delete category "<?=$categoryName?>"?<br />
					<span class="note">This will not delete projects associated with this category.</span>
					<ul>
						<li><a href="<?=site_url('admin/settings/delete_category/'.$this->uri->segment(4).'/yes')?>">yes</a></li>
						<li><a href="<?=site_url('admin/settings')?>">no</a></li>
					</ul>
				</div>
			</section>
		</section>
	</body>
</html>