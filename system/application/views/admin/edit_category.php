<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>the Splash : Editing Category "<?=$categoryName?>"</title>
		<script type="text/javascript" src="/admin_resources/javascript/jquery-1.3.2.min.js"></script>
		<link rel="stylesheet" href="/admin_resources/css/style.css" />
	</head>
	<body>
		<section id="container">
			<header>
				<ul id="navigation">
					<li id="logo"><h1>the Splash</h1></li>
					<li id="add_project" class="nav_item"><a href="<?=site_url('admin')?>" class="selected">Add Project</a></li>
					<li id="view_projects" class="nav_item"><a href="<?=site_url('admin/view')?>">View Projects</a></li>
					<li id="system_nav">Welcome back, James! <a href="<?=site_url('admin/logout')?>">logout</a> <a href="<?=site_url('admin/settings')?>" class="selected">manage settings</a></li>
				</ul>
				<br class="clear" />
			</header>
			<form id="site" action="" method="post">
				<h2>Editing Category "<?=$categoryName?>"</h2>
				<table cellspacing="0">
					<tr>
						<td class="label"><label>Category Name</label></td>
						<td class="field"><input type="text" name="categoryName" value="<?=$categoryName?>" /></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Save Category" /></td>
					</tr>
				</table>
			</form>
		</section>
	</body>
</html>