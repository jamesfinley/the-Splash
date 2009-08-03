<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>the Splash : Settings</title>
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
			<section id="site">
				<h2>Settings</h2>
				<section class="module">
					<h3>Categories</h3>
					<table cellspacing="0" class="small">
						<?php foreach($categories->result() as $category): ?>
						<tr>
							<td class="categoryName name"><?=$category -> categoryName?></td>
							<td class="action"><a href="<?=site_url('admin/settings/edit_category/'.$category -> categoryID)?>">edit</a></td>
							<td class="action"><a href="<?=site_url('admin/settings/delete_category/'.$category -> categoryID)?>">delete</a></td>
						</tr>
						<?php endforeach; ?>
					</table>
					<h4>Add a Category</h4>
					<form class="small" action="<?=site_url('admin/settings/add_category')?>" method="post">
						<table cellspacing="0">
							<tr>
								<td class="label"><label for="categoryName_field">Category Name:</label></td>
								<td class="field"><input type="text" name="categoryName" id="categoryName_field" /></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Add Category" /></td>
							</tr>
						</table>
					</form>
				</section>
				<section class="module">
					<h3>Project Fields</h3>
					<table cellspacing="0" class="small">
						<?php foreach($fields->result() as $field): ?>
						<tr>
							<td class="fieldName name"><?=$field -> fieldName?></td>
							<td class="action"><?php if ($field -> disallowEdit == 0): ?><a href="<?=site_url('admin/settings/edit_field/'.$field -> fieldID)?>">edit</a><?php endif; ?></td>
							<td class="action"><?php if ($field -> disallowEdit == 0): ?><a href="<?=site_url('admin/settings/delete_field/'.$field -> fieldID)?>">delete</a><?php endif; ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
					<h4>Add a Field</h4>
					<form class="small" action="<?=site_url('admin/settings/add_field')?>" method="post">
						<table cellspacing="0">
							<tr>
								<td class="label"><label for="fieldName_field">Field Name:</label></td>
								<td class="field"><input type="text" name="fieldName" id="fieldName_field" /></td>
							</tr>
							<tr>
								<td class="label"><label for="fieldType_field">Field Type:</label></td>
								<td class="field"><select name="fieldType" id="fieldType_field"><option value="text">text</option><option value="textarea">textarea</option><option value="file">file</option></select></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Add Field" /></td>
							</tr>
						</table>
					</form>
				</section>
				<br class="clear" />
			</section>
		</section>
	</body>
</html>