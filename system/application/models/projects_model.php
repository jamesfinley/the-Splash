<?php
class projects_model extends Model {
	
	function create()
	{
		//get categoryID out and update table value
		$categoryID = $_POST['categoryID'];
		$this->db->insert('projects', array('categoryID' => $categoryID));
		$projectID = $this->db->insert_id();
		unset($_POST['categoryID']);
		
		//get and update field values
		foreach ($_POST as $key=>$value) {
			$fieldID = str_replace('field_', '', $key);
			$fieldValue = $value;
			
			$this->db->insert('projectData', array('projectID' => $projectID, 'fieldID' => $fieldID, 'fieldValue' => $fieldValue));
		}
		
		return $projectID;
	}
	
	function update($id)
	{
		//get categoryID out and update table value
		$categoryID = $_POST['categoryID'];
		$this->db->where('projectID', $id)->update('projects', array('categoryID' => $categoryID));
		unset($_POST['categoryID']);
		
		//get and update field values
		foreach ($_POST as $key=>$value) {
			$fieldID = str_replace('field_', '', $key);
			$fieldValue = $value;
			
			if ($this->db->where('projectID', $id)->where('fieldID', $fieldID)->get('projectData')->num_rows() == 1)
			{
				$this->db->where('projectID', $id)->where('fieldID', $fieldID)->update('projectData', array('fieldValue' => $fieldValue));
			}
			else
			{
				$this->db->insert('projectData', array('projectID' => $id, 'fieldID' => $fieldID, 'fieldValue' => $fieldValue));
			}
		}
		
		return $id;
	}
	
	function delete($id)
	{
		$this->db->where('projectID', $id)->delete('projectData');
		$this->db->where('projectID', $id)->delete('projects');
		return true;
	}
	
	function item($id)
	{
		$fields = $this->db->query('SELECT pd.projectID, fieldID, fieldValue FROM projectData pd, projects p WHERE pd.projectID = p.projectID AND pd.projectID='.$id.' ORDER BY pd.projectID DESC');
		
		$list = array();
		
		foreach ($fields->result() as $field)
		{
			$list[$field->fieldID] = $field->fieldValue;
		}
		$category = $this->db->where('projectID', $id)->select('categoryID')->get('projects')->row()->categoryID;
		
		return array('fields'=>$list, 'categoryID'=>$category);
	}
	
	function items()
	{
		$items = $this->db->query('SELECT pd.projectID, fieldID, fieldValue FROM projectData pd, projects p WHERE pd.projectID = p.projectID ORDER BY pd.projectID DESC, fieldID ASC');
		
		$list = array();
		
		$lastID = 0;
		foreach ($items->result() as $item)
		{
			if ($item->projectID != $lastID) {
				$lastID = $item->projectID;
				
				$list[$item->projectID] = array();
			}
			$list[$item->projectID][$item->fieldID] = $item->fieldValue;
		}
		
		return $list;
	}
	
	function output($type = 'array')
	{
		$items = $this->items();
		
		$fields = $this->db->get('fields')->result_array();
		$field_list = array();
		for ($i=0; $i<count($fields); $i++)
		{
			$field_list[$fields[$i]['fieldID']] = $fields[$i]['fieldName'];
		}
		
		$list1 = array();
		foreach ($items as $id=>$item)
		{
			$project = array();
			foreach ($item as $i=>$field)
			{
				$project[$field_list[$i]] = $field;
			}
			$list1[$id] = $project;
		}
		
		$list2 = array();
		foreach ($list1 as $id=>$item)
		{
			$list2[] = array(
				'projectID' => $id,
				'categoryID' => $this->db->query('SELECT categoryID FROM projects WHERE projectID='.$id)->row()->categoryID,
				'categoryName' => $this->db->query('SELECT categoryName FROM projects p, categories c WHERE p.categoryID=c.categoryID AND p.projectID='.$id)->row()->categoryName,
				'data' => $item
			);
		}
		
		$list3 = array();
		foreach ($list2 as $item)
		{
			if (!isset($list3[$item['categoryID']]))
			{
				$list3[$item['categoryID']] = array('categoryName'=>$item['categoryName'], 'items'=>array());
			}
			$list3[$item['categoryID']]['items'][] = $item;
		}
		
		if ($type == 'json')
		{
			return json_encode($list3);
		}
		elseif ($type == 'xml')
		{
			
		}
		else
		{
			return $list3;
		}
	}
	
}