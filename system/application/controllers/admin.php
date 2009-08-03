<?php

class Admin extends Controller {
	
	function index()
	{
		if ($_POST)
		{
			$this->load->model('projects_model');
			$projectID = $this->projects_model->create();
			redirect('admin/view/'.$projectID);
		}
		
		$this->load->helper('directory');
		
		$files = directory_map('resources/portfolio/');
		
		$fields     = $this->db->order_by('fieldID')->get('fields');
		$categories = $this->db->order_by('categoryName')->get('categories');
		
		$this->load->view('admin/add', array('fields' => $fields, 'files' => $files, 'categories' => $categories));
	}
	
	function view($id = null)
	{
		$this->load->model('projects_model');
		
		if ($id === null)
		{
			$projects = $this->projects_model->items();
			$this->load->view('admin/view', array('projects' => $projects));
		}
		else {
			if ($_POST)
			{
				$this->projects_model->update($id);
			}
			
			$this->load->helper('directory');
			
			$info       = $this->projects_model->item($id);
			$project    = $info['fields'];
			$categoryID = $info['categoryID'];
			$files      = directory_map('resources/portfolio');
			$fields     = $this->db->order_by('fieldID')->get('fields');
			$categories = $this->db->order_by('categoryName')->get('categories');
		
			$this->load->view('admin/edit', array('fields' => $fields, 'files' => $files, 'categories' => $categories, 'project' => $project, 'categoryID' => $categoryID));
		}
	}
	
	function delete($id)
	{
		$this->load->model('projects_model');
		
		if ($this->uri->segment(4) === 'yes')
		{
			$this->projects_model->delete($id);
			redirect('admin/view');
		}
		else
		{
			$info       = $this->projects_model->item($id);
			$project    = $info['fields'];
			$this->load->view('admin/delete', array('projectName'=>$project[1]));
		}
	}
	
	function settings($action = null, $id = null)
	{
		if ($action !== null)
		{
			switch($action)
			{
				case 'add_category':
					if ($_POST['categoryName'] !== '')
					{
						$this->db->insert('categories', array('categoryName'=>$_POST['categoryName']));
					}
					redirect('admin/settings');
					break;
				case 'edit_category':
					if (isset($_POST['categoryName']) && $_POST['categoryName'] !== '')
					{
						$this->db->where('categoryID',$id)->update('categories', array('categoryName'=>$_POST['categoryName']));
						redirect('admin/settings');
					}
					$this->load->view('admin/edit_category', array('categoryName'=>$this->db->where('categoryID', $id)->get('categories')->row()->categoryName));
					break;
				case 'delete_category':
					if ($this->uri->segment(5) === 'yes')
					{
						$this->db->where('categoryID', $id)->delete('categories');
						redirect('admin/settings');
					}
					$this->load->view('admin/delete_category', array('categoryName'=>$this->db->where('categoryID', $id)->get('categories')->row()->categoryName));
					break;
				case 'add_field':
					if ($_POST['fieldName'] !== '')
					{
						$this->db->insert('fields', array('fieldName'=>$_POST['fieldName'], 'fieldType'=>$_POST['fieldType']));
					}
					redirect('admin/settings');
					break;
				case 'edit_field':
					if (isset($_POST['fieldName']) && $_POST['fieldName'] !== '')
					{
						$this->db->where('fieldID',$id)->update('fields', array('fieldName'=>$_POST['fieldName'], 'fieldType'=>$_POST['fieldType']));
						redirect('admin/settings');
					}
					$this->load->view('admin/edit_field', array('fieldName'=>$this->db->where('fieldID', $id)->get('fields')->row()->fieldName, 'fieldType'=>$this->db->where('fieldID', $id)->get('fields')->row()->fieldType));
					break;
				case 'delete_field':
					if ($this->uri->segment(5) === 'yes')
					{
						$this->db->where('fieldID', $id)->delete('fields');
						redirect('admin/settings');
					}
					$this->load->view('admin/delete_field', array('fieldName'=>$this->db->where('fieldID', $id)->get('fields')->row()->fieldName));
					break;
			}
		}
		else
		{
			//get category list
			$categories = $this->db->order_by('categoryName')->get('categories');
			
			//get field list
			$fields     = $this->db->order_by('fieldID')->get('fields');
			
			$this->load->view('admin/settings', array('categories' => $categories, 'fields' => $fields));
		}
	}
	
}