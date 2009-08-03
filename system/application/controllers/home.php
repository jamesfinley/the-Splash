<?php

class Home extends Controller {
	
	function index()
	{
		//load in Markdown library
		//$this -> load -> library('Markdown');
		 
		
		$this->load->model('projects_model');
		
		$projects = $this->projects_model->output();
		
		$this -> load -> view('home', array('projects'=>$projects));
	}
	
}