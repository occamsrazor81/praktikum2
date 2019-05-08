<?php
session_start();
require_once __DIR__.'/../model/projectservice.class.php';

class ProjectsController
{

	public function index()
	{
		$ps = new ProjectService();

		$title = 'Projects';
		$projectList = $ps->getAllProjects();

		require_once __DIR__.'/../view/projects_index.php';
	}

  public function myProjects()
  {
    $ps = new ProjectService();

    $title = 'My projects';
  	$projectList = $ps->getMyProjects($_SESSION['id_user']);
		//$projectList = $ps->getMyProjects($id_user);

    require_once __DIR__.'/../view/projects_index.php';
  }


};

?>
