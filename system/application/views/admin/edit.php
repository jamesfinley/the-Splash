<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>the Splash : Editing Project "<?=$project[1]?>"</title>
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
			<form id="site" action="" method="post">
				<h2>Editing Project "<?=$project[1]?>"</h2>
				<table cellspacing="0">
				<?php foreach ($fields->result() as $field):?>
					<tr>
						<td class="label"><label for="field_<?=$field->fieldID?>"><?=$field->fieldName?></label></td> <?php
						if ($field->fieldType == 'text') {
							?><td class="field"><input type="text" name="field_<?=$field->fieldID?>" id="field_<?=$field->fieldID?>"<?=isset($project[$field->fieldID]) ? ' value="'.$project[$field->fieldID].'"' : ''?> /></td><?
						}
						elseif ($field->fieldType == 'textarea') {
							?><td class="field"><textarea name="field_<?=$field->fieldID?>" id="field_<?=$field->fieldID?>"><?=isset($project[$field->fieldID]) ? $project[$field->fieldID] : ''?></textarea></td><?
						}
						elseif ($field->fieldType == 'file') {
							?><td class="field"><select name="field_<?=$field->fieldID?>" id="field_<?=$field->fieldID?>">
								<option value=""></option>
								<?php foreach ($files as $key=>$file):?>
									<?php if (is_array($file)):?>
										<optgroup label="<?=$key?>">
											<?php for ($i=0; $i<count($file); $i++):?>
												<option value="<?=$key?>/<?=$file[$i]?>"<?=isset($project[$field->fieldID]) ? ($project[$field->fieldID] == $key.'/'.$file[$i] ? ' selected="selected"' : '') : ''?>><?=$file[$i]?></option>
											<?php endfor; ?>
										</optgroup>
									<?php else: ?>
										<option value="<?=$file?>"<?=isset($project[$field->fieldID]) ? ($project[$field->fieldID] == $file ? ' selected="selected"' : '') : ''?>><?=$file?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select></td><?
						}
					?></tr>
				<?php endforeach; ?>
					<tr>
						<td class="label"><label>Category</label></td>
						<td class="field">
							<select name="categoryID">
								<?php foreach ($categories->result() as $category): ?>
									<option value="<?=$category->categoryID?>"<?=$categoryID == $category->categoryID ? ' selected="selected"' : ''?>><?=$category->categoryName?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Save Project" /></td>
					</tr>
				</table>
			</form>
		</section>
	</body>
</html>